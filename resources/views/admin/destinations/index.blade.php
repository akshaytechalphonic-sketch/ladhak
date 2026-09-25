@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-geo-alt text-primary me-2"></i> Destinations</h2>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary rounded-pill px-4"><i class="bi bi-plus-lg me-1"></i> Add New Destination</a>
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
                        <th class="ps-4">Destination Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $dest)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($dest->image)
                                    <img src="{{ asset('storage/' . $dest->image) }}" class="rounded-3 me-3" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-map text-muted"></i>
                                    </div>
                                @endif
                                <div class="fw-bold text-navy">{{ $dest->name }}</div>
                            </div>
                        </td>
                        <td><span class="text-muted"><i class="bi bi-geo-alt me-1"></i> {{ $dest->location ?? 'Global' }}</span></td>
                        <td>
                            <span class="badge bg-{{ $dest->status ? 'success' : 'danger' }} bg-opacity-10 text-{{ $dest->status ? 'success' : 'danger' }} px-3 py-2 rounded-pill small">
                                {{ $dest->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.destinations.edit', $dest) }}" class="btn btn-sm btn-outline-primary border-0 rounded-circle"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this destination?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0 rounded-circle ml-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">No travel destinations added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($destinations->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $destinations->links() }}
    </div>
    @endif
</div>
@endsection
