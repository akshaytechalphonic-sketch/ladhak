@extends('layouts.app')

@section('content')
@php
    $banner = $sections['banner'] ?? $sections->first();
    $allCategories = ['Rooms', 'Amenities', 'Dining', 'Pool', 'Spa', 'Events'];
    $dynamicCats = $galleries->pluck('category')->unique()->filter()->values()->toArray();
    $categories = array_unique(array_merge($allCategories, $dynamicCats));
@endphp

<!-- Page Header -->
<div class="hero-section" style="background-image: url('{{ $banner && $banner->image ? asset('storage/'.$banner->image) : 'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 40vh; padding: 120px 0 60px; display: flex; align-items: center;">
    <div class="hero-overlay" style="background: linear-gradient(rgba(207, 165, 181, 0.25), rgba(167, 176, 188, 0.35))"></div>
    <div class="container hero-content text-center">
        <div class="fade-up">
            <span class="badge mb-3 px-3 py-2 rounded-pill text-uppercase ls-1 text-white" style="background:#C90000;">Visual Showcase</span>
            <h1 class="display-3 fw-bold text-white mb-3">{{ $banner->title ?? 'Ladakh Visual Gallery' }}</h1>
            <p class="lead text-white opacity-90 max-w-700 mx-auto">{!! strip_tags($banner->description ?? 'Explore the majestic landscapes, adventure packages, premium hotels, and cultural experiences in Ladakh.') !!}</p>
        </div>
    </div>
</div>

<div class="container py-5 mt-4">
    {{-- Category Filters --}}
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5 pb-4">
        <button class="btn btn-primary-blue rounded-pill px-4 fw-bold filter-btn active" data-category="all">All Photos</button>
        @foreach($categories as $category)
        @if($galleries->where('category', $category)->count() > 0)
        <button class="btn btn-outline-primary-blue rounded-pill px-4 fw-bold filter-btn" data-category="{{ $category }}">{{ $category }}</button>
        @endif
        @endforeach
    </div>

    {{-- Gallery Grid --}}
    <div class="row g-4" id="gallery-container">
        @forelse($galleries as $gallery)
        <div class="col-lg-4 col-md-6 gallery-item-card" data-category="{{ $gallery->category }}">
            <div class="card-premium h-100 border-0 shadow-sm overflow-hidden gallery-item cursor-pointer" 
                 data-img="{{ asset('storage/'.$gallery->image) }}"
                 data-title="{{ $gallery->title ?? 'Luxury Showcase' }}"
                 data-category="{{ $gallery->category }}">
                <div class="card-img-wrapper" style="height: 300px;">
                    <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid w-100 h-100 object-fit-cover transition-all" alt="{{ $gallery->title }}">
                    <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center text-white text-center p-3">
                        <div class="glass-morphism p-3 rounded-circle mb-3">
                            <i class="bi bi-arrows-fullscreen icon-md"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $gallery->title ?? 'Luxury Showcase' }}</h5>
                        <span class="badge px-3 py-1 rounded-pill small text-white" style="background:#C90000;">{{ $gallery->category }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-5">
                <i class="bi bi-image-alt icon-md text-muted mb-3 opacity-20" style="width: 64px; height: 64px;"></i>
                <h4 class="text-muted">No images found.</h4>
                <p class="text-muted small">We're currently updating our gallery with new photos.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

{{-- Lightbox Modal --}}
<div class="modal fade" id="lightboxModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4 shadow-none" style="z-index: 10;" data-bs-dismiss="modal"></button>
                <div class="glass-morphism rounded-5 overflow-hidden p-2">
                    <img id="lightboxImg" src="" class="d-block w-100 rounded-4" style="max-height:80vh; object-fit:contain;">
                    <div class="p-4 text-white text-center">
                        <h4 id="lightboxTitle" class="fw-bold mb-1"></h4>
                        <span id="lightboxCategory" class="badge px-3 py-2 rounded-pill small text-white" style="background:#C90000;"></span>
                    </div>
                </div>
                {{-- Navigation Arrows --}}
                <button id="lightboxPrev" class="btn glass-morphism position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle text-white d-flex align-items-center justify-content-center" style="width:56px;height:56px; border: 1px solid rgba(255,255,255,0.2);"><i class="bi bi-chevron-left"></i></button>
                <button id="lightboxNext" class="btn glass-morphism position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle text-white d-flex align-items-center justify-content-center" style="width:56px;height:56px; border: 1px solid rgba(255,255,255,0.2);"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-overlay {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(11, 34, 64, 0.85); opacity: 0; transition: all 0.4s ease;
    backdrop-filter: blur(4px);
}
.gallery-item:hover .gallery-overlay { opacity: 1; }
.filter-btn { transition: all 0.3s; border-width: 2px; }
.filter-btn.active { box-shadow: 0 4px 15px rgba(11, 34, 64, 0.2); }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.gallery-item-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('active', 'btn-primary-blue');
                b.classList.add('btn-outline-primary-blue');
            });
            this.classList.add('active', 'btn-primary-blue');
            this.classList.remove('btn-outline-primary-blue');
            const cat = this.dataset.category;
            let visible = [];
            items.forEach(item => {
                if (cat === 'all' || item.dataset.category === cat) {
                    item.style.display = 'block';
                    visible.push(item);
                } else {
                    item.style.display = 'none';
                }
            });
            currentVisible = visible.map(el => el.querySelector('.gallery-item'));
            currentIndex = 0;
        });
    });

    // Lightbox Logic
    let currentVisible = [...document.querySelectorAll('.gallery-item')];
    let currentIndex = 0;

    function openLightbox(index) {
        const item = currentVisible[index];
        document.getElementById('lightboxImg').src = item.dataset.img;
        document.getElementById('lightboxTitle').textContent = item.dataset.title;
        document.getElementById('lightboxCategory').textContent = item.dataset.category;
        currentIndex = index;
        const modal = new bootstrap.Modal(document.getElementById('lightboxModal'));
        modal.show();
    }

    document.querySelectorAll('.gallery-item').forEach((item, i) => {
        item.addEventListener('click', () => {
            const indexInVisible = currentVisible.indexOf(item);
            if (indexInVisible !== -1) openLightbox(indexInVisible);
        });
    });

    document.getElementById('lightboxPrev').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + currentVisible.length) % currentVisible.length;
        updateLightbox();
    });

    document.getElementById('lightboxNext').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % currentVisible.length;
        updateLightbox();
    });

    function updateLightbox() {
        const item = currentVisible[currentIndex];
        document.getElementById('lightboxImg').src = item.dataset.img;
        document.getElementById('lightboxTitle').textContent = item.dataset.title;
        document.getElementById('lightboxCategory').textContent = item.dataset.category;
    }

    // Keyboard navigation
    document.addEventListener('keydown', e => {
        const modal = document.getElementById('lightboxModal');
        if (!modal.classList.contains('show')) return;
        if (e.key === 'ArrowLeft') document.getElementById('lightboxPrev').click();
        if (e.key === 'ArrowRight') document.getElementById('lightboxNext').click();
    });
});
</script>
@endpush
@endsection