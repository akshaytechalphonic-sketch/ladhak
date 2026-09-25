@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.destinations.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO DESTINATIONS</a>
    <h2 class="fw-bold mt-2">Add New Destination</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Destination Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Maldives Turquoise Atolls">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Detailed Description</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="Tell the story of this location..."></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Specific Location (City/Country)</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. Island Nation, Asia">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">SAVE DESTINATION</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
