@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.sections', $section->page_id) }}">Sections</a></li>
            <li class="breadcrumb-item active">Edit Section</li>
        </ol>
    </nav>
    <h2>Edit {{ ucfirst(str_replace('_', ' ', $section->section_name)) }} Section</h2>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.pages.sections.update', $section) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Section Title</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $section->title) }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Section Description</label>
                        <textarea name="description" class="form-control editor @error('description') is-invalid @enderror" rows="5">{{ old('description', $section->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Section Image (Optional)</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if($section->image)
                            <div class="mt-3">
                                <p class="small text-muted mb-1">Current Image:</p>
                                <img src="{{ asset('storage/'.$section->image) }}" class="img-fluid rounded-3 border" style="max-height: 150px;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Section Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $section->status ? 'selected' : '' }}>Published (Live)</option>
                            <option value="0" {{ !$section->status ? 'selected' : '' }}>Draft (Hidden)</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="p-4 bg-light rounded-4 border">
                        <h6 class="fw-bold mb-4 text-navy"><i class="bi bi-gear-fill me-2"></i> Advanced Content Settings (JSON)</h6>
                        <textarea name="extra_data_json" class="form-control font-monospace mb-2 @error('extra_data_json') is-invalid @enderror" rows="6" placeholder='{"key": "value"}'>{{ old('extra_data_json', json_encode($section->extra_data, JSON_PRETTY_PRINT)) }}</textarea>
                        @error('extra_data_json') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <p class="small text-muted mb-0"><i class="bi bi-info-circle me-1"></i> Use JSON format to add extra fields like button text, icons, or background colors.</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <button type="submit" class="btn btn-navy px-5 py-3 fw-bold rounded-pill shadow-sm">SAVE CHANGES</button>
                <a href="{{ route('admin.pages.sections', $section->page_id) }}" class="btn btn-link text-muted fw-bold text-decoration-none ms-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
