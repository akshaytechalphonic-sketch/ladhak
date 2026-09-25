@extends('layouts.app')

@push('styles')
<style>
.contact-hero {
    position: relative;
    min-height: 360px;
    display: flex; align-items: center;
    background-size: cover;
    background-position: center;
    overflow: hidden;
}
.contact-hero::before {
    content: '';
    position: absolute; inset: 0;
    /* background: linear-gradient(135deg, rgba(11,34,64,0.92) 0%, rgba(201,0,0,0.6) 100%); */
}
.contact-hero .content { position: relative; z-index: 2; }

/* Info cards */
.info-card {
    border-radius: 20px;
    background: #fff;
    padding: 32px 24px;
    text-align: center;
    border: 1px solid #f0f0f0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.3s;
    height: 100%;
}
.info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(201,0,0,0.12);
    border-color: #C90000;
}
.info-icon {
    width: 64px; height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #C90000, #a30000);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.25rem;
    color: #fff; font-size: 1.4rem;
    box-shadow: 0 8px 24px rgba(201,0,0,0.3);
}
.info-card h6 { font-size: 0.7rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #C90000; margin-bottom: 0.4rem; }
.info-card h5 { font-size: 1rem; font-weight: 700; color: #0B2240; margin-bottom: 0.5rem; }
.info-card p, .info-card a { font-size: 0.88rem; color: #6c757d; text-decoration: none; display: block; line-height: 1.8; }
.info-card a:hover { color: #C90000; }

/* Form card */
.form-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.09);
    padding: 48px;
}
@media (max-width: 767px) { .form-card { padding: 28px 20px; } }

.form-field {
    position: relative;
    margin-bottom: 0;
}
.form-field label {
    display: block;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #0B2240;
    margin-bottom: 6px;
}
.form-field input,
.form-field textarea,
.form-field select {
    width: 100%;
    border: 2px solid #e8ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.92rem;
    color: #1a1e23;
    background: #f9fafb;
    transition: all 0.25s;
    outline: none;
}
.form-field input:focus,
.form-field textarea:focus,
.form-field select:focus {
    border-color: #C90000;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(201,0,0,0.08);
}
.form-field textarea { resize: vertical; min-height: 140px; }

.btn-submit {
    background: linear-gradient(135deg, #C90000, #a30000);
    color: #fff;
    border: none;
    padding: 14px 48px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    box-shadow: 0 8px 24px rgba(201,0,0,0.3);
    cursor: pointer;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(201,0,0,0.4);
    color: #fff;
}

/* Map/Image panel */
.map-panel {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.10);
    position: relative;
    min-height: 100%;
}
.map-overlay {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(11,34,64,0.9) 0%, transparent 60%);
    padding: 28px 24px;
    z-index: 2;
}

/* Quick connect bar */
.connect-bar {
    background: #0B2240;
    padding: 20px 0;
}
</style>
@endpush

@section('content')
@php
    $banner = $sections->first();
    
  
    $heroBg = $banner && $banner->image
        ? asset('storage/'.$banner->image)
        : '';
    $address  = $banner->extra_data['Our Presence'] ?? 'Leh, Ladakh, India';
    $phones   = explode(',', $banner->extra_data['Direct Line'] ?? '+91 80767 82128');
    $email    = $banner->extra_data['email'] ?? 'info@ladakhtourism.com';
@endphp

{{-- ===== HERO ===== --}}
<div class="contact-hero" style="background-image: url('{{ $heroBg }}');">
    <div class="container content text-center py-5">
        <div style="display:inline-block;  border:1px solid rgba(255,255,255,0.3); border-radius:50px; padding:5px 18px; font-size:0.72rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#fff; margin-bottom:1rem;">
            &#9650; Reach Out
        </div>
        <h1 class="fw-bold text-white mb-3" style="font-size:clamp(2rem,5vw,3.5rem);">
           {{ $sections['contect_banner']->title ?? 'Discover the Beauty of Ladakh' }}
        </h1>
        <div class="text-white mx-auto" style="max-width:520px; opacity:0.85; font-size:1rem; line-height:1.7;">
            {!! strip_tags($sections['contect_banner']->description ?? 'We\'re here to help plan your perfect Ladakh journey. Reach out and our team will respond within 24 hours.') !!}
        </div>
    </div>
</div>

{{-- ===== QUICK CONNECT BAR ===== --}}
<div class="connect-bar">
    <div class="container">
        <div class="row align-items-center text-white g-3">
            <div class="col-md-4 d-flex align-items-center gap-3">
                <i class="bi bi-telephone-fill fs-5" style="color:#C90000;"></i>
                <div>
                    <div style="font-size:0.65rem; opacity:0.6; text-transform:uppercase; letter-spacing:1px;">Call Us Directly</div>
                    @foreach($phones as $p)
                    <a href="tel:{{ trim($p) }}" class="text-white text-decoration-none fw-bold" style="font-size:0.9rem;">{{ trim($p) }}</a>@if(!$loop->last) &nbsp;/&nbsp; @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center gap-3">
                <i class="bi bi-envelope-fill fs-5" style="color:#C90000;"></i>
                <div>
                    <div style="font-size:0.65rem; opacity:0.6; text-transform:uppercase; letter-spacing:1px;">Email Us</div>
                    <a href="mailto:{{ $email }}" class="text-white text-decoration-none fw-bold" style="font-size:0.9rem;">{{ $email }}</a>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center gap-3">
                <i class="bi bi-geo-alt-fill fs-5" style="color:#C90000;"></i>
                <div>
                    <div style="font-size:0.65rem; opacity:0.6; text-transform:uppercase; letter-spacing:1px;">Our Location</div>
                    <span class="fw-bold" style="font-size:0.9rem;">{{ $address }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== INFO CARDS ===== --}}
<section style="padding: 70px 0 40px; background: #F8F9FA;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <h6>Our Location</h6>
                    <h5>Find Us Here</h5>
                    <p>{{ $address }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                    <h6>Call Us</h6>
                    <h5>Direct Line</h5>
                    @foreach($phones as $p)
                    <a href="tel:{{ trim($p) }}">{{ trim($p) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                    <h6>Email Support</h6>
                    <h5>Write to Us</h5>
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                    <p class="mt-1" style="font-size:0.8rem; color:#aaa;">We reply within 24 hours</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FORM + MAP ===== --}}
<section style="padding: 20px 0 80px; background: #F8F9FA;">
    <div class="container">
        <div class="row g-5 align-items-stretch">

            {{-- Form --}}
            <div class="col-lg-7">
                <div class="form-card h-100">
                    <div class="mb-5">
                        <div style="font-size:0.72rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#C90000; margin-bottom:8px;">&#9650; Let's Talk</div>
                        <h3 class="fw-bold mb-1" style="color:#0B2240; font-size:1.8rem;">Send Us a Message</h3>
                        <p class="text-muted" style="font-size:0.9rem;">Our team will get back to you within 24 hours.</p>
                    </div>

                    @if(session('success'))
                    <div class="d-flex align-items-center gap-3 p-4 rounded-4 mb-4"
                         style="background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.3); color:#059669;">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                        <div>
                            <strong>Message Sent!</strong><br>
                            <span style="font-size:0.88rem;">{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Your full name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+91 XXXXX XXXXX">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label for="subject">Subject</label>
                                    <select id="subject" name="subject">
                                        <option value="">Select a topic…</option>
                                        <option value="Booking Inquiry">Booking Inquiry</option>
                                        <option value="Custom Package">Custom Package</option>
                                        <option value="Hotel Reservation">Hotel Reservation</option>
                                        <option value="Bike Expedition">Bike Expedition</option>
                                        <option value="General Query">General Query</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-field">
                                    <label for="message">Your Message</label>
                                    <textarea id="message" name="message" required placeholder="Tell us about your dream Ladakh trip…">{{ old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex align-items-center gap-4 flex-wrap">
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                                <p class="text-muted mb-0" style="font-size:0.82rem;">
                                    <i class="bi bi-shield-check me-1" style="color:#C90000;"></i>Your info is 100% secure & private.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Map / Image Panel --}}
            <div class="col-lg-5">
                <div class="map-panel">
                    <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=900"
                         alt="Ladakh landscape" style="width:100%; height:100%; min-height:700px; object-fit:cover; display:block;">
                    <div class="map-overlay">
                        <h5 class="text-white fw-bold mb-1">Visit Our Office</h5>
                        <p class="text-white mb-3" style="opacity:0.8; font-size:0.88rem;">{{ $address }}</p>
                        <div class="d-flex gap-3">
                            <a href="https://wa.me/918076782128" target="_blank"
                               class="btn btn-sm fw-bold rounded-pill px-4" style="background:#25D366; color:#fff; border:none;">
                                <i class="bi bi-whatsapp me-1"></i>WhatsApp
                            </a>
                            <a href="tel:+918076782128"
                               class="btn btn-sm fw-bold rounded-pill px-4" style="background:#C90000; color:#fff; border:none;">
                                <i class="bi bi-telephone me-1"></i>Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection