@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-tag text-primary me-2"></i> Offers & Packages</h2>
    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary rounded-pill px-4"><i class="bi bi-plus-lg me-1"></i> Add New Offer</a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Offer Details</th>
                        <th>Price</th>
                        <th>Badge</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($offer->image)
                                    <img src="{{ asset('storage/' . $offer->image) }}" class="rounded-3 me-3" width="60" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-navy">{{ $offer->title }}</div>
                                    <div class="small text-muted">{{ Str::limit($offer->description, 40) }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="fw-bold text-navy">₹{{ $offer->price ?? '0' }}</span></td>
                        <td><span class="badge bg-gold text-navy">{{ $offer->discount_tag ?? 'Deal' }}</span></td>
                        <td>
                            <span class="badge bg-{{ $offer->status ? 'success' : 'danger' }} bg-opacity-10 text-{{ $offer->status ? 'success' : 'danger' }} px-3 py-2 rounded-pill small">
                                {{ $offer->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-sm btn-outline-primary border-0 rounded-circle"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this offer?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0 rounded-circle ml-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No holiday offers created yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($offers->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $offers->links() }}
    </div>
    @endif
</div>
@endsection
