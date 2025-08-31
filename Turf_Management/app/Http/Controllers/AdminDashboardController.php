<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turf;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = auth()->user();

        // Users
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Turfs (available only)
        $availableTurfs = Turf::where('status', 'available')->count();

        // Active bookings (pending or confirmed)
        $activeBookings = Booking::whereIn('status', ['pending', 'confirmed'])->count();

        // Recent activity: last 5 events across users, bookings, turfs
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get()->map(function ($u) {
            return [
                'type' => 'user',
                'title' => 'New user registered',
                'detail' => $u->name . ' (' . $u->email . ')',
                'time' => $u->created_at,
            ];
        });

        $recentBookings = Booking::orderBy('created_at', 'desc')->with(['user', 'turf'])->take(5)->get()->map(function ($b) {
            return [
                'type' => 'booking',
                'title' => 'Turf booking created',
                'detail' => ($b->turf->name ?? 'Turf') . ' for ' . ($b->user->name ?? 'User') . ' on ' . optional($b->booking_date)->format('M d, Y'),
                'time' => $b->created_at,
            ];
        });

        $recentTurfs = Turf::orderBy('created_at', 'desc')->take(5)->get()->map(function ($t) {
            return [
                'type' => 'turf',
                'title' => 'New turf added',
                'detail' => $t->name . ' (' . $t->sport_display . ')',
                'time' => $t->created_at,
            ];
        });

        $recentActivity = $recentUsers
            ->merge($recentBookings)
            ->merge($recentTurfs)
            ->sortByDesc('time')
            ->take(7)
            ->values();

        return view('admin.dashboard', compact('admin', 'totalUsers', 'totalAdmins', 'availableTurfs', 'activeBookings', 'recentActivity'));
    }

    /**
     * Show all users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Create a new user
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Update a user's basic information and role
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        if (!empty($validated['new_password'])) {
            $user->password = \Hash::make($validated['new_password']);
        }
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user
     */
    public function destroyUser(User $user)
    {
        // Prevent deleting yourself
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Show turf management
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manageTurf()
    {
        return view('admin.manage-turf');
    }

    /**
     * Show bookings
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bookings()
    {
        return view('admin.bookings');
    }
}
