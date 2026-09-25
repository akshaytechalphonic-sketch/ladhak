@extends('admin.layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
        <li class="breadcrumb-item active">Edit Page Meta</li>
    </ol>
</nav>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Edit Page Details & SEO: <span class="text-primary">{{ $page->page_name }}</span></h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Page Name</label>
                    <input type="text" name="page_name" class="form-control" value="{{ $page->page_name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Slug (URL)</label>
                    <input type="text" name="slug" class="form-control" value="{{ $page->slug }}" {{ in_array($page->slug, ['home', 'about-us']) ? 'readonly' : '' }} required>
                    <small class="text-muted">Slug for core pages cannot be changed.</small>
                </div>

                <div class="col-12 mt-4">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">SEO Metadata</h6>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}" placeholder="SEO Title for browser tab">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief summary for search engines">{{ $page->meta_description }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" value="{{ $page->meta_keywords }}" placeholder="keyword1, keyword2, keyword3">
                </div>

                <div class="col-md-6 mt-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $page->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$page->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-primary px-5 py-2">Update Page</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light px-5 py-2 ms-2">Cancel</a>
                    <a href="{{ route('admin.pages.sections', $page) }}" class="btn btn-outline-primary px-5 py-2 ms-auto float-end">Manage Sections</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
