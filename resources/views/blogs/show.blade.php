@extends('layouts.app')


@push('styles')
<style>
/* Reading progress */
#reading-progress {
    position: fixed; top: 0; left: 0; height: 3px;
    background: linear-gradient(to right, #C90000, #ff4444);
    z-index: 9999; width: 0%; transition: width 0.1s linear;
}

/* Hero */
.blog-hero {
    position: relative; min-height: 460px;
    display: flex; align-items: flex-end;
    background-size: cover; background-position: center; overflow: hidden;
}
.blog-hero::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(11,34,64,0.96) 0%, rgba(11,34,64,0.45) 55%, rgba(0,0,0,0.15) 100%);
}
.blog-hero .content { position: relative; z-index: 2; padding-bottom: 56px; }

/* Main article card */
.blog-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    padding: 44px 48px;
    margin-top: -48px; position: relative; z-index: 10;
}
@media (max-width: 767px) { .blog-card { padding: 24px 18px; } }

/* Blog body */
.blog-body { font-size: 1rem; line-height: 1.85; color: #374151; }
.blog-body p { margin-bottom: 1.5rem; }
.blog-body h2 { font-size: 1.4rem; font-weight: 700; color: #0B2240; margin: 2rem 0 1rem; }
.blog-body blockquote {
    border-left: 4px solid #C90000; padding: 1rem 1.5rem;
    background: #fff8f8; border-radius: 0 12px 12px 0;
    font-style: italic; color: #666; margin: 2rem 0;
}

/* Tag */
.blog-tag {
    display: inline-block; background: #f0f4f8; color: #0B2240;
    padding: 4px 14px; border-radius: 50px;
    font-size: 0.73rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
}
.blog-tag:hover { background: #C90000; color: #fff; }

/* Author card */
.author-card {
    background: linear-gradient(135deg, #0B2240, #1a3a5c);
    border-radius: 16px; color: #fff; padding: 24px 28px;
}
.author-avatar {
    width: 56px; height: 56px; border-radius: 50%;
    background: #C90000; display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; font-weight: 800; color: #fff; flex-shrink: 0;
}

/* CTA */
.blog-cta {
    background: linear-gradient(135deg, #C90000, #a30000);
    border-radius: 18px; padding: 36px; text-align: center; color: #fff;
}

/* ===== SIDEBAR ===== */
.sidebar-sticky { position: sticky; top: 90px; }

.sidebar-box {
    background: #fff; border-radius: 16px;
    border: 1px solid #eef0f3;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    overflow: hidden; margin-bottom: 20px;
}
.sidebar-box .sb-head {
    background: #0B2240; color: #fff;
    padding: 14px 20px; font-size: 0.72rem;
    font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
    display: flex; align-items: center; gap: 8px;
}
.sidebar-box .sb-head i { color: #C90000; }
.sidebar-box .sb-body { padding: 16px; }

/* Recent post row */
.recent-post {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 12px 0; border-bottom: 1px solid #f5f5f5;
    text-decoration: none; transition: all 0.2s;
}
.recent-post:last-child { border-bottom: none; padding-bottom: 4px; }
.recent-post:hover .rp-title { color: #C90000; }
.recent-post:hover .rp-img { transform: scale(1.04); }
.rp-img-wrap {
    width: 72px; height: 56px; border-radius: 8px;
    overflow: hidden; flex-shrink: 0;
}
.rp-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
.rp-title {
    font-size: 0.82rem; font-weight: 600; color: #1a1e23;
    line-height: 1.4; margin-bottom: 4px; transition: color 0.2s;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.rp-date { font-size: 0.7rem; color: #aaa; display: flex; align-items: center; gap: 4px; }

/* Share buttons */
.share-btn {
    width: 36px; height: 36px; border-radius: 50%;
    border: 2px solid #e5e7eb;
    display: flex; align-items: center; justify-content: center;
    color: #666; text-decoration: none; transition: all 0.2s; background: #fff;
}
.share-btn:hover { background: #C90000; border-color: #C90000; color: #fff; }

/* Quick contact */
.quick-contact {
    background: #0B2240; border-radius: 16px; padding: 20px;
    color: #fff; margin-bottom: 20px;
}
</style>
@endpush

@section('content')
@php
    $heroBg = $blog->image
        ? asset('storage/'.$blog->image)
        : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&q=80&w=1920';
    $fallbacks = [
        'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&q=80&w=400',
        'https://images.unsplash.com/photo-1598897516650-df69c2fdd6a7?auto=format&fit=crop&q=80&w=400',
        'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=400',
    ];
@endphp

<div id="reading-progress"></div>

{{-- ===== HERO ===== --}}
<div class="blog-hero" style="background-image: url('{{ $heroBg }}');">
    <div class="container content w-100">
        <div class="row">
            <div class="col-lg-9">
                <a href="{{ route('blogs.index') }}" class="btn btn-sm fw-bold rounded-pill mb-4"
                   style="background:rgba(255,255,255,0.15); color:#fff; border:1px solid rgba(255,255,255,0.4); backdrop-filter:blur(4px);">
                    <i class="bi bi-arrow-left me-1"></i> Back to Blog
                </a>
                @if($blog->category)
                <div class="mb-2">
                    <span class="badge rounded-pill" style="background:#C90000; font-size:0.72rem; padding:5px 14px; letter-spacing:1px;">
                        {{ $blog->category }}
                    </span>
                </div>
                @endif
                <h1 class="fw-bold text-white mb-4" style="font-size:clamp(1.6rem,4vw,2.8rem); line-height:1.2;">
                    {{ $blog->title }}
                </h1>
                <div class="d-flex align-items-center gap-3 flex-wrap" style="font-size:0.82rem; color:rgba(255,255,255,0.75);">
                    <span><i class="bi bi-person-fill me-1" style="color:#C90000;"></i>{{ $blog->user->name ?? 'Ladakh Tourism' }}</span>
                    <span><i class="bi bi-calendar3 me-1" style="color:#C90000;"></i>{{ $blog->created_at->format('d M Y') }}</span>
                    <span><i class="bi bi-clock me-1" style="color:#C90000;"></i>{{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== TWO-COLUMN LAYOUT ===== --}}
<div class="container py-4" style="max-width: 1400px;">
    <div class="row g-4">

        {{-- ===== LEFT: ARTICLE ===== --}}
        <div class="col-lg-8">
            <div class="blog-card">
                <div class="blog-body mb-5">
                    {!! $blog->content!!}
                </div>

                {{-- Tags --}}
                <div class="d-flex flex-wrap gap-2 pb-4 mb-4 border-bottom">
                    @if($blog->category)
                        <a href="#" class="blog-tag">#{{ $blog->category }}</a>
                    @endif
                    <a href="#" class="blog-tag">#Ladakh</a>
                    <a href="#" class="blog-tag">#HimalayanTravel</a>
                    <a href="#" class="blog-tag">#TravelIndia</a>
                </div>

                {{-- Share row --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <span style="font-size:0.8rem; font-weight:700; color:#0B2240;">Share this article:</span>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title.' '  .request()->url()) }}" target="_blank" class="share-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(request()->url()) }}" class="share-btn" title="Email"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>

                {{-- Author --}}
                <div class="author-card">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="author-avatar">{{ substr($blog->user->name ?? 'A', 0, 1) }}</div>
                        <div>
                            <div style="font-size:0.68rem; opacity:0.6; text-transform:uppercase; letter-spacing:1px; margin-bottom:3px;">Written by</div>
                            <div class="fw-bold mb-1">{{ $blog->user->name ?? 'Ladakh Tourism Team' }}</div>
                            <div style="font-size:0.82rem; opacity:0.7;">Travel expert &amp; Himalayan adventure specialist.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="blog-cta mt-4">
                <i class="bi bi-compass fs-1 mb-2 d-block" style="opacity:0.8;"></i>
                <h5 class="fw-bold mb-2">Ready to Experience Ladakh?</h5>
                <p style="opacity:0.85; font-size:0.9rem;" class="mb-3">Let our experts craft your perfect Himalayan adventure.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('packages.index') }}" class="btn fw-bold px-4 py-2 rounded-pill" style="background:#fff; color:#C90000; font-size:0.85rem;">
                        <i class="bi bi-grid me-1"></i>View Packages
                    </a>
                    <a href="{{ route('contact') }}" class="btn fw-bold px-4 py-2 rounded-pill" style="background:rgba(255,255,255,0.18); color:#fff; border:2px solid rgba(255,255,255,0.5); font-size:0.85rem;">
                        <i class="bi bi-chat me-1"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== RIGHT: SIDEBAR ===== --}}
        <div class="col-lg-4">
            <div class="sidebar-sticky">

                {{-- Quick Contact Box --}}
                <div class="quick-contact">
                    <h6 class="fw-bold mb-1" style="font-size:0.88rem;">Plan Your Ladakh Trip</h6>
                    <p style="font-size:0.78rem; opacity:0.65; margin-bottom:14px;">Free consultation with our travel experts.</p>
                    <a href="tel:+918076782128" class="btn w-100 fw-bold rounded-pill mb-2" style="background:#C90000; color:#fff; border:none; font-size:0.82rem; padding:9px;">
                        <i class="bi bi-telephone me-2"></i>+91 80767 82128
                    </a>
                    <a href="{{ route('contact') }}" class="btn w-100 fw-bold rounded-pill" style="background:rgba(255,255,255,0.1); color:#fff; border:1px solid rgba(255,255,255,0.25); font-size:0.82rem; padding:9px;">
                        <i class="bi bi-chat me-2"></i>Send a Message
                    </a>
                </div>

                {{-- Recent Posts --}}
                @if($relatedBlogs->count() > 0)
                <div class="sidebar-box">
                    <div class="sb-head">
                        <i class="bi bi-clock-history"></i> Recent Posts
                    </div>
                    <div class="sb-body">
                        @foreach($relatedBlogs->take(4) as $i => $rb)
                        <a href="{{ route('blogs.show', $rb->slug) }}" class="recent-post">
                            <div class="rp-img-wrap">
                                <img class="rp-img"
                                     src="{{ $rb->featured_image ? asset('storage/'.$rb->featured_image) : $fallbacks[$i % 3] }}"
                                     alt="{{ $rb->title }}" loading="lazy">
                            </div>
                            <div style="flex:1; min-width:0;">
                                <div class="rp-title">{{ $rb->title }}</div>
                                <div class="rp-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $rb->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- You May Also Like (larger cards) --}}
                @if($relatedBlogs->count() > 4)
                <div class="sidebar-box">
                    <div class="sb-head">
                        <i class="bi bi-hand-thumbs-up"></i> You May Also Like
                    </div>
                    <div class="sb-body" style="padding:12px;">
                        @foreach($relatedBlogs->slice(4) as $i => $rb)
                        <a href="{{ route('blogs.show', $rb->slug) }}" style="display:block; text-decoration:none; margin-bottom:10px;">
                            <div style="border-radius:10px; overflow:hidden; position:relative; height:110px;">
                                <img src="{{ $rb->image ? asset('storage/'.$rb->image) : $fallbacks[$i % 3] }}"
                                     alt="{{ $rb->title }}"
                                     style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     loading="lazy">
                                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(11,34,64,0.85) 0%, transparent 60%); display:flex; align-items:flex-end; padding:10px;">
                                    <span style="font-size:0.78rem; font-weight:600; color:#fff; line-height:1.3;">{{ Str::limit($rb->title, 55) }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="sidebar-box">
                    <div class="sb-head"><i class="bi bi-share"></i> Share Article</div>
                    <div class="sb-body">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title.' '.request()->url()) }}" target="_blank" class="share-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                            <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(request()->url()) }}" class="share-btn" title="Email"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Back to blog --}}
                <a href="{{ route('blogs.index') }}" class="btn w-100 fw-bold rounded-pill py-2 mt-1"
                   style="border:2px solid #0B2240; color:#0B2240; font-size:0.82rem;">
                    <i class="bi bi-arrow-left me-2"></i>Back to All Stories
                </a>

            </div>
        </div>
        {{-- end sidebar --}}

    </div>
</div>

<div style="margin-bottom: 60px;"></div>

<script>
window.addEventListener('scroll', function() {
    const el = document.getElementById('reading-progress');
    const doc = document.documentElement;
    const scrollTop = doc.scrollTop || document.body.scrollTop;
    const scrollHeight = doc.scrollHeight - doc.clientHeight;
    el.style.width = scrollHeight > 0 ? (scrollTop / scrollHeight * 100) + '%' : '0%';
});
</script>
@endsection
