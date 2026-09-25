@extends('layouts.app')

@section('content')


<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{$sections['blog_banner']->image ? asset('storage/'.$sections['blog_banner']->image) : 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 40vh; padding: 120px 0 60px;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <span class="badge bg-primary-blue mb-3 px-3 py-2 rounded-pill text-uppercase ls-1">Travel Chronicles</span>
            <h1 class="display-3 fw-bold text-white mb-3">{{ $sections && $sections['blog_banner']->title ? $sections['blog_banner']->title : 'Stories & Inspirations' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{!! strip_tags($sections && $sections['blog_banner']->description ? $sections['blog_banner']->description : 'Discover travel tips, local secrets, and the latest news from our luxury retreats.') !!}</p>
        </div>
    </div>
</div>

<div class="container py-5 mt-4">
    <div class="row g-4">
        @forelse($blogs as $blog)
        <div class="col-lg-4 col-md-6">
            <div class="card-premium h-100 border-0 shadow-sm d-flex flex-column">
                <div class="card-img-wrapper" style="height: 240px;">
                    <img src="{{ !empty($blog->featured_image) ? asset('storage/'.$blog->featured_image) : 'https://images.unsplash.com/photo-1512100356956-c1227c331f01?auto=format&fit=crop&q=80&w=800' }}" class="w-100 h-100 object-fit-cover" alt="{{ $blog->title }}">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-white text-primary-blue fw-bold small rounded-pill px-3 py-2 shadow-sm">Article</span>
                    </div>
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center text-muted small mb-3 gap-3">
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-calendar icon-sm"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-person icon-sm"></i> Admin</span>
                    </div>
                    <h6 class="fw-bold mb-3 lh-base">{{ $blog->title }}</h6>
                    <p class="small text-muted mb-4 flex-grow-1 opacity-80">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                    
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-link text-primary-blue p-0 fw-bold text-decoration-none small d-flex align-items-center gap-2">
                        Read More <i class="bi bi-arrow-right icon-sm"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-5">
                <i class="bi bi-star icon-md text-muted mb-3 opacity-20" style="width: 64px; height: 64px;"></i>
                <h4 class="text-muted">No stories yet.</h4>
                <p class="text-muted small">We're currently writing some amazing travel stories for you. Please check back later!</p>
            </div>
        </div>
        @endforelse
    </div>
    
    @if($blogs->hasPages())
    <div class="d-flex justify-content-center mt-5 pt-4">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection
