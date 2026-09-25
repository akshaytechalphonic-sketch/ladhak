@extends('layouts.app')

@push('styles')
<style>
/* ===== SERVICE DETAIL BANNER ===== */
.service-hero {
    position: relative;
    min-height: 480px;
    display: flex;
    align-items: flex-end;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    overflow: hidden;
}

/* dark gradient overlay - stronger at bottom */
.service-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(11,34,64,0.35) 0%,
        rgba(11,34,64,0.55) 40%,
        rgba(11,34,64,0.92) 100%
    );
    z-index: 1;
}

/* subtle red accent line at top */
.service-hero::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(to right, #C90000, #ff4444, #C90000);
    z-index: 3;
}

.service-hero-content {
    position: relative;
    z-index: 2;
    padding-bottom: 56px;
    padding-top: 48px;
    width: 100%;
}

/* Breadcrumb in hero */
.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}
.hero-breadcrumb a,
.hero-breadcrumb span {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    transition: color 0.2s;
}
.hero-breadcrumb a:hover { color: #fff; }
.hero-breadcrumb .sep { color: rgba(255,255,255,0.3); }
.hero-breadcrumb .current { color: rgba(255,255,255,0.9); }

/* Category pill */
.service-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(201,0,0,0.25);
    border: 1px solid rgba(201,0,0,0.5);
    color: #ffaaaa;
    padding: 5px 16px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 16px;
}

.service-hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 16px;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.service-hero-desc {
    color: rgba(255,255,255,0.78);
    font-size: 1rem;
    max-width: 600px;
    line-height: 1.7;
    margin-bottom: 28px;
}

/* Stats strip at bottom of banner */
.hero-stats-strip {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}
.hero-stat {
    display: flex;
    align-items: center;
    gap: 10px;
}
.hero-stat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: rgba(255,255,255,0.12);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    color: #ffaaaa;
    flex-shrink: 0;
}
.hero-stat-text strong {
    display: block;
    color: #fff;
    font-size: 0.92rem;
    font-weight: 700;
    line-height: 1.2;
}
.hero-stat-text span {
    color: rgba(255,255,255,0.5);
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* CTA buttons in hero */
.hero-cta-row {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.btn-hero-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #C90000;
    color: #fff;
    font-weight: 700;
    font-size: 0.88rem;
    letter-spacing: 0.5px;
    padding: 12px 28px;
    border-radius: 50px;
    text-decoration: none;
    border: none;
    box-shadow: 0 8px 24px rgba(201,0,0,0.35);
    transition: all 0.3s;
}
.btn-hero-primary:hover {
    background: #a30000;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(201,0,0,0.45);
}
.btn-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.12);
    color: #fff;
    font-weight: 600;
    font-size: 0.88rem;
    padding: 12px 28px;
    border-radius: 50px;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.35);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    transition: all 0.3s;
}
.btn-hero-outline:hover {
    background: rgba(255,255,255,0.22);
    color: #fff;
    border-color: rgba(255,255,255,0.6);
}

/* divider line in stats */
.hero-divider {
    width: 1px;
    height: 36px;
    background: rgba(255,255,255,0.15);
    display: none;
}
@media (min-width: 576px) { .hero-divider { display: block; } }
@media (max-width: 575px) {
    .service-hero { min-height: 400px; background-attachment: scroll; }
    .hero-stats-strip { gap: 16px; }
}
</style>
@endpush

@section('content')

{{-- ===== HERO BANNER ===== --}}
<div class="service-hero"
     style="background-image: url('{{ $service->image ? asset('storage/'.$service->image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&q=80&w=1920' }}');">

    <div class="container service-hero-content">

        {{-- Breadcrumb --}}
        <nav class="hero-breadcrumb">
            <a href="{{ route('home') }}"><i class="bi bi-house-fill me-1"></i>Home</a>
            <span class="sep">/</span>
            <a href="{{ route('services.index') }}">Services</a>
            <span class="sep">/</span>
            <span class="current">{{ $service->title }}</span>
        </nav>

        {{-- Category pill --}}
        <div class="service-category-pill">
            <i class="bi bi-stars"></i> Premium Offering
        </div>

        {{-- Title --}}
        <h1>{{ $service->title }}</h1>

        {{-- Short description --}}
        @if($service->description)
        <p class="service-hero-desc">
            {{ Str::limit(strip_tags($service->description), 140) }}
        </p>
        @endif

        {{-- CTA Buttons --}}
        <div class="hero-cta-row">
            <a href="#packages" class="btn-hero-primary">
                <i class="bi bi-compass"></i> View Packages
            </a>
            <a href="{{ route('contact') }}" class="btn-hero-outline">
                <i class="bi bi-telephone"></i> Get Custom Quote
            </a>
        </div>

        {{-- Stats strip --}}
        <div class="hero-stats-strip">
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-box-seam"></i></div>
                <div class="hero-stat-text">
                    <strong>{{ $packages->total() }} Package{{ $packages->total() != 1 ? 's' : '' }}</strong>
                    <span>Available</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-shield-check"></i></div>
                <div class="hero-stat-text">
                    <strong>100% Safe</strong>
                    <span>Verified Tours</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-headset"></i></div>
                <div class="hero-stat-text">
                    <strong>24/7 Support</strong>
                    <span>Expert Guidance</span>
                </div>
            </div>
            <div class="hero-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-icon"><i class="bi bi-currency-rupee"></i></div>
                <div class="hero-stat-text">
                    <strong>Best Price</strong>
                    <span>Guaranteed</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="container py-5 mt-2" id="packages">
    <div class="row g-5">
        <div class="col-lg-12">
            <h2 class="fw-bold text-navy mb-4">
                Explore Our <span style="color:#C90000;">{{ $service->title }}</span> Services
            </h2>
            <div class="lead text-muted mb-5">
                {!! $service->description !!}
            </div>

            <!-- Packages List Section -->
            <div class="mt-5">
                <h3 class="fw-bold mb-4 pb-2 border-bottom" style="color: var(--primary-blue);">Available Tour Packages</h3>

                <div class="d-flex flex-column gap-4">
                    @forelse($packages as $pkg)
                    @php
                        $pkgImages = [
                            'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800'
                        ];
                        $coverImg = $pkg->images && count($pkg->images) > 0 ? asset('storage/'.$pkg->images[0]) : $pkgImages[$loop->index % count($pkgImages)];
                    @endphp

                    <div class="card border rounded-4 overflow-hidden shadow-sm" style="transition: all 0.3s ease;">
                        <div class="row g-0">
                            <!-- Package Details -->
                            <div class="col-md-7 col-lg-8 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h4 class="fw-bold mb-3" style="color: #C90000; text-transform: uppercase; letter-spacing: 0.5px;">{{ $pkg->title }}</h4>

                                    <div class="row g-3 mb-4">
                                        <div class="col-6 col-sm-4">
                                            <span class="text-muted d-block small text-uppercase fw-semibold" style="font-size: 10px;">Duration</span>
                                            <span class="fw-bold text-dark"><i class="bi bi-clock me-1" style="color:#C90000;"></i> {{ $pkg->duration }}</span>
                                        </div>
                                        @if($pkg->best_season)
                                        <div class="col-6 col-sm-4">
                                            <span class="text-muted d-block small text-uppercase fw-semibold" style="font-size: 10px;">Best Season</span>
                                            <span class="fw-bold text-dark"><i class="bi bi-sun me-1" style="color:#C90000;"></i> {{ $pkg->best_season }}</span>
                                        </div>
                                        @endif
                                        @if($pkg->difficulty)
                                        <div class="col-6 col-sm-4">
                                            <span class="text-muted d-block small text-uppercase fw-semibold" style="font-size: 10px;">Grade</span>
                                            <span class="fw-bold text-dark"><i class="bi bi-bar-chart me-1" style="color:#C90000;"></i> {{ $pkg->difficulty }}</span>
                                        </div>
                                        @endif
                                        @if($pkg->start_location)
                                        <div class="col-6 col-sm-4">
                                            <span class="text-muted d-block small text-uppercase fw-semibold" style="font-size: 10px;">Start Location</span>
                                            <span class="fw-bold text-dark"><i class="bi bi-geo me-1" style="color:#C90000;"></i> {{ $pkg->start_location }}</span>
                                        </div>
                                        @endif
                                        @if($pkg->destination)
                                        <div class="col-12 col-sm-8">
                                            <span class="text-muted d-block small text-uppercase fw-semibold" style="font-size: 10px;">Destinations Covered</span>
                                            <span class="fw-bold text-dark"><i class="bi bi-map me-1" style="color:#C90000;"></i> {{ $pkg->destination->name }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <p class="text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit(strip_tags($pkg->description), 200) }}</p>
                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 pt-3 border-top">
                                    <div>
                                        <span class="text-muted small">Starts from: </span>
                                        <span class="h4 fw-bold mb-0" style="color:#0B2240;">₹{{ number_format($pkg->price) }}</span>
                                        <small class="text-muted">/ person</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('packages.show', $pkg->slug) }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold" style="font-size:0.8rem;">VIEW DETAILS</a>
                                        <a href="{{ route('packages.show', $pkg->slug) }}#enquiry-form" class="btn rounded-pill px-4 fw-bold" style="background:#C90000; color:#fff; font-size:0.8rem; border:none;">BOOK NOW</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Package Image -->
                            <div class="col-md-5 col-lg-4 position-relative" style="min-height: 250px;">
                                <img src="{{ $coverImg }}" alt="{{ $pkg->title }}" class="w-100 h-100 object-fit-cover">
                                @if($pkg->duration)
                                <div class="position-absolute top-0 end-0 m-3 text-white rounded-circle d-flex align-items-center justify-content-center flex-column shadow"
                                     style="width:70px; height:70px; background:#C90000;">
                                    <span class="fw-bold h5 mb-0" style="line-height:1;">{{ filter_var($pkg->duration, FILTER_SANITIZE_NUMBER_INT) ?: '12' }}</span>
                                    <span class="small" style="font-size:9px; text-transform:uppercase;">Days</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted bg-light rounded-4">
                        <i class="bi bi-compass display-4"></i>
                        <p class="mt-3">No packages are currently listed under this service category.</p>
                    </div>
                    @endforelse
                </div>

                @if($packages->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $packages->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
