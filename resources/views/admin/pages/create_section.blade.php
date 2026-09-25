@extends('admin.layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.sections', $page) }}">{{ $page->page_name }} Sections</a></li>
        <li class="breadcrumb-item active">Add New Section</li>
    </ol>
</nav>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Add New Section to <span class="text-primary">{{ $page->page_name }}</span></h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.sections.store', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Section Identifier (System Name)</label>
                    <input type="text" name="section_name" class="form-control" placeholder="e.g. features_list" required>
                    <small class="text-muted">Used by developers to identify this section in the code.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Section Title (Public)</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Our Award Winning Features">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Description / Content</label>
                    <textarea name="description" class="form-control editor" rows="4" placeholder="Main text content for this section">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Featured Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" selected>Visible</option>
                        <option value="0">Hidden</option>
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Extra Configuration (Advanced)</h6>
                    <p class="small text-muted">Use this area to add additional fields like button text, icon names, or background colors in JSON format.</p>
                    <textarea name="extra_data_json" class="form-control font-monospace" rows="4" placeholder='{"button_text": "Book Now", "icon": "bi-star"}'></textarea>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-primary px-5 py-2">Add Section</button>
                    <a href="{{ route('admin.pages.sections', $page) }}" class="btn btn-light px-5 py-2 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
