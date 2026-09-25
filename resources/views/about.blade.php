@extends('layouts.app')

@section('content')

@push('preload')
    <link rel="preload" as="image" href="{{ $sections && $sections['about_banner']->image ? asset('storage/'.$sections['about_banner']->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}">
@endpush

<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{ $sections && $sections['about_banner']->image ? asset('storage/'.$sections['about_banner']->image) : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 45vh; padding: 120px 0 60px;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(10,34,64,0.7), rgba(10,34,64,0.85))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <span class="badge mb-3 px-3 py-2 rounded-pill text-uppercase ls-1 text-white" style="background:#C90000;">Our Journey</span>
            <h1 class="display-3 fw-bold text-white mb-3">{{ $sections && $sections['about_banner']->title ? $sections['about_banner']->title : 'About Ladakh Tourism' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{!! strip_tags($sections && $sections['about_banner']->description ? $sections['about_banner']->description : 'Your most trusted local tour operator in Ladakh for premium, safe, and unforgettable Himalayan journeys.') !!}</p>
        </div>
    </div>
</div>

<!-- Main About Section -->
@php $mainAbout = $sections['main_about'] ?? null;
// dd($mainAbout);
@endphp
<div class="container py-5 my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <div class="position-relative">
                <img src="{{ $mainAbout && $mainAbout->image ? asset('storage/'.$mainAbout->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}" class="img-fluid rounded-4 shadow-lg" alt="About Ladakh Tourism">
                
            </div>
        </div>
        <div class="col-lg-6">
            <span class="fw-bold text-uppercase ls-1 small mb-2 d-block" style="color: var(--secondary-blue);">{{ $mainAbout->extra_data['sub_title'] ?? 'Elevating Mountain Stays' }}</span>
            <h2 class=" fw-bold mb-4">{{ $mainAbout->title ?? 'Pioneering Luxury Himalayan Hospitality' }}</h2>
            <div class="text-muted mb-5">
                {!! $mainAbout->description ?? 'Ladakh Tourism was founded with the passion of sharing our homeland\'s raw beauty with the world. We design customized tours that blend raw Himalayan nature with premium comfort and absolute safety.' !!}
            </div>
            <a href="{{ route('contact') }}" class="btn rounded-pill px-5  fw-bold text-white" style="background:#C90000;">{{ $mainAbout->extra_data['button_text'] ?? 'Connect With Us' }}</a>
        </div>
    </div>
</div>

<!-- Mission & Vision -->
@php
    $ourMission = $sections['our_misson'] ?? null;
    $ourVision = $sections['our_vison'] ?? null;
@endphp
<div class="bg-light-blue py-5 my-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-5 rounded-5 bg-white shadow-sm border-0 h-100">
                   
                    <h3 class="fw-bold mb-3">{{ $ourMission->title ?? 'Our Mission' }}</h3>
                    <div class="text-muted fs-6 mb-0">
                        @if($ourMission && $ourMission->description)
                            {!! $ourMission->description !!}
                        @else
                            <p>To provide world-class hospitality services that ensure every guest experiences unmatched comfort, satisfaction, and creates lifelong memories.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 rounded-5 bg-white shadow-sm border-0 h-100">
                  
                    <h3 class="fw-bold mb-3">{{ $ourVision->title ?? 'Our Vision' }}</h3>
                    <div class="text-muted fs-6 mb-0">
                        @if($ourVision && $ourVision->description)
                            {!! $ourVision->description !!}
                        @else
                            <p>To become the global benchmark for excellence in hospitality, recognized for our commitment to quality, personalized service, and sustainable luxury.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats / Highlights -->
<div class="container">
    <div class="row g-4 text-center">
        @php
            $stats = $sections['stats']->extra_data ?? [
                ['value' => '15K+', 'label' => 'Happy Guests', 'icon' => 'users'],
                ['value' => '120+', 'label' => 'Luxury Suites', 'icon' => 'door-open'],
                ['value' => '15+', 'label' => 'Prime Locations', 'icon' => 'map-pin'],
                ['value' => '24/7', 'label' => 'Personal Support', 'icon' => 'headset']
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="col-6 col-md-3">
            <div class="">
                <div class="text-primary-blue ">
                    <i class="bi bi-star icon-md" style="width: 40px; height: 40px;"></i>
                </div>
                <h2 class="display-6 fw-bold mb-1">{{ $stat['value'] }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">{{ $stat['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Gallery Preview -->
<div class="bg-light py-5 my-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="text-primary-blue fw-bold text-uppercase ls-1 small mb-2 d-block">Visual Story</span>
            <h2 class="display-5 fw-bold mb-4">A Glimpse of our Ambiance</h2>
        </div>
        <div class="row g-3">
            @forelse($galllery as $gal)
            <div class="col-md-3 col-6">
                <div class="card-premium h-100 border-0" style="height: 200px;">
                    <img src="{{ $gal->image ? asset('storage/'.$gal->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=400' }}" class="w-100 h-100 object-fit-cover rounded-4" alt="Preview">
                </div>
            </div>
            @empty
            @foreach(range(1,4) as $i)
            <div class="col-md-3 col-6">
                <div class="card-premium h-100 border-0" style="height: 200px;">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=400" class="w-100 h-100 object-fit-cover rounded-4" alt="Preview">
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('gallery') }}" class="btn btn-outline-primary-blue rounded-pill px-5 py-2 fw-bold">View Full Gallery</a>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container py-5 mb-5">
    <div class="rounded-5 p-5 text-center shadow-lg text-white" style="background: linear-gradient(135deg, var(--primary-blue), #1a3a5c);">
        <h2 class="display-5 fw-bold text-white mb-4">Start Your Ladakh Adventure</h2>
        <p class="lead text-white opacity-75 mb-5 mx-auto max-w-700">Plan your perfect Ladakh itinerary with our local experts. Custom packages, luxury stays, and safe Himalayan adventures await.</p>
        <a href="{{ route('packages.index') }}" class="btn btn-lg btn-gold px-5 py-3 rounded-pill fw-bold">Explore Tour Packages</a>
    </div>
</div>

<style>
.bg-light-blue { background-color: var(--light-blue); }
.max-w-700 { max-width: 700px; }
.shadow-md { box-shadow: 0 4px 15px rgba(11, 34, 64, 0.1); }
</style>
@endsection
