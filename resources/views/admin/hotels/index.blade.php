@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Hotels Management</h2>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">Add New Hotel</a>
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
                    <th>Name</th>
                    <th>Location</th>
                    <th>Rooms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->id }}</td>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->destination->name }}</td>
                    <td>{{ $hotel->rooms()->count() }}</td>
                    <td>
                        <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hotels found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($hotels->hasPages())
    <div class="card-footer bg-white">
        {{ $hotels->links() }}
    </div>
    @endif
</div>
@endsection
