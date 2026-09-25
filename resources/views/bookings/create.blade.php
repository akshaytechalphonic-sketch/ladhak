@extends('layouts.app')

@section('content')
<div class="bg-light-blue py-5">
    <div class="container text-center py-4">
        <div class="fade-up">
            <span class="badge bg-primary-blue text-black mb-3 px-3 py-2 rounded-pill text-uppercase ls-1">Reservation Request</span>
            <h1 class="display-4 fw-bold text-dark">Complete Your Booking</h1>
            <p class="text-muted lead max-w-600 mx-auto">You're just a few moments away from securing your premium sanctuary. We'll handle the rest.</p>
        </div>
    </div>
</div>

<div class="container py-5 mt-n5 position-relative" style="z-index: 10;">
    <div class="row g-5">
        <!-- Booking Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-5 p-4 p-md-5">
                @if(session('error'))
                    <div class="alert alert-danger rounded-4 border-0 mb-4">{{ session('error') }}</div>
                @endif
                
                <form action="{{ route('bookings.store', $room) }}" method="POST">
                    @csrf
                    
                    {{-- Hidden fields for Rate Plan --}}
                    @if($selectedPlan)
                        <input type="hidden" name="rate_plan_name" value="{{ $selectedPlan['name'] }}">
                        <input type="hidden" name="rate_plan_price" value="{{ $selectedPlan['price'] }}">
                    @endif

                    <div class="section-title mb-4">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-person text-primary-blue icon-sm"></i>
                            <h4 class="fw-bold mb-0">Guest Details</h4>
                        </div>
                        <p class="text-muted small">Please provide your contact information for the booking.</p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control border-0 bg-light rounded-4 px-4 @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required placeholder="Full Name">
                                <label for="name" class="ms-2">Full Name</label>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control border-0 bg-light rounded-4 px-4 @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required placeholder="Email Address">
                                <label for="email" class="ms-2">Email Address</label>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" class="form-control border-0 bg-light rounded-4 px-4 @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}" required placeholder="Phone Number">
                                <label for="phone" class="ms-2">Phone Number</label>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="section-title mb-4">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-calendar text-primary-blue icon-sm"></i>
                            <h4 class="fw-bold mb-0">Stay Details</h4>
                        </div>
                        <p class="text-muted small">Select your dates and number of guests.</p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="check_in" class="form-control border-0 bg-light rounded-4 px-4 @error('check_in') is-invalid @enderror" id="check_in" value="{{ old('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                <label for="check_in" class="ms-2">Check-in Date</label>
                                @error('check_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="check_out" class="form-control border-0 bg-light rounded-4 px-4 @error('check_out') is-invalid @enderror" id="check_out" value="{{ old('check_out', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                <label for="check_out" class="ms-2">Check-out Date</label>
                                @error('check_out')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" name="guests" class="form-control border-0 bg-light rounded-4 px-4 @error('guests') is-invalid @enderror" id="guests" value="{{ old('guests', 1) }}" min="1" max="{{ $room->capacity }}" required placeholder="Number of Guests">
                                <label for="guests" class="ms-2">Number of Guests (Max {{ $room->capacity }})</label>
                                @error('guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="special_requests" class="form-control border-0 bg-light rounded-4 px-4 @error('special_requests') is-invalid @enderror" id="requests" style="height: 120px" placeholder="Special Requests">{{ old('special_requests') }}</textarea>
                                <label for="requests" class="ms-2">Special Requests (Optional)</label>
                                @error('special_requests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary-blue btn-lg w-100 py-3 fw-bold rounded-pill shadow-lg transition-all">Confirm Booking Request</button>
                    <p class="text-center text-muted mt-4 small d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-shield-check icon-sm text-success"></i> Secure Booking &bull; Pay at Property
                    </p>
                </form>
            </div>
        </div>
        
        <!-- Booking Summary Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                    <div class="card-img-wrapper" style="height: 180px;">
                        <img src="{{ !empty($room->images) ? asset('storage/'.$room->images[0]) : 'https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&q=80&w=800' }}" alt="Room">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">{{ $room->hotel->name }}</h5>
                        <p class="text-muted small mb-4 d-flex align-items-center gap-1">
                            <i class="bi bi-geo-alt icon-sm"></i> {{ $room->hotel->location }}
                        </p>
                        
                        <div class="summary-list d-flex flex-column gap-3 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Room Type</span>
                                <span class="fw-bold small">{{ $room->room_type }}</span>
                            </div>
                            @if($selectedPlan)
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Rate Plan</span>
                                <span class="badge bg-primary-blue bg-opacity-10 text-primary-blue rounded-pill px-3 py-2 small">{{ $selectedPlan['name'] }}</span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Max Capacity</span>
                                <span class="fw-bold small">{{ $room->capacity }} Guests</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-4 bg-light mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark fw-bold">Price per Night</span>
                                <div class="text-end">
                                    <h4 class="fw-bold text-primary-blue mb-0">₹{{ number_format($selectedPlan ? $selectedPlan['price'] : $room->price, 0) }}</h4>
                                    <small class="text-muted">Incl. all taxes</small>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning border-0 rounded-4 p-3 d-flex gap-3 mb-0">
                            <i class="bi bi-info-circle text-warning icon-md flex-shrink-0"></i>
                            <p class="small mb-0 text-dark-50">The final total will be calculated based on your stay duration at the time of arrival.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-muted small">Need help with your booking?</p>
                    <a href="tel:9548436762" class="text-primary-blue fw-bold text-decoration-none d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-star icon-sm"></i> Call +91 9548436762
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.mt-n5 { margin-top: -3rem !important; }
.form-control:focus {
    background-color: #fff !important;
    box-shadow: 0 0 0 4px rgba(45, 91, 255, 0.1) !important;
    border: 1px solid var(--primary-blue) !important;
}
.summary-list > div:not(:last-child) {
    border-bottom: 1px dashed #eee;
    padding-bottom: 0.75rem;
}
</style>
@endsection
