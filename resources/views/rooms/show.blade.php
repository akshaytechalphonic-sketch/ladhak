@extends('layouts.app')

@section('content')
@php
    $primaryImage = !empty($room->images) ? asset('storage/'.$room->images[0]) : 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=1200';
    $galleryImages = !empty($room->images) ? $room->images : [];
    $ratePlanLabels = [
        'non_refundable' => ['label' => 'Non-Refundable', 'color' => '#dc3545', 'icon' => 'lock'],
        'flexible'       => ['label' => 'Free Cancellation', 'color' => '#198754', 'icon' => 'shield-check'],
        'bb'             => ['label' => 'Bed & Breakfast', 'color' => '#0dcaf0', 'icon' => 'coffee'],
        'half_board'     => ['label' => 'Half Board', 'color' => '#0d6efd', 'icon' => 'utensils'],
        'full_board'     => ['label' => 'Full Board', 'color' => '#ffc107', 'icon' => 'shopping-basket'],
        'package'        => ['label' => 'Special Package', 'color' => '#6c757d', 'icon' => 'gift'],
    ];
@endphp

<!-- Room Header / Gallery -->
<div class="bg-white">
    <div class="container-fluid p-0">
        <div class="row g-2">
            <div class="col-lg-8">
                <div class="gallery-main" style="height: 600px; overflow: hidden;">
                    <img src="{{ $primaryImage }}" class="w-100 h-100 object-fit-cover rounded-end-lg-0" alt="{{ $room->room_type }}">
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="row g-2 h-100">
                    <div class="col-12 h-50">
                        <img src="{{ isset($galleryImages[1]) ? asset('storage/'.$galleryImages[1]) : 'https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="Room View 2">
                    </div>
                    <div class="col-12 h-50">
                        <div class="position-relative h-100">
                            <img src="{{ isset($galleryImages[2]) ? asset('storage/'.$galleryImages[2]) : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="Room View 3">
                            @if(count($galleryImages) > 3)
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center text-white cursor-pointer" onclick="openGallery()">
                                <div class="text-center">
                                    <i class="bi bi-image icon-md mb-2"></i>
                                    <h5 class="fw-bold mb-0">+{{ count($galleryImages) - 3 }} Photos</h5>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <!-- Left Column: Details -->
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary-blue text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}" class="text-primary-blue text-decoration-none">Rooms</a></li>
                    <li class="breadcrumb-item active">{{ $room->room_type }}</li>
                </ol>
            </nav>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                <div>
                    <h1 class="display-5 fw-bold mb-2">{{ $room->room_type }}</h1>
                    <p class="text-muted mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt icon-sm text-primary-blue"></i>
                        {{ $room->hotel->name ?? '' }} &bull; {{ $room->hotel->location ?? '' }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary-blue rounded-circle p-3"><i class="bi bi-share icon-sm"></i></button>
                    <button class="btn btn-outline-primary-blue rounded-circle p-3"><i class="bi bi-heart icon-sm"></i></button>
                </div>
            </div>

            <hr class="my-5 opacity-10">

            <!-- Room Features -->
            <div class="row g-4 mb-5 text-center">
                <div class="col-3 col-md-3">
                    <div class="p-3 rounded-4 bg-light">
                        <i class="bi bi-arrows-fullscreen icon-md text-primary-blue mb-2"></i>
                        <span class="d-block small text-muted">Size</span>
                        <span class="fw-bold">{{ $room->size ?? '45m²' }}</span>
                    </div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="p-3 rounded-4 bg-light">
                        <i class="bi bi-hospital icon-md text-primary-blue mb-2"></i>
                        <span class="d-block small text-muted">Bed</span>
                        <span class="fw-bold">{{ $room->bed_type ?? 'King' }}</span>
                    </div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="p-3 rounded-4 bg-light">
                        <i class="bi bi-people icon-md text-primary-blue mb-2"></i>
                        <span class="d-block small text-muted">Max</span>
                        <span class="fw-bold">{{ $room->capacity ?? 2 }} Guests</span>
                    </div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="p-3 rounded-4 bg-light">
                        <i class="bi bi-image-alt icon-md text-primary-blue mb-2"></i>
                        <span class="d-block small text-muted">View</span>
                        <span class="fw-bold">{{ $room->view_type ?? 'Garden' }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-5">
                <h4 class="fw-bold mb-4">About This Sanctuary</h4>
                <div class="text-muted lh-lg">
                    {!! $room->description !!}
                </div>
            </div>

            <!-- Amenities -->
            <div class="mb-5">
                <h4 class="fw-bold mb-4">Room Amenities</h4>
                <div class="row g-3">
                    @php 
                        $amenities = [
                            ['label' => 'High-Speed WiFi', 'icon' => 'wifi'],
                            ['label' => 'Smart TV with Netflix', 'icon' => 'tv'],
                            ['label' => 'Climate Control AC', 'icon' => 'thermometer-snowflake'],
                            ['label' => 'Mini Bar & Snacks', 'icon' => 'refrigerator'],
                            ['label' => 'Luxury Toileteries', 'icon' => 'sparkles'],
                            ['label' => 'Room Service 24/7', 'icon' => 'bell'],
                            ['label' => 'Digital Safe', 'icon' => 'shield-check'],
                            ['label' => 'Coffee & Tea Maker', 'icon' => 'coffee']
                        ];
                    @endphp
                    @foreach($amenities as $amenity)
                    <div class="col-md-6 col-lg-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-star icon-sm text-primary-blue"></i>
                            <span class="text-muted small">{{ $amenity['label'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Inclusions -->
            @if(!empty($room->inclusions))
            <div class="mb-5 p-4 rounded-4 bg-light-blue border-primary-blue border-opacity-10 border">
                <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle text-success icon-md"></i> Included in Your Stay
                </h5>
                <div class="row g-3">
                    @foreach($room->inclusions as $inc)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 small fw-semibold">
                            <i class="bi bi-check text-success icon-sm"></i> {{ $inc }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column: Booking Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 5;">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <span class="text-muted small">Price starts from</span>
                            <div class="d-flex align-items-baseline gap-2">
                                <h2 class="fw-bold mb-0 text-primary-blue">₹{{ number_format($room->price, 0) }}</h2>
                                <span class="text-muted">/night</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3 small text-uppercase ls-1">Choose a Rate Plan</h6>
                            <div class="d-flex flex-column gap-3">
                                @forelse($room->rate_plans ?? [] as $plan)
                                @php $meta = $ratePlanLabels[$plan['type'] ?? 'flexible'] ?? ['label'=>'Standard Rate','color'=>'#2D5BFF','icon'=>'tag']; @endphp
                                <label class="rate-plan-option border p-3 rounded-4 cursor-pointer transition-all hover-shadow">
                                    <input type="radio" name="plan" value="{{ $plan['type'] ?? '' }}" class="d-none" onchange="updatePrice('{{ $plan['price'] ?? $room->price }}', '{{ $plan['name'] }}')">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-star icon-sm" style="color: {{ $meta['color'] }}"></i>
                                            <span class="fw-bold small">{{ $plan['name'] }}</span>
                                        </div>
                                        <span class="badge rounded-pill px-2 py-1 small" style="background-color: {{ $meta['color'] }}20; color: {{ $meta['color'] }}">{{ $meta['label'] }}</span>
                                    </div>
                                    @if(!empty($plan['price']))
                                    <div class="fw-bold text-dark">₹{{ number_format($plan['price'], 0) }} <small class="text-muted fw-normal">/night</small></div>
                                    @endif
                                </label>
                                @empty
                                <div class="text-muted small p-2 bg-light rounded-3">Standard rate applies for this room.</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <a id="bookNowBtn" href="{{ route('bookings.create', $room) }}" class="btn btn-primary-blue btn-lg py-3 rounded-pill fw-bold">Book This Sanctuary</a>
                            <p class="text-center text-muted small mb-0"><i class="bi bi-info-circle icon-sm me-1"></i> No immediate payment required</p>
                        </div>
                    </div>
                </div>

                <!-- Hotel Mini Info -->
                @if($room->hotel)
                <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ !empty($room->hotel->images) ? asset('storage/'.$room->hotel->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=200' }}" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $room->hotel->name }}</h6>
                            <div class="d-flex gap-1 text-warning">
                                @for($i=1; $i<=5; $i++)
                                <i class="bi bi-star icon-sm fill-warning"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-muted small mb-4">{{ Str::limit(strip_tags($room->hotel->description), 120) }}</p>
                    <a href="{{ route('hotels.show', $room->hotel_id) }}" class="btn btn-outline-primary-blue w-100 rounded-pill small fw-bold">Explore Property</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Rooms -->
    @if($relatedRooms->count() > 0)
    <div class="mt-5 pt-5">
        <h4 class="fw-bold mb-4">Other Rooms at This Property</h4>
        <div class="row g-4">
            @foreach($relatedRooms as $rel)
            <div class="col-md-4">
                <a href="{{ route('rooms.show', $rel) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hotel-card-premium">
                        <div class="card-img-wrapper" >
                            <img class="w-100" style="height:190px;object-fit:cover;" src="{{ !empty($rel->images) ? asset('storage/'.$rel->images[0]) : 'https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $rel->room_type }}">
                        </div>
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-2">{{ $rel->room_type }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary-blue">₹{{ number_format($rel->price, 0) }} <small class="text-muted">/nt</small></span>
                                <span class="btn btn-link text-primary-blue p-0 fw-bold small">View <i class="bi bi-chevron-right icon-sm"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
.gallery-main img { border-radius: 24px; }
.rate-plan-option {
    border: 2px solid #eee !important;
    position: relative;
}
.rate-plan-option:hover { border-color: var(--primary-blue) !important; }
.rate-plan-option input:checked + div, 
.rate-plan-option:has(input:checked) {
    border-color: var(--primary-blue) !important;
    background-color: var(--light-blue) !important;
}
.cursor-pointer { cursor: pointer; }
.fill-warning { fill: #ffc107; }
</style>

@push('scripts')
<script>
    function updatePrice(price, planName) {
        // Update URL of the book now button
        const baseUrl = "{{ route('bookings.create', $room) }}";
        const plan = planName.toLowerCase().replace(/ /g, '_');
        document.getElementById('bookNowBtn').href = `${baseUrl}?plan=${plan}`;
    }

    // Handle plan selection visually
    document.querySelectorAll('.rate-plan-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.rate-plan-option').forEach(o => o.style.borderColor = '#eee');
            this.style.borderColor = 'var(--primary-blue)';
        });
    });
</script>
@endpush
@endsection
