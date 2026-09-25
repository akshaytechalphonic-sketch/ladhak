@extends('layouts.app')

@section('content')
    @php
        $banner = $sections['hotel_banner'] ?? $sections->first();
    @endphp

    <!-- Hotel Header / Banner -->
    <div class="hero-section"
        style="background-image: url('{{ !empty($banner->image) ? asset('storage/' . $banner->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}');">
        <div class="hero-overlay" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6))"></div>
        <div class="container hero-content">
            <div class="fade-up">
                <div class="d-flex gap-1 mb-3 text-warning">
                    @for($i = 1; $i <= ($hotel->star_rating ?? 5); $i++)
                        <i class="bi bi-star icon-sm fill-warning"></i>
                    @endfor
                </div>
                <h1 class="display-3 fw-bold text-white mb-2">{{ $hotel->name }}</h1>
                <p class="lead text-white opacity-90 mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt icon-sm text-primary-blue"></i> {{ $hotel->location }}
                </p>
                @if($hotel->managed_by)
                    <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold small">
                        <i class="bi bi-shield-check icon-sm text-primary-blue me-1"></i> Managed by {{ $hotel->managed_by }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- About the Hotel -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-4">The Experience</h3>
                    <div class="text-muted lh-lg">
                        {!! $hotel->description ?? 'Experience luxury redefined. Every corner of our property is designed to provide you with the ultimate escape.' !!}
                    </div>
                </div>

                <!-- Key Amenities -->
                @if(!empty($hotel->amenities))
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">Hotel Amenities</h4>
                        <div class="row g-3">
                            @php
                                $amenityIcons = [
                                    'wifi' => 'wifi',
                                    'internet' => 'wifi',
                                    'pool' => 'waves',
                                    'swimming' => 'waves',
                                    'parking' => 'car',
                                    'gym' => 'dumbbell',
                                    'fitness' => 'dumbbell',
                                    'spa' => 'sparkles',
                                    'wellness' => 'sparkles',
                                    'breakfast' => 'coffee',
                                    'restaurant' => 'utensils',
                                    'bar' => 'glass-water',
                                    'concierge' => 'user-check',
                                    'airport' => 'plane',
                                    'laundry' => 'wind',
                                    'business' => 'briefcase',
                                ];
                                function getAmenityIcon($amenity, $icons)
                                {
                                    $lower = strtolower($amenity);
                                    foreach ($icons as $key => $icon) {
                                        if (str_contains($lower, $key))
                                            return $icon;
                                    }
                                    return 'check-circle';
                                }
                            @endphp
                            @foreach($hotel->amenities as $amenity)
                                <div class="col-md-4 col-6">
                                    <div
                                        class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border hover-shadow transition-all">
                                        <i class="bi bi-star text-primary-blue icon-sm"></i>
                                        <span class="small fw-bold">{{ $amenity }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Landmarks & Nearby -->
                @if(!empty($hotel->landmarks) || !empty($hotel->airports) || !empty($hotel->attractions))
                    <div class="mb-5 p-4 rounded-5 bg-light-blue border border-primary-blue border-opacity-10">
                        <h4 class="fw-bold mb-4">Nearby & Accessibility</h4>
                        <div class="row g-4">
                            @if(!empty($hotel->landmarks))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                                        <i class="bi bi-map text-primary-blue icon-sm"></i> Landmarks
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->landmarks as $lm)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom border-white">
                                                <span>{{ $lm['name'] ?? '' }}</span>
                                                <span class="fw-bold text-primary-blue">{{ $lm['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty($hotel->airports))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                                        <i class="bi bi-star text-primary-blue icon-sm"></i> Airports
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->airports as $ap)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom border-white">
                                                <span>{{ $ap['name'] ?? '' }}</span>
                                                <span class="fw-bold text-primary-blue">{{ $ap['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty($hotel->attractions))
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                                        <i class="bi bi-camera text-primary-blue icon-sm"></i> Attractions
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($hotel->attractions as $att)
                                            <li class="d-flex justify-content-between mb-2 small pb-2 border-bottom border-white">
                                                <span>{{ $att['name'] ?? '' }}</span>
                                                <span class="fw-bold text-primary-blue">{{ $att['distance'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Map -->
                @if($hotel->map_embed_url)
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">Location Map</h4>
                        <div class="rounded-5 overflow-hidden shadow-sm border" style="height: 400px;">
                            <iframe src="{{ $hotel->map_embed_url }}" width="100%" height="100%" style="border:0;"
                                allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                @if(!empty($hotel->images) && count($hotel->images) > 1)
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">Property Gallery</h4>
                        <div class="row g-3">
                            @foreach(array_slice($hotel->images, 1) as $img)
                                <div class="col-md-6">
                                    <div class="card-premium h-100 shadow-sm border-0" style="height: 250px;">
                                        <img src="{{ asset('storage/' . $img) }}"
                                            class="img-fluid w-100 h-100 object-fit-cover rounded-4" alt="Gallery">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Room Selection Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px; z-index: 5;">
                    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                        <div class="card-header bg-primary-blue text-white p-4 border-0">
                            <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-star icon-md"></i> Available Suites
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="d-flex flex-column">
                                @forelse($hotel->rooms as $room)
                                    <div class="p-4 border-bottom hover-bg-light transition-all">
                                        @if(!empty($room->images))
                                            <div class="rounded-4 overflow-hidden mb-3" style="height: 150px;">
                                                <img src="{{ asset('storage/' . $room->images[0]) }}"
                                                    class="w-100 h-100 object-fit-cover" alt="{{ $room->room_type }}">
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">{{ $room->room_type }}</h6>
                                            <span class="fw-bold text-primary-blue">₹{{ number_format($room->price, 0) }}<small
                                                    class="text-muted">/nt</small></span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            @if($room->bed_type)<span
                                                class="badge bg-light text-dark border-0 small px-2 py-1"><i
                                            class="bi bi-hospital icon-sm me-1 text-primary-blue"></i>{{ $room->bed_type }}</span>@endif
                                            @if($room->capacity)<span
                                                class="badge bg-light text-dark border-0 small px-2 py-1"><i
                                            class="bi bi-people icon-sm me-1 text-primary-blue"></i>{{ $room->capacity }}</span>@endif
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <a href="{{ route('rooms.show', $room) }}"
                                                    class="btn btn-outline-primary-blue btn-sm w-100 rounded-pill fw-bold">Details</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('bookings.create', $room) }}"
                                                    class="btn btn-primary-blue btn-sm w-100 rounded-pill fw-bold">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-5 text-center text-muted">
                                        <i class="bi bi-info-circle icon-md mb-3 d-block mx-auto opacity-20"></i>
                                        <p class="small fw-bold">No suites are currently open for reservation at this property.
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-4 p-4 rounded-5 bg-white border border-primary-blue border-opacity-10 d-flex gap-3 align-items-center">
                        <div class="bg-primary-blue bg-opacity-10 rounded-circle p-3 text-primary-blue">
                            <i class="bi bi-gift icon-md"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Best Rate Guarantee</h6>
                            <p class="small text-muted mb-0">Book directly with us for the lowest prices and exclusive
                                perks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fill-warning {
            fill: #ffc107;
        }

        .hover-bg-light:hover {
            background-color: #f8f9fa;
        }

        .hover-shadow:hover {
            box-shadow: var(--shadow-md);
        }
    </style>
@endsection