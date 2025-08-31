<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Turf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'turf'])->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->input('date'));
        }

        if ($request->filled('turf')) {
            $query->where('turf_id', $request->input('turf'));
        }

        $bookings = $query->paginate(10)->appends($request->query());

        $turfs = Turf::all();
        return view('admin.bookings.index', compact('bookings', 'turfs'));
    }

    public function create()
    {
        $turfs = Turf::all();
        $users = \App\Models\User::where('role', 'user')->get();
        return view('admin.bookings.create', compact('turfs', 'users'));
    }

    public function store(Request $request)
    {
        // Determine if this is an admin or user booking
        $isAdminBooking = $request->has('user_id') && $request->has('status');
        
        if ($isAdminBooking) {
            // Admin creating booking for a user
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'turf_id' => 'required|exists:turfs,id',
                'booking_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'duration_hours' => 'required|integer|min:1|max:8',
                'status' => 'required|in:pending,confirmed,completed,cancelled',
                'notes' => 'nullable|string'
            ]);
        } else {
            // User creating their own booking
            $validator = Validator::make($request->all(), [
                'turf_id' => 'required|exists:turfs,id',
                'booking_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'duration_hours' => 'required|integer|min:1|max:8',
                'notes' => 'nullable|string'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $turf = Turf::findOrFail($request->turf_id);
        $totalAmount = $turf->price_per_hour * $request->duration_hours;

        // Check if turf is available for the requested time
        $conflictingBooking = Booking::where('turf_id', $request->turf_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [
                    $request->start_time,
                    date('H:i:s', strtotime($request->start_time . ' + ' . $request->duration_hours . ' hours'))
                ])
                ->orWhere(function($subQuery) use ($request) {
                    $subQuery->where('start_time', '<=', $request->start_time)
                        ->whereRaw('DATE_ADD(start_time, INTERVAL duration_hours HOUR) > ?', [$request->start_time]);
                });
            })
            ->first();

        if ($conflictingBooking) {
            return redirect()->back()->withErrors(['time' => 'This time slot is already booked.'])->withInput();
        }

        $booking = Booking::create([
            'user_id' => $isAdminBooking ? $request->user_id : Auth::id(),
            'turf_id' => $request->turf_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'duration_hours' => $request->duration_hours,
            'total_amount' => $totalAmount,
            'notes' => $request->notes,
            'status' => $isAdminBooking ? $request->status : 'pending'
        ]);

        if ($isAdminBooking) {
            return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully!');
        } else {
            return redirect()->route('user.bookings.index')->with('success', 'Booking created successfully!');
        }
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $turfs = Turf::all();
        return view('admin.bookings.edit', compact('booking', 'turfs'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'turf_id' => 'required|exists:turfs,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'duration_hours' => 'required|integer|min:1|max:8',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $turf = Turf::findOrFail($request->turf_id);
        $totalAmount = $turf->price_per_hour * $request->duration_hours;

        $booking->update([
            'turf_id' => $request->turf_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'duration_hours' => $request->duration_hours,
            'total_amount' => $totalAmount,
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully!');
    }

    // User methods
    public function userBookings()
    {
        $bookings = Auth::user()->bookings()->with('turf')->orderBy('created_at', 'desc')->get();
        return view('user.bookings.index', compact('bookings'));
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $booking->update(['status' => 'cancelled']);
        return redirect()->route('user.bookings.index')->with('success', 'Booking cancelled successfully!');
    }

    public function confirmBooking(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking confirmed successfully!');
    }

    public function completeBooking(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking marked as completed!');
    }

    public function cancelAdminBooking(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking cancelled successfully!');
    }
}
