@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.hotels.index') }}" class="text-decoration-none">&larr; Back to Hotels</a>
    <h2 class="mt-2">Edit Hotel: {{ $hotel->name }}</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hotel Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $hotel->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                {{-- <div class="col-md-4">
                    <label class="form-label fw-bold">Location *</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $hotel->location) }}" required>
                    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div> --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold">Destinaitons</label>
                    <select name="destination_id" class="form-select">
                       <option value="">Select One</option>
                       @foreach ($destinations as $item)
                       <option value="{{$item->id}}" {{ $hotel->destination_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                       @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-bold">Star Rating</label>
                    <select name="star_rating" class="form-select">
                        @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}" {{ old('star_rating',$hotel->star_rating) == $i ? 'selected':'' }}>{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Managed By</label>
                    <input type="text" name="managed_by" class="form-control" value="{{ old('managed_by', $hotel->managed_by) }}" placeholder="e.g. Taj Hotels & Resorts">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Unique Selling Points (USPs)</label>
                    <input type="text" name="usps" class="form-control" value="{{ old('usps', $hotel->usps ? implode(', ', $hotel->usps) : '') }}" placeholder="Infinity Pool, Private Beach, Butler Service">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="4" class="form-control editor">{{ old('description', $hotel->description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Amenities</label>
                    <input type="text" name="amenities" class="form-control" value="{{ old('amenities', $hotel->amenities ? implode(', ', $hotel->amenities) : '') }}" placeholder="Free WiFi, Pool, Spa">
                </div>

                {{-- Location Details --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Location & Proximity</h5></div>
                @php
                    $landmarkText = collect($hotel->landmarks ?? [])->map(fn($l) => ($l['name']??'').'|'.($l['distance']??''))->implode("\n");
                    $airportText  = collect($hotel->airports  ?? [])->map(fn($l) => ($l['name']??'').'|'.($l['distance']??''))->implode("\n");
                    $attractionText = collect($hotel->attractions ?? [])->map(fn($l) => ($l['name']??'').'|'.($l['distance']??''))->implode("\n");
                @endphp
                <div class="col-md-4">
                    <label class="form-label fw-bold">Landmarks</label>
                    <textarea name="landmarks" rows="4" class="form-control" placeholder="Name|Distance per line">{{ old('landmarks', $landmarkText) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Airports</label>
                    <textarea name="airports" rows="4" class="form-control" placeholder="Name|Distance per line">{{ old('airports', $airportText) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Attractions</label>
                    <textarea name="attractions" rows="4" class="form-control" placeholder="Name|Distance per line">{{ old('attractions', $attractionText) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Google Maps Embed URL</label>
                    <input type="text" name="map_embed_url" class="form-control" value="{{ old('map_embed_url', $hotel->map_embed_url) }}" placeholder="Paste embed src URL from Google Maps">
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Hotel Images</h5></div>
                @if(!empty($hotel->images))
                <div class="col-12">
                    <label class="form-label text-muted small">Existing Images:</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($hotel->images as $img)
                        <div class="position-relative image-container">
                            <img src="{{ asset('storage/'.$img) }}" height="80" class="rounded border">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 rounded-circle remove-image" 
                                    style="width:20px; height:20px; line-height:1; transform: translate(50%, -50%);"
                                    data-path="{{ $img }}">
                                &times;
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Upload new images to add more. Existing ones are kept.</small>
                </div>
                @endif
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Update Hotel</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.remove-image').forEach(button => {
    button.addEventListener('click', function() {
        if (!confirm('Are you sure you want to remove this image?')) return;

        const container = this.closest('.image-container');
        const path = this.dataset.path;

        fetch('{{ route("admin.hotels.remove-image", $hotel) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ image_path: path })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                container.remove();
            } else {
                alert(data.message || 'Failed to remove image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the image');
        });
    });
});
</script>
@endpush
@endsection
