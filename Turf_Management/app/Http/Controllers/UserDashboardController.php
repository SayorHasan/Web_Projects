<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarouselImage;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get booking statistics
        $totalBookings = $user->bookings()->count();
        $activeBookings = $user->activeBookings()->count();
        $completedBookings = $user->completedBookings()->count();
        $recentBookings = $user->bookings()->with('turf')->latest()->take(5)->get();
        
        // Get carousel images for dashboard
        $carouselImages = CarouselImage::active()->ordered()->get();
        
        return view('user.dashboard', compact(
            'user', 
            'totalBookings', 
            'activeBookings', 
            'completedBookings', 
            'recentBookings',
            'carouselImages'
        ));
    }

    /**
     * Show turf booking page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bookTurf()
    {
        return view('user.book-turf');
    }

    /**
     * Show user profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
}
