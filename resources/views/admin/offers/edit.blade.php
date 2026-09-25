@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.offers.index') }}" class="text-decoration-none small fw-bold"><i class="bi bi-arrow-left"></i> BACK TO OFFERS</a>
    <h2 class="fw-bold mt-2">Edit Special Offer</h2>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('admin.offers.update', $offer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Offer Title</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $offer->title) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $offer->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Price Point (₹)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $offer->price) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Badge Text (e.g. SAVE 30%)</label>
                        <input type="text" name="discount_tag" class="form-control" value="{{ old('discount_tag', $offer->discount_tag) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Offer Banner Image</label>
                        @if($offer->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $offer->image) }}" class="rounded-3" width="100" height="60" style="object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep existing image.</small>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">UPDATE OFFER</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
