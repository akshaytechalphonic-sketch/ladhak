@extends('layouts.app')
@section('content')
<!-- Hero Header -->
<div class="py-5 text-white" style="background:linear-gradient(rgba(167, 99, 125, 0.25), rgba(10, 34, 64, 0.35)),   url('{{ !empty($sections['package_banner']->image) ? asset('storage/' . $sections['package_banner']->image) : asset('images/default-banner.jpg') }}') no-repeat center center; background-size: cover; min-height: 440px; display: flex; align-items: center;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">{{ $sections['package_banner']->title ?? 'Ladakh Tour Packages' }}</h1>
        <div class="lead opacity-90">{!! $sections['package_banner']->description ?? 'Explore our handpicked premium tours and adventure itineraries across Ladakh.' !!}</div>
    </div>
</div>

<!-- Filters & Listings -->
<div class="container py-5">
    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-5" style="background-color: #f8fafc; border-left: 5px solid #C90000 !important;">
        <form action="{{ route('packages.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Destination</label>
                    <select name="destination_id" class="form-select border-0 shadow-sm py-2">
                        <option value="">All Destinations</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Category / Service</label>
                    <select name="service_id" class="form-select border-0 shadow-sm py-2">
                        <option value="">All Categories</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ request('service_id') == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Difficulty</label>
                    <select name="difficulty" class="form-select border-0 shadow-sm py-2">
                        <option value="">All Difficulties</option>
                        <option value="Easy" {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                        <option value="Moderate" {{ request('difficulty') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="Hard" {{ request('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary-blue w-100 py-2 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-filter"></i> Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Package Grid -->
    <div class="row g-4">
        @forelse($packages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="card card-premium shadow-sm border-0 h-100 d-flex flex-column rounded-4 overflow-hidden">
                    <div class="card-img-wrapper" style="height: 240px; position: relative;">
                        <img src="{{ !empty($package->images) ? asset('storage/'.$package->images[0]) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="{{ $package->title }}">
                        
                        <!-- Badges -->
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge text-white px-3 py-2 rounded-pill fw-bold" style="background-color: #0B2240;">
                                <i class="bi bi-clock me-1"></i> {{ $package->duration }}
                            </span>
                        </div>
                        
                        @if($package->featured)
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge px-3 py-2 rounded-pill fw-bold text-white" style="background: #C90000;">
                                    <i class="bi bi-star-fill me-1"></i> Featured
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted small fw-semibold">
                                <i class="bi bi-geo-alt-fill me-1" style="color: #C90000;"></i>
                                {{ $package->destination ? $package->destination->name : 'Ladakh' }}
                            </span>
                            @if($package->difficulty)
                                <span class="badge bg-light text-dark border px-2 py-1 rounded small">
                                    {{ $package->difficulty }}
                                </span>
                            @endif
                        </div>

                        <h6 class="fw-bold mb-3 lh-base text-dark-blue">{{ $package->title }}</h6>
                        
                        <p class="text-muted small mb-4 flex-grow-1">
                            {{ Str::limit(strip_tags($package->description), 120) }}
                        </p>
                        
                        <!-- Divider -->
                        <hr class="my-3 opacity-10">

                        <div class="d-flex align-items-center justify-content-between mt-auto gap-1">
                            <div>
                                <small class="text-muted d-block" style="font-size: 10px;">Starting From</small>
                                <span class="fs-5 fw-bold text-primary-blue">₹{{ number_format($package->price, 0) }}</span>
                                <small class="text-muted" style="font-size: 10px;">/ pax</small>
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
                                <a href="{{ route('packages.show', $package->slug) }}" class="btn btn-outline-dark rounded-pill px-2.5 py-1.5 fw-bold" style="font-size: 0.78rem;">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-light p-5 rounded-4 border">
                    <i class="bi bi-emoji-frown fs-1 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold">No Tour Packages Available</h4>
                    <p class="text-muted">Try resetting your filters or check back later.</p>
                    <a href="{{ route('packages.index') }}" class="btn btn-primary-blue rounded-pill px-4 mt-3">Reset Filters</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($packages->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $packages->links() }}
        </div>
    @endif
</div>
@endsection
