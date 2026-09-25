@extends('layouts.app')

@section('content')
@php
    $banner = $sections->first();
@endphp

<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{ $banner && $banner->image ? asset('storage/' . $banner->image) : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 40vh; padding: 120px 0 60px; display: flex; align-items: center;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(11, 34, 64, 0.75), rgba(11, 34, 64, 0.9))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <span class="badge mb-3 px-3 py-2 rounded-pill text-uppercase ls-1 text-white" style="background:#C90000;">Curated Deals</span>
            <h1 class="display-3 fw-bold text-white mb-3">{{ $banner->title ?? 'Exclusive Offers' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{!! strip_tags($banner->description ?? 'Get premium Ladakh bike expeditions, luxury stays, and customized tour packages at exclusive rates.') !!}</p>
        </div>
    </div>
</div>

<div class="container py-5 mt-5">
    <div class="row g-4">
        @forelse($offers as $offer)
        <div class="col-lg-6">
            <div class="card-premium h-100 shadow-lg border-0 overflow-hidden">
                <div class="row g-0 h-100">
                    <div class="col-md-5">
                        <img src="{{ $offer->image ? asset('storage/'.$offer->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800' }}" class="img-fluid h-100 object-fit-cover" alt="Offer">
                    </div>
                    <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center">
                        <span class="badge fw-bold mb-3 align-self-start py-2 px-3 rounded-pill text-white" style="background:#C90000;">{{ $offer->discount_text ?? 'SPECIAL DEAL' }}</span>
                        <h3 class="fw-bold mb-3 text-dark-blue">{{ $offer->title }}</h3>
                        <p class="small text-muted mb-4 opacity-80">{{ $offer->description }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold fs-4 text-primary-blue">{{ $offer->price_text ?? '' }}</span>
                            <a href="{{ route('packages.index') }}" class="btn btn-gold rounded-pill px-4 fw-bold">Claim Offer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-5">
                <i class="bi bi-gift icon-md text-muted mb-3 opacity-20" style="width: 64px; height: 64px;"></i>
                <h4 class="text-muted">No active offers.</h4>
                <p class="text-muted small">We're preparing new exclusive deals for you. Check back very soon!</p>
            </div>
        </div>
        @endforelse

        @if($offers->count() > 0)
        <div class="col-12 mt-5">
            <div class="rounded-5 p-5 shadow-lg position-relative overflow-hidden text-white" style="background: linear-gradient(135deg, #0B2240 0%, #1a3a5c 100%);">
                <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-3">Group discount offer</h3>
                        <p class="opacity-90 mb-0">Join our newsletter today to get **Group and custom discounts** on your booking. Plus, enjoy complimentary airport pickup & drop-off in Leh based on availability.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary-blue shadow-md" style="color: #0B2240 !important;">Contact Us</a>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 opacity-10">
                    <i class="bi bi-award" style="width: 300px; height: 300px; transform: translate(50px, -50px);"></i>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
