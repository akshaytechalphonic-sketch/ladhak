<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\User;

class AdminController extends Controller
{
     public function dashboard()
    {
        $stats = [
            'total_hotels' => Hotel::count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_enquiries' => Enquiry::count(),
            'total_users' => User::count(),
            'total_revenue' => Booking::where('status', 'completed')->sum('total_price'),
        ];

        $latestBookings = Booking::with(['room.hotel'])->latest()->take(5)->get()->map(function($item) {
            $item->activity_type = 'booking';
            return $item;
        });

        $latestEnquiries = Enquiry::latest()->take(5)->get()->map(function($item) {
            $item->activity_type = 'enquiry';
            return $item;
        });

        $recentActivities = $latestBookings->concat($latestEnquiries)->sortByDesc('created_at')->take(5);

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
