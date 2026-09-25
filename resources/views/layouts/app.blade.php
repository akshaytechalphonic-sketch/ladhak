<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ $settings->site_favicon ? asset('storage/' . $settings->site_favicon) : asset('favicon.svg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

    {{-- ===== DYNAMIC SEO META TAGS (driven by pages table & settings) ===== --}}
    @php
       
        $seoSource = $package ?? $page ?? $contactdata ?? $hotel ?? $blog ?? $destination ?? $service ?? null;
        $metaTitle       = $seoSource->meta_title       ?? ($settings->seo_meta_title ?? config('app.name', 'Ladakh Tourism – Himalayan Journeys'));
        $metaDescription = $seoSource->meta_description ?? ($settings->seo_meta_description ?? 'Experience Ladakh like never before — premium bike expeditions, luxury stays, and customised Himalayan itineraries crafted with passion.');
        $metaKeywords    = $seoSource->meta_keywords    ?? ($settings->seo_meta_keywords    ?? 'ladakh tourism, ladakh tour packages, leh ladakh, himalayan travel, bike expedition ladakh');
    @endphp

    <title>@yield('title', $metaTitle)</title>
    <meta name="description" content="@yield('meta_description', $metaDescription)">
    <meta name="keywords"    content="@yield('meta_keywords',    $metaKeywords)">
    {{-- Open Graph --}}
    <meta property="og:title"       content="@yield('title', $metaTitle)">
    <meta property="og:description" content="@yield('meta_description', $metaDescription)">
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('title', $metaTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $metaDescription)">

    <!-- Preconnect to critical domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    @stack('preload')

    <style>
        .icon-sm {
            width: 18px;
            height: 18px;
        }

        .icon-md {
            width: 24px;
            height: 24px;
        }

        .ls-1 {
            letter-spacing: 1px;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.6) !important;
            text-decoration: none;
            font-size: 0.88rem;
            line-height: 2.2;
            transition: all 0.25s ease;
            display: inline-block;
        }

        .footer-link:hover {
            color: #C90000 !important;
            padding-left: 6px;
        }
    </style>

    <!-- Google Fonts: Inter, Poppins & Playfair Display -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap Icons -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"> --}}

    <!-- FontAwesome 6 -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> --}}

    <!-- Animate.css -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> --}}

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Frontend CSS -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- ===== TOP INFO BAR (hidden on mobile) ===== -->
        <div class="top-info-bar d-none d-lg-block" style="background:#C90000; padding: 7px 0; font-size: 0.8rem;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-flex align-items-center gap-4">
                        @if($settings->contact_phone || $settings->phone_two)
                        <span class="text-white d-flex align-items-center gap-1">
                            <i class="bi bi-telephone-fill me-1"></i>
                            @if($settings->contact_phone)
                                <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="text-white text-decoration-none">{{ $settings->contact_phone }}</a>
                            @endif
                            @if($settings->contact_phone && $settings->phone_two)
                                &nbsp;/&nbsp;
                            @endif
                            @if($settings->phone_two)
                                <a href="tel:{{ str_replace(' ', '', $settings->phone_two) }}" class="text-white text-decoration-none">{{ $settings->phone_two }}</a>
                            @endif
                        </span>
                        @endif
                        @if($settings->contact_email)
                        <span class="text-white d-flex align-items-center gap-1">
                            <i class="bi bi-envelope-fill me-1"></i>
                            <a href="mailto:{{ $settings->contact_email }}" class="text-white text-decoration-none">{{ $settings->contact_email }}</a>
                        </span>
                        @endif
                    </div>
                    <div class="col-lg-6 text-end">
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            <a href="{{ route('about') }}" class="text-white text-decoration-none small fw-semibold" style="opacity:0.9;">About Us</a>
                            <span class="text-white" style="opacity:0.4;">|</span>
                            <a href="{{ route('contact') }}" class="text-white text-decoration-none small fw-semibold" style="opacity:0.9;">Contact Us</a>
                            @if($settings->facebook_url || $settings->instagram_url || $settings->twitter_url)
                            <span class="text-white ms-2" style="opacity:0.4;">|</span>
                            <div class="d-flex gap-2 ms-1">
                                @if($settings->facebook_url)
                                    <a href="{{ $settings->facebook_url }}" target="_blank" class="text-white" style="opacity:0.85; font-size:0.9rem;"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if($settings->instagram_url)
                                    <a href="{{ $settings->instagram_url }}" target="_blank" class="text-white" style="opacity:0.85; font-size:0.9rem;"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if($settings->twitter_url)
                                    <a href="{{ $settings->twitter_url }}" target="_blank" class="text-white" style="opacity:0.85; font-size:0.9rem;"><i class="bi bi-twitter-x"></i></a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== MAIN NAVBAR ===== -->
        <nav class="navbar navbar-expand-lg sticky-top" id="mainNav" style="background: #fff; border-bottom: 2px solid #f0f0f0; padding: 0;">
            <div class="container" style="padding-top: 6px; padding-bottom: 6px;">

                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}" style="text-decoration: none;">
                    <img src="{{ $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('storage/logo.png') }}" alt="{{ $settings->site_name ?? 'Ladakh Tourism' }} Logo"
                         class="site-logo">
                </a>

                <!-- Hamburger toggler -->
                <button class="navbar-toggler d-flex d-lg-none border-0 shadow-none p-0 ms-auto" type="button"
                        data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation"
                        style="width:44px; height:44px; flex-direction:column; justify-content:center; align-items:center; gap:6px;">
                    <span class="nav-burger-line"></span>
                    <span class="nav-burger-line"></span>
                    <span class="nav-burger-line"></span>
                </button>

                <!-- Nav links -->
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mx-auto gap-1">
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('home') ? 'active' : '' }}"
                               href="{{ route('home') }}">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('packages.*') ? 'active' : '' }}"
                               href="{{ route('packages.index') }}">PACKAGES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('hotels.*') ? 'active' : '' }}"
                               href="{{ route('hotels.index') }}">HOTELS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('destinations.*') ? 'active' : '' }}"
                               href="{{ route('destinations.index') }}">DESTINATIONS</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('services.*') ? 'active' : '' }}"
                               href="{{ route('services.index') }}">SERVICES</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('gallery') ? 'active' : '' }}"
                               href="{{ route('gallery') }}">GALLERY</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('contact') ? 'active' : '' }}"
                               href="{{ route('contact') }}">CONTACT</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link-premium {{ request()->routeIs('payment.form') ? 'active' : '' }}"
                               href="{{ route('payment.form') }}">PAYMENT</a>
                        </li>
                    </ul>

                    <!-- Right CTA -->
                    <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                        @guest
                            <a href="{{ route('packages.index') }}"
                               class="btn fw-bold px-4 py-2 rounded-pill"
                               style="background:#C90000; color:#fff; font-size:0.82rem; letter-spacing:0.5px; border:none; white-space:nowrap;">
                                <i class="bi bi-calendar-check me-1"></i> Book Now
                            </a>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border shadow-none"
                                        data-bs-toggle="dropdown">
                                    <div class="avatar-sm bg-primary-blue rounded-circle text-white d-flex align-items-center justify-content-center"
                                         style="width:28px; height:28px; font-size:12px; background:#0B2240;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="small fw-bold">{{ Auth::user()->name }}</span>
                                    <i class="bi bi-chevron-down small"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 p-2 rounded-4">
                                    @if(Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 text-danger fw-bold"
                                           href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>

                    <!-- Mobile-only contact info (inside hamburger menu) -->
                    <div class="d-flex d-lg-none flex-column gap-2 mt-4 pt-3 border-top">
                        @if($settings->contact_phone)
                        <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="text-dark text-decoration-none small">
                            <i class="bi bi-telephone-fill me-2" style="color:#C90000;"></i>{{ $settings->contact_phone }}
                        </a>
                        @endif
                        @if($settings->phone_two)
                        <a href="tel:{{ str_replace(' ', '', $settings->phone_two) }}" class="text-dark text-decoration-none small">
                            <i class="bi bi-telephone-fill me-2" style="color:#C90000;"></i>{{ $settings->phone_two }}
                        </a>
                        @endif
                        @if($settings->contact_email)
                        <a href="mailto:{{ $settings->contact_email }}" class="text-dark text-decoration-none small">
                            <i class="bi bi-envelope-fill me-2" style="color:#C90000;"></i>{{ $settings->contact_email }}
                        </a>
                        @endif
                        @if($settings->facebook_url || $settings->instagram_url || $settings->twitter_url)
                        <div style="display: flex !important; flex-direction: row !important; gap: 15px !important; margin-top: 10px;">
                            @if($settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}" target="_blank" class="text-dark" style="font-size:1.1rem; display: inline-block !important;"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if($settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}" target="_blank" class="text-dark" style="font-size:1.1rem; display: inline-block !important;"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if($settings->twitter_url)
                                <a href="{{ $settings->twitter_url }}" target="_blank" class="text-dark" style="font-size:1.1rem; display: inline-block !important;"><i class="bi bi-twitter-x"></i></a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header CSS -->
        <style>
        /* ===== LOGO SIZE ===== */
        .site-logo {
            height: 85px;        /* desktop */
            object-fit: contain;
            max-width: 200px;
            transition: height 0.2s;
        }
        @media (max-width: 991.98px) {
            .site-logo {
                height: 68px;    /* mobile / tablet – bigger than before */
                max-width: 160px;
            }
        }

        /* ===== NAV LINK PREMIUM ===== */
        .nav-link-premium {
            display: inline-block;
            padding: 22px 10px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            color: #1a1e23;
            text-decoration: none;
            position: relative;
            transition: color 0.25s;
            white-space: nowrap;
        }
        .nav-link-premium::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            height: 3px;
            background: #C90000;
            transform: scaleX(0);
            transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
            border-radius: 2px 2px 0 0;
        }
        .nav-link-premium:hover,
        .nav-link-premium.active { color: #C90000; }
        .nav-link-premium:hover::after,
        .nav-link-premium.active::after { transform: scaleX(1); }

        /* ===== HAMBURGER LINES ===== */
        .nav-burger-line {
            display: block;
            width: 24px;
            height: 2px;
            background: #0B2240;
            border-radius: 2px;
            transition: all 0.3s;
        }
        .navbar-toggler[aria-expanded="true"] .nav-burger-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .navbar-toggler[aria-expanded="true"] .nav-burger-line:nth-child(2) {
            opacity: 0;
        }
        .navbar-toggler[aria-expanded="true"] .nav-burger-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* ===== STICKY SHADOW ===== */
        #mainNav.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.10);
        }

        /* ===== MOBILE COLLAPSE ===== */
        @media (max-width: 991.98px) {
            #mainNav .container {
                padding-top: 4px !important;
                padding-bottom: 4px !important;
            }
            #mainNavbar {
                padding: 1rem 0 0.5rem;
                border-top: 1px solid #f0f0f0;
                margin-top: 4px;
                max-height: 85vh;
                overflow-y: auto;
            }
            .navbar-nav {
                gap: 0 !important;
            }
            .nav-link-premium {
                padding: 12px 12px;
                font-size: 0.9rem;
                display: block;
                border-bottom: 1px solid #f5f5f5;
            }
            .nav-link-premium::after { display: none; }
            .nav-link-premium:hover,
            .nav-link-premium.active {
                color: #C90000;
                background: #fff8f8;
                border-radius: 6px;
                padding-left: 16px;
            }
            /* CTA button full width on mobile */
            .navbar-collapse .btn.rounded-pill {
                width: 100%;
                text-align: center;
                margin-top: 0.5rem;
            }
        }
        </style>

        <script>
        // Add scrolled class to navbar on scroll
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 10) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
        </script>


        <main class="flex-grow-1">
            @yield('content')
        </main>

        <style>
            @media (min-width: 992px) {
                .hover-dropdown:hover>.dropdown-menu {
                    display: block !important;
                    margin-top: 0;
                    animation: slideInDropdown 0.3s ease-out forwards;
                }

                .navbar .nav-item.dropdown .dropdown-toggle::after {
                    transition: transform 0.3s;
                }

                .navbar .nav-item.dropdown:hover .dropdown-toggle::after {
                    transform: rotate(180deg);
                }
            }

            @keyframes slideInDropdown {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>

        <!-- Modern Premium Footer -->
        <footer class="footer" style="background: #061624; color: #fff;">
            
            <div class="container">
                <div class="row g-5">
                    <!-- Brand column -->
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <img src="{{ $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('storage/logo.png') }}" alt="{{ $settings->site_name ?? 'Ladakh Tourism' }} Logo"
                                style="height: 72px; object-fit: contain; background:#fff; padding:6px 12px; border-radius:12px;" loading="lazy">
                        </div>
                        <p style="color:rgba(255,255,255,0.55); font-size:0.88rem; line-height:1.8; max-width:300px;">
                            {{ $settings->site_tagline ?? 'Experience Ladakh like never before — premium bike expeditions, luxury stays, and customised Himalayan itineraries crafted with passion.' }}
                        </p>
                        <!-- Contact in footer -->
                        <div class="mt-4 d-flex flex-column gap-2" style="font-size:0.85rem;">
                            @if($settings->contact_phone)
                            <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" class="d-flex align-items-center gap-2 text-decoration-none" style="color:rgba(255,255,255,0.65);">
                                <i class="bi bi-telephone-fill" style="color:#C90000;"></i> {{ $settings->contact_phone }}
                            </a>
                            @endif
                            @if($settings->phone_two)
                            <a href="tel:{{ str_replace(' ', '', $settings->phone_two) }}" class="d-flex align-items-center gap-2 text-decoration-none" style="color:rgba(255,255,255,0.65);">
                                <i class="bi bi-telephone-fill" style="color:#C90000;"></i> {{ $settings->phone_two }}
                            </a>
                            @endif
                            @if($settings->contact_email)
                            <a href="mailto:{{ $settings->contact_email }}" class="d-flex align-items-center gap-2 text-decoration-none" style="color:rgba(255,255,255,0.65);">
                                <i class="bi bi-envelope-fill" style="color:#C90000;"></i> {{ $settings->contact_email }}
                            </a>
                            @endif
                            <span class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,0.65);">
                                <i class="bi bi-geo-alt-fill" style="color:#C90000;"></i> {{ $settings->address ?? 'Leh, Ladakh, India' }}
                            </span>
                        </div>
                        <!-- Social links -->
                        <div class="d-flex gap-2 mt-2">
                            @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='#C90000'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                                <i class="bi bi-facebook"></i>
                            </a>
                            @endif
                            @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='#C90000'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                                <i class="bi bi-instagram"></i>
                            </a>
                            @endif
                            @if($settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='#C90000'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            @endif
                            @if($settings->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='#25D366'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Quick links -->
                    <div class="col-6 col-lg-2">
                        <h6 style="color:#fff; font-size:0.72rem; letter-spacing:2px; text-transform:uppercase; margin-bottom:1.25rem;">Quick Links</h6>
                        <ul class="list-unstyled" style="margin:0;">
                            <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                            <li><a href="{{ route('packages.index') }}" class="footer-link">Tour Packages</a></li>
                            <li><a href="{{ route('hotels.index') }}" class="footer-link">Hotels</a></li>
                            <li><a href="{{ route('destinations.index') }}" class="footer-link">Destinations</a></li>
                            {{-- <li><a href="{{ route('services.index') }}" class="footer-link">Our Services</a></li> --}}
                            <li><a href="{{ route('gallery') }}" class="footer-link">Gallery</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div class="col-6 col-lg-2">
                        <h6 style="color:#fff; font-size:0.72rem; letter-spacing:2px; text-transform:uppercase; margin-bottom:1.25rem;">Support</h6>
                        <ul class="list-unstyled" style="margin:0;">
                            <li><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
                            <li><a href="{{ route('blogs.index') }}" class="footer-link">Blog</a></li>
                            <li><a href="{{ route('faq') }}" class="footer-link">FAQs</a></li>
                            <li><a href="{{ route('privacy-policy') }}" class="footer-link">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-conditions') }}" class="footer-link">Terms & Conditions</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-lg-4">
                        <h6 style="color:#fff; font-size:0.72rem; letter-spacing:2px; text-transform:uppercase; margin-bottom:1.25rem;">Newsletter</h6>
                        <p style="color:rgba(255,255,255,0.55); font-size:0.85rem; margin-bottom:1.25rem; line-height:1.7;">
                            Get exclusive Ladakh travel tips, deals and seasonal updates in your inbox.
                        </p>
                        <form class="d-flex flex-column flex-sm-row gap-2">
                            <input type="email" placeholder="Your email address"
                                style="flex:1; border:none; border-radius:50px; padding:10px 18px; font-size:0.85rem; background:rgba(255,255,255,0.1); color:#fff; outline:none;"
                                onfocus="this.style.background='rgba(255,255,255,0.18)';"
                                onblur="this.style.background='rgba(255,255,255,0.1)';">
                            <button type="button"
                                style="border:none; border-radius:50px; padding:10px 20px; background:#C90000; color:#fff; font-size:0.82rem; font-weight:700; white-space:nowrap; cursor:pointer;">
                                Subscribe
                            </button>
                        </form>
                        <!-- Trust badges -->
                        <div class="d-flex gap-3 mt-4 flex-wrap" style="font-size:0.78rem; color:rgba(255,255,255,0.4);">
                            <span><i class="bi bi-shield-fill-check me-1" style="color:#C90000;"></i>Safe &amp; Secure</span>
                            <span><i class="bi bi-award-fill me-1" style="color:#C90000;"></i>12+ Years Experience</span>
                            <span><i class="bi bi-star-fill me-1" style="color:#C90000;"></i>5000+ Happy Travelers</span>
                        </div>
                    </div>
                </div>


                <div class="row align-items-center g-3 mt-2 ">
                    <div class="col-md-6 text-center text-md-start">
                        <p style="margin:0; color:rgba(255,255,255,0.4); font-size:0.82rem;">
                            {!! $settings->copyright_text ?? '&copy; ' . date('Y') . ' <strong style="color:rgba(255,255,255,0.7);">Ladakh Tourism</strong>. All rights reserved. | Designed with <span style="color:#C90000;">&#10084;</span> for Himalayan explorers.' !!}
                        </p>
                    </div>
                
                </div>
            </div>
        </footer>
    </div>
    <style>
        /* Base */
        .btn-floating:hover img {
            margin-bottom: -3px
        }

        .btn-floating {
            position: fixed;
            right: 25px;
            overflow: hidden;
            width: 50px;
            height: 50px;
            border-radius: 100px;
            border: 0;
            z-index: 9999;
            color: white;
            transition: .2s;
        }

        .btn-floating:hover {
            width: auto;
            padding: 0 20px;
            cursor: pointer;
        }

        .btn-floating span {
            font-size: 16px;
            margin-left: 5px;
            transition: .2s;
            line-height: 0px;
            display: none;
        }

        .btn-floating:hover span {
            display: inline-block;
        }

        /* Phone */
        .btn-floating.phone {
            bottom: 85px;
            background-color: #760f10;
        }

        .btn-floating.phone:hover {
            background-color: #c03421;
        }

        /* WhatsApp */
        .btn-floating.whatsapp {
            background-color: #34af23;
            bottom: 25px;
        }

        .btn-floating.whatsapp:hover {
            background-color: #1f7a12
        }

        #buttonSchroll {
            display: inline-block;
            background-color: #0a2342;
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 4px;
            position: fixed;
            bottom: 30px;
            left: 30px;
            transition: background-color .3s,
                opacity .5s, visibility .5s;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
            text-decoration: none;
        }

        #buttonSchroll::after {
            content: "\f077";
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            font-size: 2em;
            line-height: 50px;
            color: #fff;
        }

        #buttonSchroll:hover {
            cursor: pointer;
            background-color: #333;
        }

        #buttonSchroll:active {
            background-color: #555;
        }

        #buttonSchroll.show {
            opacity: 1;
            visibility: visible;
        }
    </style>


    @if($settings->contact_phone)
    <a href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}" style="text-decoration:none;">
        <button class="btn-floating phone">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white"
                viewBox="0 0 16 16">
                <path
                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z" />
            </svg>
            <span>{{ $settings->contact_phone }}</span>
        </button>
    </a>
    @endif

    @if($settings->whatsapp_number)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" style="text-decoration:none;">
        <button class="btn-floating whatsapp">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white"
                viewBox="0 0 16 16">
                <path
                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
            </svg>
            <span>{{ $settings->whatsapp_number }}</span>
        </button>
    </a>
    @endif

    <a id="buttonSchroll"></a>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            }
        });

        var btn = $('#buttonSchroll');
        $(window).scroll(function() {
            btn.toggleClass('show', $(window).scrollTop() > 300);
        });
        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
    @stack('scripts')

</body>

</html>
