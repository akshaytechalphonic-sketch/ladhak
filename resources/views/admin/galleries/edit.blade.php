@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.galleries.index') }}">Gallery</a></li>
            <li class="breadcrumb-item active">Edit Image</li>
        </ol>
    </nav>
    <h2 class="fw-bold text-navy text-uppercase ls-1">Edit Gallery Image</h2>
</div>

<div class="card border-0 shadow-premium rounded-4 overflow-hidden">
    <div class="card-body p-4 p-lg-5">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Image Title (Optional)</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $gallery->title) }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Category</label>
                        <select name="category" class="form-select form-select-lg @error('category') is-invalid @enderror">
                            @foreach(['Architecture', 'Interiors', 'Life & Style', 'Dining', 'Wellness'] as $cat)
                                <option value="{{ $cat }}" {{ $gallery->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Change Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @if($gallery->image)
                            <div class="mt-3">
                                <p class="small text-muted mb-1">Current Image:</p>
                                <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid rounded-3 border" style="max-height: 150px;">
                            </div>
                        @endif
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase mb-2">Display Status</label>
                        <select name="status" class="form-select form-select-lg">
                            <option value="1" {{ $gallery->status ? 'selected' : '' }}>Published (Live)</option>
                            <option value="0" {{ !$gallery->status ? 'selected' : '' }}>Draft (Hidden)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-top">
                <button type="submit" class="btn btn-navy px-5 py-3 fw-bold rounded-pill shadow-premium">UPDATE GALLERY ITEM</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-link text-muted fw-bold ms-3 text-decoration-none">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
