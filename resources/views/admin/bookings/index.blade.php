@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bookings Management</h2>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Hotel & Room</th>
                    <th>Check In/Out</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $booking->name }}<br>
                        <small class="text-muted">{{ $booking->email }}</small>
                    </td>
                    <td>
                        {{ $booking->room->hotel->name ?? 'N/A' }}<br>
                        <small class="text-muted">{{ $booking->room->room_type ?? 'N/A' }}</small>
                    </td>
                    <td>
                        {{ $booking->check_in->format('M d, Y') }} to <br>
                        {{ $booking->check_out->format('M d, Y') }}
                    </td>
                    <td>
                        @if($booking->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($booking->status == 'confirmed')
                            <span class="badge bg-primary">Confirmed</span>
                        @elseif($booking->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td>₹{{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-sm btn-outline-primary">Update</a>
                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
    <div class="card-footer bg-white">
        {{ $bookings->links() }}
    </div>
    @endif
</div>
@endsection
