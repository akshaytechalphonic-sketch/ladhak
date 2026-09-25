@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.packages.index') }}" class="text-decoration-none">&larr; Back to Packages</a>
    <h2 class="mt-2">Edit Tour Package: {{ $package->title }}</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Package Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $package->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Duration *</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $package->duration) }}" placeholder="e.g. 6 Days / 5 Nights" required>
                    @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Starting Price (INR) *</label>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $package->price) }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Destination Mapping</label>
                    <select name="destination_id" class="form-select @error('destination_id') is-invalid @enderror">
                        <option value="">Select Destination</option>
                        @foreach ($destinations as $item)
                        <option value="{{ $item->id }}" {{ old('destination_id', $package->destination_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('destination_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Service Mapping</label>
                    <select name="service_id" class="form-select @error('service_id') is-invalid @enderror">
                        <option value="">Select Service Category</option>
                        @foreach ($services as $srv)
                        <option value="{{ $srv->id }}" {{ old('service_id', $package->service_id) == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                    @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Start Location</label>
                    <input type="text" name="start_location" class="form-control" value="{{ old('start_location', $package->start_location) }}" placeholder="e.g. Leh">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Difficulty Level</label>
                    <select name="difficulty" class="form-select">
                        <option value="">Select Level</option>
                        <option value="Easy" {{ old('difficulty', $package->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                        <option value="Moderate" {{ old('difficulty', $package->difficulty) == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="Hard" {{ old('difficulty', $package->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                        <option value="Challenging" {{ old('difficulty', $package->difficulty) == 'Challenging' ? 'selected' : '' }}>Challenging</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Best Season to Visit</label>
                    <input type="text" name="best_season" class="form-control" value="{{ old('best_season', $package->best_season) }}" placeholder="e.g. May to September">
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Overview / Description</label>
                    <textarea name="description" rows="4" class="form-control editor">{{ old('description', $package->description) }}</textarea>
                </div>

                {{-- Inclusions, Exclusions, Itinerary --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Inclusions (One per line)</label>
                    <textarea name="inclusions" rows="5" class="form-control" placeholder="Double sharing accommodation&#10;All meals during trek">{{ old('inclusions', $package->inclusions ? implode("\n", $package->inclusions) : '') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Exclusions (One per line)</label>
                    <textarea name="exclusions" rows="5" class="form-control" placeholder="Personal travel insurance&#10;Soft drinks and alcoholic beverages">{{ old('exclusions', $package->exclusions ? implode("\n", $package->exclusions) : '') }}</textarea>
                </div>

                @php
                    $itineraryText = '';
                    if (!empty($package->itinerary)) {
                        foreach ($package->itinerary as $item) {
                            $itineraryText .= ($item['day'] ?? '') . ' | ' . ($item['title'] ?? '') . ' | ' . ($item['description'] ?? '') . "\n";
                        }
                    }
                @endphp
                <div class="col-12">
                    <label class="form-label fw-bold">Itinerary details (Format: Day Name | Title | Description - One per line)</label>
                    <textarea name="itinerary" rows="8" class="form-control" placeholder="Day 1 | Arrival in Leh | Rest and acclimatize.&#10;Day 2 | Leh to Sham Valley | Explore Sham Valley.">{{ old('itinerary', trim($itineraryText)) }}</textarea>
                    <small class="text-muted">Use the pipe character (|) to separate the day name, day title, and day description. Enter one day per line.</small>
                </div>

                {{-- Options --}}
                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', $package->status) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="status">Published / Active</label>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $package->featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="featured">Featured Tour Package</label>
                    </div>
                </div>

                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $package->meta_title) }}" placeholder="e.g. Best Bike Tour in Ladakh | Ladakh Tourism">
                    @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Describe the tour package in 150-160 characters for search engines...">{{ old('meta_description', $package->meta_description) }}</textarea>
                    @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <textarea name="meta_keywords" rows="2" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="e.g. bike tour ladakh, leh tour, motorbiking ladakh">{{ old('meta_keywords', $package->meta_keywords) }}</textarea>
                    @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Existing Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Package Images</h5></div>
                @if(!empty($package->images))
                <div class="col-12">
                    <label class="form-label text-muted small">Existing Images:</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($package->images as $img)
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
                <button type="submit" class="btn btn-primary px-5">Update Tour Package</button>
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

        fetch('{{ route("admin.packages.remove-image", $package) }}', {
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
