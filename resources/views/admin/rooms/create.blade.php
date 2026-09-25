@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.rooms.index') }}" class="text-decoration-none">&larr; Back to Rooms</a>
    <h2 class="mt-2">Add New Room</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Basic Info --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hotel *</label>
                    <select name="hotel_id" class="form-select @error('hotel_id') is-invalid @enderror" required>
                        <option value="">Select Hotel</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected':'' }}>{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                    @error('hotel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Room Type / Name *</label>
                    <input type="text" name="room_type" class="form-control @error('room_type') is-invalid @enderror" value="{{ old('room_type') }}" placeholder="e.g. Deluxe King Suite" required>
                    @error('room_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Price per Night (₹) *</label>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Max Occupancy *</label>
                    <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" required>
                    @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Room Size</label>
                    <input type="text" name="size" class="form-control" value="{{ old('size') }}" placeholder="e.g. 350 sq ft">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Bed Type</label>
                    <select name="bed_type" class="form-select">
                        <option value="">Select</option>
                        @foreach(['King','Queen','Twin','Double','Single','Bunk'] as $b)
                        <option value="{{ $b }}" {{ old('bed_type') == $b ? 'selected':'' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">View Type</label>
                    <select name="view_type" class="form-select">
                        <option value="">Select</option>
                        @foreach(['City View','Garden View','Pool View','Sea View','Mountain View','No View'] as $v)
                        <option value="{{ $v }}" {{ old('view_type') == $v ? 'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end pb-1">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" checked>
                        <label class="form-check-label" for="is_available">Available for Booking</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Room Description</label>
                    <textarea name="description" rows="3" class="form-control editor" placeholder="Describe the room features, luxury details...">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Inclusions (comma separated)</label>
                    <input type="text" name="inclusions" class="form-control" value="{{ old('inclusions') }}" placeholder="Free WiFi, Breakfast, Taxes, Parking">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Exclusions (comma separated)</label>
                    <input type="text" name="exclusions" class="form-control" value="{{ old('exclusions') }}" placeholder="Resort fee, Minibar, Laundry">
                </div>

                {{-- Rate Plans --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Rate Plans</h5></div>
                <div class="col-12" id="rate-plans-container">
                    <div class="row g-2 mb-2 rate-plan-row align-items-center">
                        <div class="col-md-5">
                            <input type="text" name="plan_name[]" class="form-control" placeholder="Plan name (e.g. Non-Refundable)" value="Non-Refundable">
                        </div>
                        <div class="col-md-4">
                            <input type="number" step="0.01" name="plan_price[]" class="form-control" placeholder="Price (₹)">
                        </div>
                        <div class="col-md-3">
                            <select name="plan_type[]" class="form-select">
                                <option value="non_refundable" selected>Non-Refundable</option>
                                <option value="flexible">Free Cancellation</option>
                                <option value="bb">Bed & Breakfast</option>
                                <option value="half_board">Half Board</option>
                                <option value="full_board">Full Board</option>
                                <option value="package">Special Package</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addRatePlan()">+ Add Rate Plan</button>
                </div>

                {{-- Images --}}
                <div class="col-12"><hr><h5 class="fw-bold text-secondary">Room Images</h5></div>
                <div class="col-12">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">First image will be the primary thumbnail.</small>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-5">Save Room</button>
            </div>
        </form>
    </div>
</div>

<script>
function addRatePlan() {
    const container = document.getElementById('rate-plans-container');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 rate-plan-row align-items-center';
    row.innerHTML = `
        <div class="col-md-5"><input type="text" name="plan_name[]" class="form-control" placeholder="Plan name"></div>
        <div class="col-md-4"><input type="number" step="0.01" name="plan_price[]" class="form-control" placeholder="Price (₹)"></div>
        <div class="col-md-2"><select name="plan_type[]" class="form-select">
            <option value="non_refundable">Non-Refundable</option>
            <option value="flexible">Free Cancellation</option>
            <option value="bb">Bed & Breakfast</option>
            <option value="half_board">Half Board</option>
            <option value="full_board">Full Board</option>
            <option value="package">Special Package</option>
        </select></div>
        <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.rate-plan-row').remove()">&times;</button></div>`;
    container.appendChild(row);
}
</script>
@endsection
