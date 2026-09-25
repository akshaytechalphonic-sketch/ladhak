@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{ $sections['destination_banner']->image ? asset('storage/'.$sections['destination_banner']->image) : 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 41vh; padding: 120px 0 60px;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <h1 class="display-3 fw-bold text-white mb-3">{{ $sections['destination_banner']->title ?? 'Breathtaking Destinations' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{!! $sections['destination_banner']->description ?? 'Explore our curated selection of the world\'s most beautiful and iconic locations.' !!}</p>
        </div>
    </div>
</div>

<!-- Destinations Grid -->
<div class="container py-5 mt-5">
    <div class="row g-4">
        @forelse($destinations as $destination)
        <div class="col-lg-4 col-md-6">
            <div class="card-premium h-100 shadow-sm border-0">
                <div class="card-img-wrapper" style="aspect-ratio: 1/1.2;">
                    <img src="{{ $destination->image ? asset('storage/'.$destination->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $destination->name }}">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge glass-morphism text-dark px-3 py-2 rounded-pill fw-bold">
                            <i class="bi bi-geo-alt icon-sm text-primary-blue me-1"></i> Featured
                        </span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.8))">
                        <h3 class="fw-bold text-white mb-2">{{ $destination->name }}</h3>
                        <p class="small mb-3 opacity-90 line-clamp-2">{{ strip_tags($destination->description ?? 'Explore the hidden gems and popular spots of this beautiful destination.') }}</p>
                        <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-light rounded-pill px-4 py-2 small fw-bold text-primary-blue">
                            Explore Details <i class="bi bi-arrow-right icon-sm ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-5">
                <i class="bi bi-map icon-md text-muted mb-3" style="width: 64px; height: 64px;"></i>
                <h4 class="text-muted">No destinations available at the moment.</h4>
                <p class="text-muted small">Please check back later for our new updates.</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{-- $destinations->links() --}}
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
