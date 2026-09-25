@extends('layouts.app')

@section('content')
    @php
        $banner = $sections['banner'] ?? $sections->first();
    @endphp
    <div class="page-header"
        style="background-image: url('{{ $banner && $banner->image ? asset('storage/' . $banner->image) : asset('thumbs/marquee-three-2-bg2.jpg') }}');">
        <div class="container text-center py-5">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInDown text-white">
                {{ $banner->title ?? 'Our Services' }}</h1>
            <p class="lead opacity-75 animate__animated animate__fadeInUp text-white-50">
                {{ $banner->description ?? 'World-class amenities designed for your absolute comfort.' }}</p>
        </div>
    </div>

    <div class="container py-5 mt-5">
        <div class="row g-5">

            @if ($services->count() > 0)
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="card border-0 shadow-premium p-4 rounded-4 h-100 text-center animate__animated animate__fadeInUp">
                            <div class="bg-navy bg-opaci ty- 10  p-4 rounded-circle  mx -a uto mb-4 text-navy"
                                style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">

                                <i class="bi {{ $service->icon ?? 'bi-shield-check' }} fs-1"></i>
                                </di v>


                                <h4 class="fw-bold text-navy mb-3">{{ $service->title }}</h4>
                                <p class="text-muted small mb-4">{!! Str::limit($service->description, 80) !!}</p>
                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('thumbs/service-thumb' . rand(1, 3) . '.jpg') }}"
                                    class="img-fluid rounded-3 mb-3" style="height: 180px; width: 100%; object-fit: cover;"
                                    alt="Service">
                                <a href="{{ route('services.show', $service->id) }}"
                                    class="text-gold fw-bold text-decoration-none small">Learn More <i
                                        class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                @endforeach
            @else
                <div class="col-lg-4 col-md-6">
                    <div
                        class="card border-0 shadow-premium p-4 rounded-4 h-100 text-center animate__animated animate__fadeInUp">
                        <div class="bg-navy bg-opacity-10 p-4 rounded-circle mx-auto mb-4 text-navy"
                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">

                            <i class="bi bi-shield-check fs-1"></i>
                        </div>
                        <h4 class="fw-bo ld  tex t-navy mb-3">Unmatched Security</h4>
                        <p class="text-muted small mb-4">Your safety is our priority. 24/7 surveillance and secure access
                            across all premises.</p>

                        <img src="{{ asset('thumbs/service-thumb1.jpg') }}" class="img-fluid rounded-3 mb-3" alt="Service">
                        <a href="{{ route('services.show', 1) }}" class="text-gold fw-bold text-decoration-none small">Learn
                            More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            @endif
        </div>

    </div>


    <!--     Experience Section -->
    <div class="container py-5 my-5">
        <div class="bg-navy rounded-5 p-5 position-relative overflow-hidden shadow-lg animate__animated animate__fadeIn">

            <div class="row align-i
           tems-center position-rel
     a  tive" style="z-index: 2;">

                <div class="col-lg-7 text-white">
                    <h2 class="display-5 fw-bold mb-4">Beyond Your <span class="text-gold">Expectations</span></h2>
                    <p class="lead opacity-75 mb-5">We provide personalized concierge services to make your stay truly
                        unique. From private jets to city tours, we handle it all.</p>
                    <div class="d-flex gap-4 mb-5">

                        <div class="text-center">
                            <h3 class="fw-bold text-gold mb-0">24/7</h3>
                            <p class="small text-white-50">Support</p>

                        </div>


                        <div class="text-center">
                            <h3 class="f w- bo ld text-gold mb-0">100%</h3>
                            <p class="small text-white-50">Satisfaction</p>

                            </ div>


                            <div class="text-center">

                                <h3 class="fw-bold text-gold mb-0">VIP</h3>

                                <p class="small text-white-50">Treatment</p>
                            </div>

                        </div>
                        <a href
    =       "{{ route('contact') }}"
                            class="btn btn-gold rounded-pill px-5 py-3 fw-bold">Plan Your Trip</a>
                    </div>

                    <div class="col-lg-5 text-center d-none d-lg-block">

                        <img src="{{ asset('thumbs/service-details-thumb.jpg') }}"
                            class="img-fluid rounded-4 shadow-lg animate__animated animate__pulse animate__infinite animate__slow"
                            alt="Concierge">
                    </div>


                </div>

                <i class="b
           i bi-star-fill text-white opacity-10"
                    style="position: absolute; right: -50px; bottom: -50px; font-size: 20rem;"></i>
            </div>
        </div>
    @endsection
