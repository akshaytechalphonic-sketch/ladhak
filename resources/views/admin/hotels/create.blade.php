@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.hotels.index') }}" class="text-decoration-none">&larr; Back to Hotels</a>
    <h2 class="mt-2">Add New Hotel</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hotel Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                {{-- <div class="col-md-4">
                    <label class="form-label fw-bold">Location *</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div> --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold">Destinaitons</label>
                    <select name="destination_id" class="form-select">
                       <option value="">Select One</option>
                       @foreach ($destinations as $item)
                       <option value="{{$item->id}}">{{$item->name}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Star Rating</label>
                    <select name="star_rating" class="form-select">
                        @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}" {{ old('star_rating',5) == $i ? 'selected':'' }}>{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Managed By</label>
                    <input type="text" name="managed_by" class="form-control" value="{{ old('managed_by') }}" placeholder="e.g. Taj Hotels & Resorts">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Unique Selling Points (USPs)</label>
                    <input type="text" name="usps" class="form-control" value="{{ old('usps') }}" placeholder="Comma separated: Infinity Pool, Private Beach, Butler Service">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="4" class="form-control editor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Amenities</label>
                    <input type="text" name="amenities" class="form-control" value="{{ old('amenities') }}" placeholder="Free WiFi, Pool, Spa, Gym, Parking">
                </div>

                {{-- Location Details --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Location & Proximity</h5></div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Landmarks</label>
                    <textarea name="landmarks" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;City Center|2.3 km&#10;Mall|1.1 km">{{ old('landmarks') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Airports</label>
                    <textarea name="airports" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;International Airport|15 km">{{ old('airports') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Attractions</label>
                    <textarea name="attractions" rows="4" class="form-control" placeholder="One per line: Name|Distance&#10;Eiffel Tower|0.5 km">{{ old('attractions') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Google Maps Embed URL</label>
                    <input type="text" name="map_embed_url" class="form-control" value="{{ old('map_embed_url') }}" placeholder="Paste embed src URL from Google Maps">
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Hotel Images</h5></div>
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">First image will be used as the cover photo.</small>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Save Hotel</button>
            </div>
        </form>
    </div>
</div>
@endsection
