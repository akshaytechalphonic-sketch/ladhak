@extends('layouts.app')

@section('title', $package->meta_title ?: ($package->title . ' | Ladakh Tourism'))
@section('meta_description', $package->meta_description ?: ($page->meta_description ?? ''))
@section('meta_keywords', $package->meta_keywords ?: ($page->meta_keywords ?? ''))

@section('content')
<!-- Hero Header Section -->
<div class="py-5 text-white"
    style="background:
        linear-gradient(rgba(167, 99, 125, 0.25), rgba(10, 34, 64, 0.35)),
        url('{{ !empty($package->images) ? asset('storage/'.$package->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}')
        center center / cover no-repeat;
        min-height: 440px;
        display: flex;
        align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2 text-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none opacity-75">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('packages.index') }}" class="text-white text-decoration-none opacity-75">Packages</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $package->title }}</li>
                    </ol>
                </nav>
                <h1 class="fw-bold mb-3 text-white" >{{ $package->title }}</h1>
                <div class="d-flex flex-wrap gap-3 align-items-center small">
                    <span class="badge px-3 py-2 rounded-pill fw-bold text-white" style="background:#C90000;"><i class="bi bi-clock me-1"></i> {{ $package->duration }}</span>
                    <span><i class="bi bi-geo-alt-fill me-1" style="color:#C90000;"></i> Start: {{ $package->start_location ?? 'Leh' }}</span>
                    <span><i class="bi bi-calendar-event me-1" style="color:#C90000;"></i> Best Season: {{ $package->best_season ?? 'May to Sept' }}</span>
                    @if($package->difficulty)
                        <span><i class="bi bi-graph-up-arrow me-1" style="color:#C90000;"></i> Difficulty: {{ $package->difficulty }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <span class="d-block small text-white opacity-75 mb-1">Starting From</span>
                <h2 class="display-5 fw-bold mb-0" style="color:#f4eded;">₹{{ number_format($package->price, 0) }}</h2>
                <span class="small text-white opacity-75">per person</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 px-4 py-3 rounded-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-5">
        <!-- Left Side: Package Details -->
        <div class="col-lg-8">
            <!-- Image Slideshow -->
            @if(!empty($package->images) && count($package->images) > 0)
                <div class="position-relative mb-5 overflow-hidden rounded-4 shadow-sm">
                    <div id="packageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($package->images as $index => $img)
                                <button type="button" data-bs-target="#packageCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($package->images as $index => $img)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="height: 450px;">
                                    <img src="{{ asset('storage/'.$img) }}" class="d-block w-100 h-100 object-fit-cover" alt="Package Image {{ $index+1 }}">
                                </div>
                            @endforeach
                        </div>
                        @if(count($package->images) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#packageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#packageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs nav-fill border-0 mb-4 bg-light p-2 rounded-4" id="packageTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active border-0 rounded-3 fw-bold" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
                        <i class="bi bi-card-text me-2"></i> Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link border-0 rounded-3 fw-bold" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab" aria-controls="itinerary" aria-selected="false">
                        <i class="bi bi-map me-2"></i> Itinerary
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link border-0 rounded-3 fw-bold" id="inc-exc-tab" data-bs-toggle="tab" data-bs-target="#inc-exc" type="button" role="tab" aria-controls="inc-exc" aria-selected="false">
                        <i class="bi bi-check-circle me-2"></i> Inclusions
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="packageTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white mb-4">
                        <h3 class="fw-bold mb-4 text-dark-blue">About This Tour</h3>
                        <div class="description-content text-muted">
                            {!! $package->description !!}
                        </div>
                    </div>
                </div>

                <!-- Itinerary Tab -->
                <div class="tab-pane fade" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                    <div class="card border-0 shadow-sm p-4 rounded-4 bg-white mb-4">
                        <h3 class="fw-bold mb-4 text-dark-blue">Tour Itinerary</h3>
                        
                        @if(!empty($package->itinerary) && count($package->itinerary) > 0)
                            <div class="itinerary-timeline position-relative ps-4 border-start border-2 ms-2 mt-3">
                                @foreach($package->itinerary as $day)
                                    <div class="itinerary-item position-relative mb-4 pb-2">
                                        <!-- Node dot -->
                                        <div class="position-absolute start-0 translate-middle bg-primary-blue rounded-circle border border-white border-3" style="width: 16px; height: 16px; left: -16px !important; top: 12px;"></div>
                                        
                                        <span class="badge bg-light-blue text-primary-blue fw-bold mb-2">{{ $day['day'] ?? 'Day X' }}</span>
                                        <h5 class="fw-bold mb-2 text-dark-blue">{{ $day['title'] ?? 'Day Title' }}</h5>
                                        <p class="text-muted small mb-0">{{ $day['description'] ?? 'Day details...' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Itinerary details will be provided by our tour planner shortly.</p>
                        @endif
                    </div>
                </div>

                <!-- Inclusions Tab -->
                <div class="tab-pane fade" id="inc-exc" role="tabpanel" aria-labelledby="inc-exc-tab">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100" style="border-top: 4px solid #198754 !important;">
                                <h4 class="fw-bold text-success mb-4"><i class="bi bi-check-circle-fill me-2"></i> Inclusions</h4>
                                @if(!empty($package->inclusions) && count($package->inclusions) > 0)
                                    <ul class="list-unstyled">
                                        @foreach($package->inclusions as $inc)
                                            <li class="mb-3 d-flex align-items-start gap-2">
                                                <i class="bi bi-check-lg text-success mt-1"></i>
                                                <span class="text-muted small">{{ $inc }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted small">Standard inclusions apply. Please enquire for details.</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white h-100" style="border-top: 4px solid #dc3545 !important;">
                                <h4 class="fw-bold text-danger mb-4"><i class="bi bi-x-circle-fill me-2"></i> Exclusions</h4>
                                @if(!empty($package->exclusions) && count($package->exclusions) > 0)
                                    <ul class="list-unstyled">
                                        @foreach($package->exclusions as $exc)
                                            <li class="mb-3 d-flex align-items-start gap-2">
                                                <i class="bi bi-x-lg text-danger mt-1"></i>
                                                <span class="text-muted small">{{ $exc }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted small">Personal expenses are excluded.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Booking Enquiry Form & Related -->
        <div class="col-lg-4">
            <!-- Enquiry Card -->
            <div class="card border-0 shadow-lg p-4 rounded-4 bg-white sticky-top" style="top: 100px; z-index: 10;">
                <h4 class="fw-bold mb-3 text-dark-blue"><i class="bi bi-envelope-open text-primary-blue me-2"></i> Booking Enquiry</h4>
                <p class="text-muted small mb-4">Send us an enquiry to customize and book this tour. No payment required online.</p>
                
                <form action="{{ route('packages.enquire', $package) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Your Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required value="{{ old('name') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Email Address *</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Phone Number *</label>
                        <input type="text" name="phone" class="form-control" placeholder="+91 99999 99999" required value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Travel Date *</label>
                        <input type="date" name="travel_date" class="form-control" required min="{{ date('Y-m-d') }}" value="{{ old('travel_date') }}">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Adults *</label>
                            <input type="number" name="adults" class="form-control" min="1" value="{{ old('adults', 2) }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Children</label>
                            <input type="number" name="children" class="form-control" min="0" value="{{ old('children', 0) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Special Requests</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Tell us about customizations, hotel preference, bike preference etc.">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-blue w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2 shadow-md">
                        <i class="bi bi-send-fill"></i> Submit Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Related Packages -->
    @if($relatedPackages->count() > 0)
        <div class="py-5 mt-5">
            <h3 class="fw-bold mb-4 text-dark-blue">Other Packages You Might Like</h3>
            <div class="row g-4">
                @foreach($relatedPackages as $rp)
                    <div class="col-md-4">
                        <div class="card card-premium shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                            <div class="card-img-wrapper" style="height: 180px;">
                                <img src="{{ !empty($rp->images) ? asset('storage/'.$rp->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="{{ $rp->title }}">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <span class="badge bg-light text-dark border px-2 py-1 rounded small mb-2 d-inline-block align-self-start">{{ $rp->duration }}</span>
                                <h5 class="fw-bold mb-2 text-dark-blue text-truncate">{{ $rp->title }}</h5>
                                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top mt-3">
                                    <span class="fw-bold text-primary-blue">₹{{ number_format($rp->price, 0) }}</span>
                                    <a href="{{ route('packages.show', $rp->slug) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
