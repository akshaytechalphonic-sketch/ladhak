@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.bookings.index') }}" class="text-decoration-none">&larr; Back to Bookings</a>
    <h2 class="mt-2">Update Booking #{{ $booking->id }}</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer Name</label>
                    <input type="text" class="form-control" value="{{ $booking->name }}" readonly>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="text" class="form-control" value="{{ $booking->email }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" value="{{ $booking->phone }}" readonly>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Room / Hotel</label>
                    <input type="text" class="form-control" value="{{ $booking->room->room_type ?? 'N/A' }} at {{ $booking->room->hotel->name ?? 'N/A' }}" readonly>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Check In</label>
                    <input type="text" class="form-control" value="{{ $booking->check_in->format('Y-m-d') }}" readonly>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Check Out</label>
                    <input type="text" class="form-control" value="{{ $booking->check_out->format('Y-m-d') }}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Total Price</label>
                    <input type="text" class="form-control" value="${{ number_format($booking->total_price, 2) }}" readonly>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Special Requests (Admin Notes/Update)</label>
                    <textarea name="special_requests" rows="3" class="form-control">{{ old('special_requests', $booking->special_requests) }}</textarea>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label text-primary fw-bold">Booking Status</label>
                    <select name="status" class="form-select border-primary @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed (Approve)</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Reject)</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed (Checked out)</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
            </div>
            
            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
        </form>
    </div>
</div>
@endsection
