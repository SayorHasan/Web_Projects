<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\User;
use App\Models\Turf;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Check if user is admin and return appropriate view
        if ($user->isAdmin()) {
            $totalUsers = User::where('role', 'user')->count();
            $totalTurfs = Turf::count();
            $totalBookings = Booking::count();
            $pendingBookings = Booking::where('status', 'pending')->count();
            return view('admin.profile', compact('user', 'totalUsers', 'totalTurfs', 'totalBookings', 'pendingBookings'));
        }
        
        // Pre-compute activity metrics for user profile overview
        $totalBookings = $user->bookings()->count();
        $activeBookings = $user->activeBookings()->count();
        $completedBookings = $user->completedBookings()->count();

        // Favorite sport (most booked sport_type excluding cancelled)
        $favorite = Booking::selectRaw('turfs.sport_type as sport_type, COUNT(*) as bookings_count')
            ->join('turfs', 'turfs.id', '=', 'bookings.turf_id')
            ->where('bookings.user_id', $user->id)
            ->where('bookings.status', '!=', 'cancelled')
            ->groupBy('turfs.sport_type')
            ->orderByDesc('bookings_count')
            ->first();

        $favoriteSportName = $favorite?->sport_type ? ucfirst($favorite->sport_type) : '—';
        $favoriteSportCount = $favorite?->bookings_count ?? 0;

        return view(
            'user.profile',
            compact(
                'user',
                'totalBookings',
                'activeBookings',
                'completedBookings',
                'favoriteSportName',
                'favoriteSportCount'
            )
        );
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ], [
            'name.required' => 'The full name field is required.',
            'name.max' => 'The full name may not be greater than 255 characters.',
            'email.required' => 'The email address field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            'address.max' => 'The address may not be greater than 500 characters.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
            }
            
            return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update profile. Please try again.'])->withInput();
        }
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string'
        ], [
            'current_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password_confirmation.required' => 'The password confirmation field is required.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        // Check if new password is same as current password
        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->back()->withErrors(['new_password' => 'The new password must be different from the current password.'])->withInput();
        }

        try {
            // Update password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->route('admin.profile')->with('success', 'Password changed successfully!');
            }
            
            return redirect()->route('user.profile')->with('success', 'Password changed successfully!');
        } catch (\Exception $e) {
            \Log::error('Password change failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to change password. Please try again.'])->withInput();
        }
    }
}
