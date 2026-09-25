@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.packages.index') }}" class="text-decoration-none">&larr; Back to Packages</a>
    <h2 class="mt-2">Add New Tour Package</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Package Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Duration *</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 6 Days / 5 Nights" required>
                    @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Starting Price (INR) *</label>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Destination Mapping</label>
                    <select name="destination_id" class="form-select @error('destination_id') is-invalid @enderror">
                        <option value="">Select Destination</option>
                        @foreach ($destinations as $item)
                        <option value="{{ $item->id }}" {{ old('destination_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('destination_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Service Mapping</label>
                    <select name="service_id" class="form-select @error('service_id') is-invalid @enderror">
                        <option value="">Select Service Category</option>
                        @foreach ($services as $srv)
                        <option value="{{ $srv->id }}" {{ old('service_id') == $srv->id ? 'selected' : '' }}>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                    @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Start Location</label>
                    <input type="text" name="start_location" class="form-control" value="{{ old('start_location') }}" placeholder="e.g. Leh">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Difficulty Level</label>
                    <select name="difficulty" class="form-select">
                        <option value="">Select Level</option>
                        <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                        <option value="Moderate" {{ old('difficulty') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                        <option value="Challenging" {{ old('difficulty') == 'Challenging' ? 'selected' : '' }}>Challenging</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Best Season to Visit</label>
                    <input type="text" name="best_season" class="form-control" value="{{ old('best_season') }}" placeholder="e.g. May to September">
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Overview / Description</label>
                    <textarea name="description" rows="4" class="form-control editor">{{ old('description') }}</textarea>
                </div>

                {{-- Inclusions, Exclusions, Itinerary --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Inclusions (One per line)</label>
                    <textarea name="inclusions" rows="5" class="form-control" placeholder="Double sharing accommodation&#10;All meals during trek&#10;Inner Line Permits&#10;Professional bike mechanic">{{ old('inclusions') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Exclusions (One per line)</label>
                    <textarea name="exclusions" rows="5" class="form-control" placeholder="Personal travel insurance&#10;Soft drinks and alcoholic beverages&#10;Tips for guides and drivers">{{ old('exclusions') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold">Itinerary details (Format: Day Name | Title | Description - One per line)</label>
                    <textarea name="itinerary" rows="8" class="form-control" placeholder="Day 1 | Arrival in Leh | Rest and acclimatize to high altitude. Meet group in evening.&#10;Day 2 | Leh to Sham Valley | Explore Sham Valley, visit Alchi monastery and Magnetic Hill.&#10;Day 3 | Leh to Nubra Valley | Drive through Khardung La Pass (highest motorable road).">{{ old('itinerary') }}</textarea>
                    <small class="text-muted">Use the pipe character (|) to separate the day name, day title, and day description. Enter one day per line.</small>
                </div>

                {{-- Options --}}
                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="status" checked value="1">
                        <label class="form-check-label fw-bold" for="status">Published / Active</label>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
                        <label class="form-check-label fw-bold" for="featured">Featured Tour Package</label>
                    </div>
                </div>

                {{-- SEO Metadata --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">SEO Metadata</h5></div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}" placeholder="e.g. Best Bike Tour in Ladakh | Ladakh Tourism">
                    @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Describe the tour package in 150-160 characters for search engines...">{{ old('meta_description') }}</textarea>
                    @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Meta Keywords</label>
                    <textarea name="meta_keywords" rows="2" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="e.g. bike tour ladakh, leh tour, motorbiking ladakh">{{ old('meta_keywords') }}</textarea>
                    @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Package Images</h5></div>
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">You can upload multiple images. First image will be used as the cover photo.</small>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Save Tour Package</button>
            </div>
        </form>
    </div>
</div>
@endsection
