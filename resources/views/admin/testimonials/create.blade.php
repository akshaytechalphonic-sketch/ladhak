@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO TESTIMONIALS</a>
    <h2 class="fw-bold mt-2">Add Guest Testimony</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Jane Doe">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Testimony</label>
                        <textarea name="content" class="form-control" rows="6" required placeholder="What did the guest have to say?"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Role/Description</label>
                        <input type="text" name="role" class="form-control" placeholder="Executive Traveler">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Rating (1-5)</label>
                        <select name="rating" class="form-select" required>
                            <option value="5">5 Stars (Excellent)</option>
                            <option value="4">4 Stars (Great)</option>
                            <option value="3">3 Stars (Good)</option>
                            <option value="2">2 Stars (Fair)</option>
                            <option value="1">1 Star (Poor)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Photo</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">PUBLISH TESTIMONY</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
