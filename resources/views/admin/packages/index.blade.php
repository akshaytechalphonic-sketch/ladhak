@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Packages Management</h2>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">Add New Package</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Destination</th>
                    <th>Service Mapping</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages as $package)
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ $package->title }}</td>
                    <td>{{ $package->destination ? $package->destination->name : 'N/A' }}</td>
                    <td>{{ $package->service ? $package->service->title : 'N/A' }}</td>
                    <td>{{ $package->duration }}</td>
                    <td>₹{{ number_format($package->price, 2) }}</td>
                    <td>
                        <span class="badge {{ $package->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $package->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this package?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No packages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($packages->hasPages())
    <div class="card-footer bg-white">
        {{ $packages->links() }}
    </div>
    @endif
</div>
@endsection
