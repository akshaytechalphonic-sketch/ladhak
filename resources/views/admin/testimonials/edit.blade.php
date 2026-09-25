@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO TESTIMONIALS</a>
    <h2 class="fw-bold mt-2">Edit Guest Testimony</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $testimonial->name) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Testimony</label>
                        <textarea name="content" class="form-control" rows="6" required>{{ old('content', $testimonial->content) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Role/Description</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', $testimonial->role) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Rating (1-5)</label>
                        <select name="rating" class="form-select" required>
                            @for($i=5; $i>=1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Guest Photo</label>
                        @if($testimonial->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep existing photo.</small>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">UPDATE TESTIMONY</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
