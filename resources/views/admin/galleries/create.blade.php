@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.galleries.index') }}">Gallery</a></li>
            <li class="breadcrumb-item active">Add Image</li>
        </ol>
    </nav>
    <h2 class="fw-bold text-navy text-uppercase ls-1">Add Image to Gallery</h2>
</div>

<div class="card border-0 shadow-premium rounded-4 overflow-hidden">
    <div class="card-body p-4 p-lg-5">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Image Title (Optional)</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="E.g. Presidential Suite Interior">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Category</label>
                        <select name="category" class="form-select form-select-lg @error('category') is-invalid @enderror">
                            <option value="Architecture">Architecture</option>
                            <option value="Interiors">Interiors</option>
                            <option value="Life & Style">Life & Style</option>
                            <option value="Dining">Dining</option>
                            <option value="Wellness">Wellness</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Select Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        <p class="small text-muted mt-2">Recommended size: 1200x800px. Max 2MB.</p>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Display Status</label>
                        <select name="status" class="form-select form-select-lg">
                            <option value="1">Published (Live)</option>
                            <option value="0">Draft (Hidden)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-top">
                <button type="submit" class="btn btn-navy px-5 py-3 fw-bold rounded-pill shadow-premium">UPLOAD IMAGE</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-link text-muted fw-bold ms-3 text-decoration-none">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
