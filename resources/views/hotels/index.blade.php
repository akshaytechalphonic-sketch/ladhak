@extends('layouts.app')
@section('content')
<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{$sections['hotel_banner']->image ? asset('storage/'.$sections['hotel_banner']->image) : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 40vh; padding: 120px 0 60px;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <h1 class="display-3 fw-bold text-white mb-3">{{ $sections['hotel_banner']->title ?? 'Our Signature Hotels' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{{ strip_tags($sections['hotel_banner']->description ?? 'Discover the perfect blend of architectural grandeur and refined comfort across our premium properties.') }}</p>
        </div>
    </div>
</div>

<!-- Search Bar Overlay -->
<div class="container" style="margin-top: -40px; position: relative; z-index: 10;">
    <div class="glass-morphism p-3 rounded-pill shadow-lg mx-auto max-w-800 border-white bg-white">
        <form action="{{ route('hotels.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-9 px-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-search text-primary-blue me-3 icon-sm"></i>
                        <input type="text" name="location" class="form-control border-0 shadow-none p-0 fw-semibold text-dark" placeholder="Search by destination or hotel name..." value="{{ request('location') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary-blue w-100 py-2 rounded-pill fw-bold">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container py-5 mt-4">
    <div class="row g-4">
        @forelse($hotels as $hotel)
        <div class="col-lg-4 col-md-6">
            <div class="card-premium shadow-sm h-100">
                <div class="card-img-wrapper">
                    @php
                        $coverImage = !empty($hotel->images) ? asset('storage/'.$hotel->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800';
                    @endphp
                    <img src="{{ $coverImage }}" alt="{{ $hotel->name }}">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-star icon-sm text-warning fill-warning me-1"></i> 4.9
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-2 text-primary-blue small fw-bold">
                        <i class="bi bi-geo-alt icon-sm"></i> {{ $hotel->location }}
                    </div>
                    <h6 class="fw-bold mb-3">{{ $hotel->name }}</h6>
                    <p class="text-muted small mb-4 line-clamp-3">{{ strip_tags($hotel->description) }}</p>
                    
                    <div class="d-flex gap-3 mb-4 text-muted border-bottom pb-4">
                        <div class="d-flex align-items-center gap-1" data-bs-toggle="tooltip" title="Free WiFi">
                            <i class="bi bi-wifi icon-sm"></i>
                        </div>
                        <div class="d-flex align-items-center gap-1" data-bs-toggle="tooltip" title="Pool">
                            <i class="bi bi-water icon-sm"></i>
                        </div>
                        <div class="d-flex align-items-center gap-1" data-bs-toggle="tooltip" title="Parking">
                            <i class="bi bi-car-front icon-sm"></i>
                        </div>
                        <div class="d-flex align-items-center gap-1" data-bs-toggle="tooltip" title="Restaurant">
                            <i class="bi bi-cup-hot icon-sm"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block">Starting from</span>
                            <span class="h4 fw-bold mb-0 text-primary-blue">₹{{ rand(2999, 5999) }}</span>
                            <small class="text-muted">/night</small>
                        </div>
                        <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-primary-blue rounded-pill px-4">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-5">
                <i class="bi bi-search icon-md text-muted mb-3" style="width: 64px; height: 64px;"></i>
                <h3 class="text-dark fw-bold">No results found</h3>
                <p class="text-muted">We couldn't find any hotels matching your search. Try adjusting your filters.</p>
                <a href="{{ route('hotels.index') }}" class="btn btn-primary-blue rounded-pill px-5 mt-3">Reset Search</a>
            </div>
        </div>
        @endforelse
    </div>
    
    @if($hotels->hasPages())
    <div class="d-flex justify-content-center mt-5 pt-4">
        {{ $hotels->links() }}
    </div>
    @endif
</div>

<style>
.max-w-800 { max-width: 800px; }
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.fill-warning { fill: #ffc107; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush
@endsection
