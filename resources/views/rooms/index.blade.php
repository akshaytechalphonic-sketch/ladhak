@extends('layouts.app')

@section('content')
@php
    $banner = $sections['banner'] ?? $sections->first();
@endphp

{{-- Page Header --}}
<div class="page-header" style="background-image: url('{{ $banner && $banner->image ? asset('storage/'.$banner->image) : asset('thumbs/room-header-bg.jpg') }}'); min-height: 380px;">
    <div class="container text-center py-5 mt-3">
        <span class="text-gold text-uppercase fw-bold ls-1 small mb-2 d-block animate__animated animate__fadeInDown">Exclusive Living</span>
        <h1 class="display-3 fw-bold text-white mb-2 family-serif animate__animated animate__fadeInDown">{{ $banner->title ?? 'Our Rooms & Suites' }}</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">{{ $banner->description ?? 'Discover the perfect retreat — crafted for those who appreciate the finest details.' }}</p>
    </div>
</div>

{{-- Filter Bar --}}
<div class="container search-container1 position-relative animate__animated animate__fadeInUp" style="margin-top: -50px; z-index: 10;">
    <div class="card border-0 shadow-premium p-4 rounded-4 bg-white">
        <form action="{{ route('rooms.index') }}" method="GET">
            <div class="row g-3 align-items-center">
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small text-muted fw-bold text-uppercase mb-1"><i class="bi bi-people text-gold me-1"></i> Guests</label>
                    <select name="capacity" class="form-select  fw-bold fs-6 shadow-none">
                        <option value="">Any</option>
                        <option value="1" {{ request('capacity')==1?'selected':'' }}>1 Guest</option>
                        <option value="2" {{ request('capacity')==2?'selected':'' }}>2 Guests</option>
                        <option value="3" {{ request('capacity')==3?'selected':'' }}>3+ Guests</option>
                        <option value="4" {{ request('capacity')==4?'selected':'' }}>4+ Guests</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small text-muted fw-bold text-uppercase mb-1"><i class="bi bi-moon text-gold me-1"></i> Bed Type</label>
                    <select name="bed_type" class="form-select  fw-bold fs-6 shadow-none">
                        <option value="">Any</option>
                        @foreach($bedTypes as $bt)
                        <option value="{{ $bt }}" {{ request('bed_type')==$bt?'selected':'' }}>{{ $bt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small text-muted fw-bold text-uppercase mb-1"><i class="bi bi-eye text-gold me-1"></i> View</label>
                    <select name="view_type" class="form-select fw-bold fs-6 shadow-none">
                        <option value="">Any</option>
                        @foreach($viewTypes as $vt)
                        <option value="{{ $vt }}" {{ request('view_type')==$vt?'selected':'' }}>{{ $vt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small text-muted fw-bold text-uppercase mb-1"><i class="bi bi-currency-rupee text-gold me-1"></i> Max Price (per night)</label>
                    <input type="number" name="max_price" class="form-control  fw-bold fs-6 shadow-none" placeholder="e.g. 10000" value="{{ request('max_price') }}">
                </div>
                <div class="col-12 d-flex gap-2 justify-content-end">
                    <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Clear</a>
                    <button type="submit" class="btn btn-navy rounded-pill px-5 fw-bold"><i class="bi bi-search me-2"></i>Filter Rooms</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Room Listings --}}
<div class="container py-5 mt-4 mb-5">
    <div class="row g-4">
        @forelse($rooms as $room)
        @php $roomImage = !empty($room->images) ? asset('storage/'.$room->images[0]) : asset('thumbs/package-thumb'.rand(1,5).'.jpg'); @endphp
        <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hotel-card-premium">
                <div class="position-relative">
                    <img src="{{ $roomImage }}" class="img-fluid w-100" style="height: 260px; object-fit: cover;" alt="{{ $room->room_type }}">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-navy text-gold px-3 py-2 rounded-pill fw-bold shadow-sm">₹{{ number_format($room->price, 0) }}/night</span>
                    </div>
                    @if($room->bed_type)
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="badge bg-gold text-white px-2 py-1 rounded-pill fw-bold small"><i class="bi bi-moon me-1"></i>{{ $room->bed_type }}</span>
                    </div>
                    @endif
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <h4 class="fw-bold text-navy mb-1">{{ $room->room_type }}</h4>
                    <p class="text-muted small mb-3"><i class="bi bi-building me-1 text-gold"></i>{{ $room->hotel->name ?? 'Luxury Stay' }}</p>

                    <div class="row g-2 mb-3">
                        @if($room->size)
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3">
                                <i class="bi bi-aspect-ratio text-gold"></i>
                                <small class="fw-medium">{{ $room->size }}</small>
                            </div>
                        </div>
                        @endif
                        @if($room->capacity)
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3">
                                <i class="bi bi-people text-gold"></i>
                                <small class="fw-medium">{{ $room->capacity }} Guests</small>
                            </div>
                        </div>
                        @endif
                        @if($room->view_type)
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3">
                                <i class="bi bi-eye text-gold"></i>
                                <small class="fw-medium">{{ $room->view_type }}</small>
                            </div>
                        </div>
                        @endif
                        @if($room->bed_type)
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 bg-light p-2 rounded-3">
                                <i class="bi bi-moon text-gold"></i>
                                <small class="fw-medium">{{ $room->bed_type }} Bed</small>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(!empty($room->inclusions))
                    <div class="mb-3 d-flex flex-wrap gap-1">
                        @foreach(array_slice($room->inclusions, 0, 3) as $inc)
                        <span class="badge bg-success bg-opacity-10 text-success small"><i class="bi bi-check-circle me-1"></i>{{ $inc }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-navy flex-grow-1 rounded-pill fw-bold btn-sm">View Details</a>
                        <a href="{{ route('bookings.create', $room) }}" class="btn btn-gold flex-grow-1 rounded-pill fw-bold btn-sm shadow-sm">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-search text-gold opacity-25 display-1 mb-4 d-block"></i>
            <h3 class="text-navy fw-bold">No Rooms Found</h3>
            <p class="text-muted lead mb-4">Try adjusting your filters to see more options.</p>
            <a href="{{ route('rooms.index') }}" class="btn btn-navy rounded-pill px-5 fw-bold py-3">View All Rooms</a>
        </div>
        @endforelse
    </div>

    @if($rooms->hasPages())
    <div class="d-flex justify-content-center mt-5 pt-4">
        {{ $rooms->links() }}
    </div>
    @endif
</div>
@endsection
