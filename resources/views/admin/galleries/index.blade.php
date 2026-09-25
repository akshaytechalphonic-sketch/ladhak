@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold text-navy">Gallery Management</h2>
            <p class="text-muted small">Add and manage visual content for the frontend gallery.</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-navy rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> Add Image
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">{{ session('success') }}</div>
@endif

<div class="row g-4">
    @forelse($galleries as $gallery)
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <div class="position-relative">
                <img src="{{ asset('storage/'.$gallery->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $gallery->title }}">
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge {{ $gallery->status ? 'bg-success' : 'bg-secondary' }} rounded-pill shadow-sm">
                        {{ $gallery->status ? 'Live' : 'Draft' }}
                    </span>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="fw-bold text-navy mb-0 text-truncate">{{ $gallery->title ?? 'Untitled' }}</h6>
                    <small class="badge text-black bg-light text-navy border font-monospace" style="font-size: 0.6rem;">{{ $gallery->category }}</small>
                </div>
                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-pill">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="text-muted">No gallery images found. Start by adding one!</div>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $galleries->links() }}
</div>
@endsection
