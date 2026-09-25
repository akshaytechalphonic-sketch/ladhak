@extends('layouts.app')

@section('content')
@php
    $banner = $sections->first();
@endphp

<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{ $banner && $banner->image ? asset('storage/' . $banner->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQU8oFXrY7D-PsUormkuiD5U8ecIUYOMXhgDvhoBl_-cNOyppLtiswChHfz&s=10' }}'); min-height: 45vh; padding: 120px 0 60px;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <span class="badge bg-primary-blue mb-3 px-3 py-2 rounded-pill text-uppercase ls-1">Destination Spotlight</span>
            <h1 class="display-3 fw-bold text-white mb-3">{{ $destination->name ?? $sections->first()->title }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{{ strip_tags($sections->first()->description ?? 'Discover the unique charm and breathtaking beauty of this curated destination.') }}</p>
        </div>
    </div>
</div>

<div class="container py-5 mt-5">
    <div class="row g-5">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="fade-up">
                <h2 class="display-5 fw-bold mb-4">Discover the Essence of <span class="text-primary-blue">{{ $destination->name }}</span></h2>
                <div class="text-muted fs-5 lh-lg mb-5">
                    {!! nl2br(e($destination->description)) !!}
                </div>

                <div class="rounded-5  overflow-hidden shadow-lg mb-5" style="height: 450px; width: 600px;">
                    <img src="{{ $destination->image ? asset('storage/' . $destination->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=1200' }}"
                        class="w-100 h-100 object-fit-cover" alt="{{ $destination->name }}">
                </div>

                {{-- <h4 class="fw-bold mb-4">Highlights & Experiences</h4>
                <div class="row g-4 mb-5">
                    @php
                        $highlights = [
                            ['label' => 'Scenic Views', 'icon' => 'camera'],
                            ['label' => 'Local Culture', 'icon' => 'users'],
                            ['label' => 'Water Sports', 'icon' => 'waves'],
                            ['label' => 'Nightlife', 'icon' => 'moon']
                        ];
                    @endphp
                    @foreach($highlights as $item)
                    <div class="col-md-3 col-6 text-center">
                        <div class="p-4 bg-light-blue rounded-5 border border-primary-blue border-opacity-10 transition-all hover-shadow">
                            <i class="bi bi-star icon-md text-primary-blue mb-2 mx-auto"></i>
                            <h6 class="fw-bold small mb-0">{{ $item['label'] }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 5;">
                <div class="card border-0 shadow-lg p-4 rounded-5">
                    <h4 class="fw-bold mb-4">Book This Experience</h4>
                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4">
                            <span class="small fw-bold text-muted">Location</span>
                            <span class="text-primary-blue fw-bold">{{ $destination->location ?? 'Global' }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4">
                            <span class="small fw-bold text-muted">Price Range</span>
                            <span class="text-primary-blue fw-bold">₹{{$minprice ?? 2000}} - ₹{{$maxprice ?? 5000}}</span>
                        </div>
                    </div>
                    <div class="d-grid gap-3">
                        <a href="{{ route('hotels.index', ['destination' => $destination->id]) }}"
                            class="btn btn-primary-blue py-3 rounded-pill fw-bold shadow-md">Explore Hotels in {{ $destination->name }}</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary-blue py-3 rounded-pill fw-bold">Request Inquiry</a>
                    </div>
                    <p class="text-center text-muted small mt-4 mb-0">* Prices are subject to seasonal changes and availability.</p>
                </div>

                <div class="mt-4 p-4 rounded-5 bg-white border border-primary-blue border-opacity-10 d-flex gap-3 align-items-center">
                    <div class="bg-primary-blue bg-opacity-10 rounded-circle p-3 text-primary-blue">
                        <i class="bi bi-info-circle icon-md"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Local Travel Guide</h6>
                        <p class="small text-muted mb-0">Our concierge can help you plan the perfect itinerary for {{ $destination->name }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-light-blue { background-color: #E6F0FF; }
.hover-shadow:hover { box-shadow: 0 10px 25px rgba(45, 91, 255, 0.1); transform: translateY(-5px); }
</style>
@endsection
