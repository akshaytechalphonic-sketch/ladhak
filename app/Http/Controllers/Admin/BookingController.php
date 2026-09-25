<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room.hotel')->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        // Typically Admin doesn't create bookings from backend, but could be added.
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'special_requests' => 'nullable|string'
        ]);

        $booking->update([
            'status' => $validated['status'],
            'special_requests' => $request->special_requests ?? $booking->special_requests,
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking status updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
