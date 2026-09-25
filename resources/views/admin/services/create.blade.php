@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO SERVICES</a>
    <h2 class="fw-bold mt-2">Create New Service</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Service Title</label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g. Infinity Spa & Wellness">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control editor" rows="5" required placeholder="Describe the luxury service..."></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Bootstrap Icon Class</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-info-circle"></i></span>
                            <input type="text" name="icon" class="form-control" placeholder="bi-shield-check">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">High resolution images recommended (2MB max)</small>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                            <label class="form-check-label fw-bold" for="status">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">CREATE SERVICE</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
