@extends('layouts.app')

@push('preload')
    <link rel="preload" as="image"
        href="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&q=80&w=1920">
@endpush

@push('styles')
    <style>
        .hero-ladakh {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: url('{{ !empty($sections['hero']->image)
                ? asset('storage/' . $sections['hero']->image)
                : 'https://images.unsplash.com/photo-1584555684040-bad2a46f1d75?auto=format&fit=crop&q=80&w=1920' }}') center/cover no-repeat;
            overflow: hidden;
        }

        .hero-ladakh::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 34, 64, 0.85) 0%, rgba(10, 34, 64, 0.5) 60%, rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .hero-ladakh .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(201, 0, 0, 0.1);
            border: 1px solid var(--secondary-blue);
            color: var(--secondary-blue);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero-title .accent {
            color: var(--secondary-blue);
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.15rem;
            max-width: 560px;
        }

        .btn-gold {
            background: linear-gradient(135deg, #C90000, #a30000);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(201, 0, 0, 0.3);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(201, 0, 0, 0.45);
            color: #fff;
            background: linear-gradient(135deg, #a30000, #8b0000);
        }

        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.6);
            color: #fff;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            background: transparent;
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            border-color: #fff;
        }

        /* ===== STATS BAR ===== */
        .stats-bar {
            background: var(--primary-blue);
            padding: 28px 0;
        }

        .stat-item {
            text-align: center;
            padding: 0 2rem;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-num {
            font-size: 2rem;
            font-weight: 800;
            color: var(--secondary-blue);
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.65);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== SECTION HEADER ===== */
        .section-badge {
            color: var(--secondary-blue);
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            color: var(--primary-blue);
        }

        /* ===== PACKAGES ===== */
        .package-card {
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.35s;
            height: 100%;
        }

        .package-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(11, 34, 64, 0.15);
        }

        .package-card .img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4/3;
        }

        .package-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .package-card:hover .img-wrap img {
            transform: scale(1.08);
        }

        .pkg-difficulty {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(11, 34, 64, 0.85);
            color: #fff;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 600;
        }

        .pkg-duration {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(201, 0, 0, 0.9);
            color: #fff;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
        }

        .package-card .card-body {
            padding: 1.15rem;
        }

        .package-card .card-body h5 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.45;
        }

        .package-card .card-body p {
            font-size: 0.8rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            color: #6c757d;
        }

        .pkg-price {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-blue);
        }

        .pkg-price small {
            font-size: 0.68rem;
            font-weight: 400;
            color: #6c757d;
        }

        .pkg-meta span {
            font-size: 0.72rem;
            color: #6c757d;
        }

        .package-card .btn-gold {
            padding: 6px 14px;
            font-size: 0.75rem;
            border-radius: 30px;
        }

        /* ===== DESTINATIONS ===== */
        /* (moved to inline section styles in destinations carousel section) */

        /* ===== WHY US ===== */
        .why-card {
            background: #fff;
            border-radius: 18px;
            padding: 2rem 1.5rem;
            border: 1px solid #eef0f3;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }

        .why-card:hover {
            border-color: var(--secondary-blue);
            box-shadow: 0 10px 30px rgba(201, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .why-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue), #1a3a5c);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.6rem;
            color: var(--secondary-blue);
        }

        /* ===== TESTIMONIALS ===== */
        .testimonial-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid #eef0f3;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .quote-icon {
            font-size: 3rem;
            color: var(--secondary-blue);
            line-height: 1;
            margin-bottom: 1rem;
        }

        .stars {
            color: #F59E0B;
        }

        /* ===== CTA ===== */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #1a3a5c 100%);
            position: relative;
            overflow: hidden;
            padding: 80px 0;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1584555684040-bad2a46f1d75?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat;
            opacity: 0.1;
        }

        .cta-section .container {
            position: relative;
            z-index: 2;
        }
    </style>
@endpush

@section('content')
    {{-- ===== 1. HERO ===== --}}
    <section class="hero-ladakh">
        <div class="container hero-content">
            <div class="row justify-content-start">
                <div class="col-lg-7">
                    <div class="hero-badge">&#9650; Land of High Passes</div>
                    <h1 class="hero-title">

                        {{ $sections['hero']->title ?? 'Discover the Beauty of Ladakh' }}
                    </h1>
                    <div class="hero-desc mb-4">
                        {!! $sections['hero']->description ??
                            'Premium bike expeditions, luxury stays, and curated Himalayan tour packages with local expertise.' !!}
                    </div>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('packages.index') }}" class="btn btn-gold">
                            <i
                                class="bi bi-compass me-2"></i>{{ $sections['hero']->extra_data['button_text'] ?? 'Explore Packages' }}
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-white">
                            <i
                                class="bi bi-telephone me-2"></i>{{ $sections['hero']->extra_data['sub_title'] ?? 'Plan My Trip' }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ===== 2. STATS BAR ===== --}}
    <div class="stats-bar">
        <div class="container">
            <div class="row justify-content-center">
                @php
                    $stats = [
                        ['num' => '15+', 'label' => 'Custom Routes'],
                        ['num' => '5000+', 'label' => 'Happy Travelers'],
                        ['num' => '12+', 'label' => 'Years in Ladakh'],
                        ['num' => '100%', 'label' => 'Safe Journeys'],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-num">{{ $stat['num'] }}</div>
                            <div class="stat-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== 3. FEATURED PACKAGES ===== --}}
    <section class="py-6" style="padding: 80px 0; background: #F8F9FA;">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-badge mb-2">&#9650; Our Curated Collection</div>
                <h2 class="section-title">{{ $sections['our_collection']->title ?? 'Premium Tour Packages' }}</h2>
                <div class="text-muted mx-auto" style="max-width:560px; margin-top:12px;">
                    {!! $sections['our_collection']->description ??
                        'Explore our handpicked selection of Ladakh tours, designed for adventure seekers and luxury travelers alike.' !!}
                </div>
            </div>
            <div class="row g-4">
                @forelse($featuredPackages as $pkg)
                    <div class="col-md-6 col-lg-3">
                        <div class="package-card">
                            <div class="img-wrap">
                                @php
                                    $pkgImages = [
                                        'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=800',
                                        'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=800',
                                        'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800',
                                    ];
                                @endphp
                                <img src="{{ $pkg->images && count($pkg->images) > 0 ? asset('storage/' . $pkg->images[0]) : $pkgImages[$loop->index % 3] }}"
                                    alt="{{ $pkg->title }}" loading="lazy">
                                @if ($pkg->difficulty)
                                    <span class="pkg-difficulty">{{ $pkg->difficulty }}</span>
                                @endif
                                <span class="pkg-duration"><i class="bi bi-clock me-1"></i>{{ $pkg->duration }}</span>
                            </div>
                            <div class="card-body">
                                <div class="pkg-meta d-flex align-items-center gap-2 mb-2">
                                    @if ($pkg->destination)
                                        <span><i class="bi bi-geo-alt me-1"
                                                style="color:#C90000;"></i>{{ Str::limit($pkg->destination->name, 14) }}</span>
                                    @endif
                                    @if ($pkg->best_season)
                                        <span><i class="bi bi-sun me-1"
                                                style="color:#C90000;"></i>{{ $pkg->best_season }}</span>
                                    @endif
                                </div>
                                <h5>{{ $pkg->title }}</h5>
                                <p>{{ Str::limit(strip_tags($pkg->description), 72) }}</p>
                                <div class="d-flex align-items-center justify-content-between mt-auto gap-1">
                                    <div class="pkg-price">
                                        ₹{{ number_format($pkg->price) }}
                                        <small style="font-size: 10px;">/ person</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        @if($settings->contact_phone)
                                        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;" title="Call Us">
                                            <i class="bi bi-telephone-fill" style="font-size: 0.78rem;"></i>
                                        </a>
                                        @endif
                                        @if($settings->whatsapp_number)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;" title="WhatsApp Us">
                                            <i class="bi bi-whatsapp" style="font-size: 0.82rem;"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('packages.show', $pkg->slug) }}" class="btn btn-sm btn-gold px-2 fw-bold">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-compass display-4 text-muted"></i>
                        <p class="text-muted mt-3">No packages available yet.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('packages.index') }}" class="btn btn-gold px-5">
                    <i class="bi bi-grid me-2"></i>View All Packages
                </a>
            </div>
        </div>
    </section>

    {{-- ===== 4. DESTINATIONS CAROUSEL ===== --}}
    <section style="padding: 80px 0; background: #fff; overflow: hidden;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                <div>
                    <div class="section-badge mb-2">&#9650; Explore Ladakh</div>
                    <h2 class="section-title mb-0">Popular Destinations</h2>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <!-- Custom Prev/Next Arrows -->
                    <button class="dest-swiper-prev dest-nav-btn" aria-label="Previous">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="dest-swiper-next dest-nav-btn" aria-label="Next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                    <a href="{{ route('destinations.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold" style="font-size:0.85rem;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Swiper Container -->
            <div class="swiper dest-swiper" style="overflow: visible; padding-bottom: 16px;">
                <div class="swiper-wrapper align-items-stretch">
                    @forelse($destinations as $dest)
                    @php
                        $destImages = [
                            'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=800',
                            'https://images.unsplash.com/photo-1609669747649-44c68cf8e8f7?auto=format&fit=crop&q=80&w=800',
                        ];
                        $imgSrc = $dest->image ? asset('storage/' . $dest->image) : $destImages[$loop->index % count($destImages)];
                    @endphp
                    <div class="swiper-slide">
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="text-decoration-none dest-slide-card">
                            <div class="dest-card-new">
                                <!-- Image -->
                                <div class="dest-img-wrap">
                                    <img src="{{ $imgSrc }}" alt="{{ $dest->name }}" loading="lazy">
                                </div>
                                <!-- Gradient Overlay -->
                                <div class="dest-grad"></div>
                                <!-- Top Badge -->
                                <div class="dest-top-badge">
                                    <i class="bi bi-geo-alt-fill me-1"></i>Ladakh
                                </div>
                                <!-- Bottom Content -->
                                <div class="dest-bottom">
                                    <h5>{{ $dest->name }}</h5>
                                    @if($dest->location)
                                    <div class="dest-loc">
                                        <i class="bi bi-pin-map-fill me-1"></i>{{ $dest->location }}
                                    </div>
                                    @endif
                                    <div class="dest-explore-btn">
                                        Explore <i class="bi bi-arrow-right ms-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">No destinations available.</div>
                    @endforelse
                </div>

                <!-- Pagination dots -->
                <div class="dest-swiper-pagination swiper-pagination mt-4" style="position:static; margin-top: 28px;"></div>
            </div>
        </div>
    </section>

    <style>
    /* ===== DESTINATION CAROUSEL ===== */
    .dest-nav-btn {
        width: 44px; height: 44px;
        border-radius: 50%;
        border: 2px solid #0B2240;
        background: #fff;
        color: #0B2240;
        font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.25s;
        flex-shrink: 0;
    }
    .dest-nav-btn:hover {
        background: #C90000;
        border-color: #C90000;
        color: #fff;
        transform: scale(1.08);
    }
    .dest-nav-btn.swiper-button-disabled {
        opacity: 0.3;
        pointer-events: none;
    }

    /* Card */
    .dest-slide-card { display: block; height: 100%; }
    .dest-card-new {
        position: relative;
        border-radius: 22px;
        overflow: hidden;
        height: 340px;
        box-shadow: 0 6px 28px rgba(11,34,64,0.13);
        transition: transform 0.38s cubic-bezier(.4,0,.2,1), box-shadow 0.38s;
    }
    .dest-card-new:hover {
        transform: translateY(-8px);
        box-shadow: 0 24px 56px rgba(201,0,0,0.18);
    }

    /* Image */
    .dest-img-wrap {
        position: absolute; inset: 0;
    }
    .dest-img-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(.4,0,.2,1);
    }
    .dest-card-new:hover .dest-img-wrap img {
        transform: scale(1.1);
    }

    /* Gradient */
    .dest-grad {
        position: absolute; inset: 0;
        background: linear-gradient(
            to top,
            rgba(11,34,64,0.93) 0%,
            rgba(11,34,64,0.45) 45%,
            rgba(0,0,0,0.05) 100%
        );
        transition: background 0.4s;
    }
    .dest-card-new:hover .dest-grad {
        background: linear-gradient(
            to top,
            rgba(180,0,0,0.88) 0%,
            rgba(11,34,64,0.50) 50%,
            rgba(0,0,0,0.05) 100%
        );
    }

    /* Top badge */
    .dest-top-badge {
        position: absolute;
        top: 16px; right: 16px;
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 5px 12px;
        border-radius: 50px;
        z-index: 2;
    }

    /* Bottom content */
    .dest-bottom {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 24px 22px;
        z-index: 3;
        transition: padding 0.3s;
    }
    .dest-bottom h5 {
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 4px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.25);
        line-height: 1.25;
    }
    .dest-loc {
        color: rgba(255,255,255,0.75);
        font-size: 0.82rem;
        margin-bottom: 12px;
    }
    .dest-explore-btn {
        display: inline-flex;
        align-items: center;
        background: #C90000;
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 7px 18px;
        border-radius: 50px;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .dest-card-new:hover .dest-explore-btn {
        opacity: 1;
        transform: translateY(0);
    }

    /* Pagination dots */
    .dest-swiper-pagination .swiper-pagination-bullet {
        width: 8px; height: 8px;
        background: #ccc;
        opacity: 1;
        transition: all 0.3s;
        border-radius: 50px;
    }
    .dest-swiper-pagination .swiper-pagination-bullet-active {
        background: #C90000;
        width: 28px;
        border-radius: 50px;
    }
    </style>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const destSwiper = new Swiper('.dest-swiper', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            centeredSlides: false,
            loop: true,
            grabCursor: true,
            navigation: {
                prevEl: '.dest-swiper-prev',
                nextEl: '.dest-swiper-next',
            },
            pagination: {
                el: '.dest-swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            breakpoints: {
                480: { slidesPerView: 1.6, spaceBetween: 20 },
                640: { slidesPerView: 2.2, spaceBetween: 22 },
                992: { slidesPerView: 3.2, spaceBetween: 24 },
                1200: { slidesPerView: 4,   spaceBetween: 26 },
            },
        });
    });
    </script>
    @endpush

    {{-- ===== 5. WHY CHOOSE US ===== --}}
    <section style="padding: 80px 0; background: #F8F9FA;">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-badge mb-2">&#9650; Our Advantage</div>
                <h2 class="section-title">{{ $sections['why_choose_us']->title ?? 'Why Travelers Choose Us' }}</h2>
                <div class="text-muted mt-2">
                    {!! $sections['why_choose_us']->description ??
                        'Crafting unforgettable Himalayan journeys with safety, comfort, and premium style.' !!}
                </div>
            </div>
            <div class="row g-4">
                @php
                    $defaultFeatures = [
                        [
                            'title' => 'Local Experts',
                            'icon' => 'bi-geo-alt',
                            'desc' =>
                                'Native guides with deep terrain knowledge, culture, and mountain safety training.',
                        ],
                        [
                            'title' => 'Premium Stays',
                            'icon' => 'bi-buildings',
                            'desc' => 'Carefully vetted luxury hotels and glamping camps at every stop.',
                        ],
                        [
                            'title' => 'Safety First',
                            'icon' => 'bi-shield-check',
                            'desc' => 'Oxygen backup, emergency protocols, and 24/7 backup vehicle on all tours.',
                        ],
                        [
                            'title' => 'Custom Itineraries',
                            'icon' => 'bi-sliders',
                            'desc' => '100% customized itineraries matching your pace, group size, and preferences.',
                        ],
                    ];
                    $features = $sections['why_choose_us']->extra_data['features'] ?? $defaultFeatures;
                @endphp
                @foreach ($features as $feature)
                    <div class="col-sm-6 col-lg-3">
                        <div class="why-card">
                            <div class="why-icon">
                                <i class="bi {{ $feature['icon'] }}"></i>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: var(--primary-blue);">{{ $feature['title'] }}</h5>
                            <p class="text-muted small mb-0">{{ $feature['desc'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== 6. SERVICES ===== --}}
    @if ($featuredServices->count() > 0)
        <section style="padding: 80px 0; background: var(--primary-blue);">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-badge mb-2" style="color: var(--secondary-blue);">&#9650; What We Offer</div>
                    <h2 class="section-title text-white">Our Premium Services</h2>
                </div>
                <div class="row g-4">
                    @foreach ($featuredServices as $service)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('services.show', $service->slug) }}"
                                class="text-decoration-none text-dark">
                                <div class="package-card bg-white h-100 border-0 shadow-sm"
                                    style="transition: all 0.3s ease; border-radius: 16px; overflow: hidden;">
                                    <div class="img-wrap" style="overflow: hidden; position: relative;">
                                        @php
                                            $serviceImages = [
                                                'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&q=80&w=800',
                                                'https://images.unsplash.com/photo-1486916856992-e4db22c8df33?auto=format&fit=crop&q=80&w=800',
                                                'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&q=80&w=800',
                                                'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=800',
                                            ];
                                        @endphp
                                        <img src="{{ $service->image ? asset('storage/' . $service->image) : $serviceImages[$loop->index % count($serviceImages)] }}"
                                            alt="{{ $service->title }}" class="w-100 h-100 object-fit-cover"
                                            style="transition: transform 0.5s ease;">
                                        <div class="position-absolute top-0 end-0 m-3 bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi {{ $service->icon ?? 'bi-compass' }}"
                                                style="color: #C90000; font-size: 1.2rem;"></i>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column justify-content-between"
                                        style="min-height: 180px;">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-2">{{ $service->title }}</h5>
                                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                                {{ Str::limit(strip_tags($service->description), 85) }}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <span class="text-danger fw-bold small" style="color: #C90000 !important;">
                                                View Packages <i class="bi bi-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== 6.5. FEATURED HOTELS ===== --}}
    @if ($featuredHotels->count() > 0)
        <section style="padding: 80px 0; background: #F8F9FA;">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-badge mb-2">&#9650; Premium Stays</div>
                    <h2 class="section-title">Luxury Hotels & Camps</h2>
                    <p class="text-muted mx-auto" style="max-width:560px; margin-top:12px;">
                        Handpicked premium accommodations across Ladakh, combining local hospitality with modern luxury.
                    </p>
                </div>
                <div class="row g-4">
                    @foreach ($featuredHotels->take(4) as $hotel)
                        @php
                            $hotelImages = [
                                'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=800',
                                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800',
                                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&q=80&w=800',
                                'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=800',
                            ];
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('hotels.show', $hotel) }}" class="text-decoration-none text-dark">
                                <div class="package-card bg-white h-100 border-0 shadow-sm"
                                    style="transition: all 0.3s ease; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column;">
                                    <div class="img-wrap" style="height: 200px; overflow: hidden; position: relative;">
                                        <img src="{{ !empty($hotel->images) ? asset('storage/' . $hotel->images[0]) : $hotelImages[$loop->index % count($hotelImages)] }}"
                                            alt="{{ $hotel->name }}" class="w-100 h-100 object-fit-cover"
                                            style="transition: transform 0.5s ease;">
                                        <div class="position-absolute top-0 start-0 m-3">
                                            <span
                                                class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm fw-bold">
                                                <i class="bi bi-star-fill text-warning me-1"></i>
                                                {{ $hotel->star_rating ?? '4.9' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1"
                                        style="min-height: 180px;">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2 text-danger small fw-bold"
                                                style="color: #C90000 !important;">
                                                <i class="bi bi-geo-alt-fill"></i> {{ $hotel->location }}
                                            </div>
                                            <h5 class="fw-bold text-dark mb-2">{{ $hotel->name }}</h5>
                                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                                {{ Str::limit(strip_tags($hotel->description), 85) }}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-auto pt-2">
                                            <span class="fw-bold text-primary-blue">From ₹3,499<small
                                                    class="text-muted fw-normal">/nt</small></span>
                                            <span class="text-danger fw-bold small" style="color: #C90000 !important;">
                                                Explore <i class="bi bi-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('hotels.index') }}" class="btn btn-gold px-5">
                        Explore All Hotels
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ===== 7. TESTIMONIALS ===== --}}
    @if ($testimonials->count() > 0)
        <section style="padding: 80px 0; background: #fff;">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-badge mb-2">&#9650; What Travelers Say</div>
                    <h2 class="section-title">Real Stories, Real Experiences</h2>
                </div>
                <div class="row g-4">
                    @foreach ($testimonials as $t)
                        <div class="col-md-4">
                            <div class="testimonial-card">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                        style="width:46px;height:46px;background: linear-gradient(135deg, var(--primary-blue), #1a3a5c);flex-shrink:0;font-size:1.1rem;">
                                        {{ strtoupper(substr($t->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: var(--primary-blue);">{{ $t->name }}
                                        </div>
                                        <div class="small text-muted">{{ $t->role }}</div>
                                    </div>
                                </div>

                                <div class="stars mb-3">
                                    @for ($i = 0; $i < ($t->rating ?? 5); $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <p class="text-muted mb-4" style="line-height:1.75;">{{ $t->content }}</p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== 8. LATEST BLOGS ===== --}}
    @if ($blogs->count() > 0)
        <section style="padding: 80px 0; background: #F8F9FA;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <div>
                        <div class="section-badge mb-2">&#9650; Ladakh Travel Tips</div>
                        <h2 class="section-title mb-0">From Our Travel Journal</h2>
                    </div>
                    <a href="{{ route('blogs.index') }}"
                        class="btn btn-outline-dark rounded-pill d-none d-md-inline-block">View All Blogs</a>
                </div>
                <div class="row g-4">
                    @foreach ($blogs->take(3) as $blog)
                        <div class="col-md-4">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none">
                                <div class="package-card">
                                    <div class="img-wrap">
                                        <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&q=80&w=800' }}"
                                            alt="{{ $blog->title }}" loading="lazy">
                                    </div>
                                    <div class="card-body">
                                        <p class="small fw-bold mb-2 text-uppercase"
                                            style="letter-spacing:1px; color:#C90000;">Travel Tips</p>
                                        <h5 class="fw-bold text-dark mb-2" style="line-height:1.4;">
                                            {{ Str::limit($blog->title, 60) }}</h5>
                                        <p class="text-muted small">{{ Str::limit(strip_tags($blog->content), 90) }}</p>
                                        <span class="text-primary fw-semibold small">Read More <i
                                                class="bi bi-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== 9. CTA ===== --}}
    <section class="cta-section">
        <div class="container text-center">
            <div class="section-badge mb-3" style="color: var(--secondary-blue); border-color: rgba(229,149,36,0.3);">
                &#9650; Start Your Adventure</div>
            <h2 style="font-size:clamp(2rem,4vw,3rem); font-weight:800; color:#fff; margin-bottom:1.25rem;">
                {{ $sections['cta_footer']->title ?? 'Ready for Your Ladakh Adventure?' }}
            </h2>
            <div style="color:rgba(255,255,255,0.75); font-size:1.1rem; max-width:550px; margin: 0 auto 2rem;">
                {!! $sections['cta_footer']->description ??
                    'Contact our local experts today to plan your perfect custom Ladakh itinerary.' !!}
            </div>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('contact') }}" class="btn btn-gold px-5 py-3">
                    <i
                        class="bi bi-envelope me-2"></i>{{ $sections['cta_footer']->extra_data['button_text'] ?? 'GET A CUSTOM QUOTE' }}
                </a>
                <a href="{{ route('packages.index') }}" class="btn btn-outline-white px-5 py-3">
                    <i
                        class="bi bi-compass me-2"></i>{{ $sections['cta_footer']->extra_data['sub_title'] ?? 'Browse Packages' }}
                </a>
            </div>
        </div>
    </section>
@endsection
