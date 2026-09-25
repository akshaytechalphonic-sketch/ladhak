@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Blogs Management</h2>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Add New Post</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->featured_image)
                            <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                        @else
                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><small>N/A</small></div>
                        @endif
                    </td>
                    <td>{{ Str::limit($blog->title, 40) }}</td>
                    <td>{{ $blog->user->name ?? 'Admin' }}</td>
                    <td>
                        @if($blog->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-warning text-dark">Draft</span>
                        @endif
                    </td>
                    <td>{{ $blog->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No blog posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
    <div class="card-footer bg-white">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection
