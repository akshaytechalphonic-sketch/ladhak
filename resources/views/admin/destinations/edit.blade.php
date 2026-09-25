@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO DESTINATIONS</a>
    <h2 class="fw-bold mt-2">Edit Destination</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Destination Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $destination->name) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Detailed Description</label>
                        <textarea name="description" class="form-control" rows="8">{{ old('description', $destination->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Specific Location (City/Country)</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $destination->location) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Featured Image</label>
                        @if($destination->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $destination->image) }}" class="rounded-3" width="100" height="60" style="object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep existing image.</small>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">UPDATE DESTINATION</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
