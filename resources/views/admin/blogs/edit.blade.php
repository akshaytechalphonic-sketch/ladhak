@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none">&larr; Back to Blogs</a>
    <h2 class="mt-2">Edit Blog Post</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Post Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3 d-flex align-items-end pb-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Publish Post</label>
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Post Content</label>
                    <textarea name="content" rows="10" class="form-control editor @error('content') is-invalid @enderror">{{ old('content', $blog->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-4">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image.</small>
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    
                    @if($blog->featured_image)
                        <div class="mt-3">
                            <p class="mb-2 fw-bold">Current Image:</p>
                            <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="Featured Image" style="max-height: 150px;" class="rounded border">
                        </div>
                    @endif
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary px-4">Update Post</button>
        </form>
    </div>
</div>
@endsection
