@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Page Content Management (CRM)</h2>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-circle"></i> Add New Page
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Page Name</th>
                    <th>Slug</th>
                    <th>SEO Title</th>
                    <th>Sections</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                <tr>
                    <td class="fw-bold text-navy">{{ $page->page_name }}</td>
                    <td><code>/{{ $page->slug }}</code></td>
                    <td class="small">{{ Str::limit($page->meta_title, 40) }}</td>
                    <td><span class="badge bg-navy">{{ $page->sections_count ?? 0 }}</span></td>
                    <td>
                        <span class="badge {{ $page->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $page->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.pages.sections', $page) }}" class="btn btn-sm btn-outline-primary" title="Manage Sections">
                                <i class="bi bi-layers"></i>
                            </a>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-info" title="Edit Page SEO">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if(!in_array($page->slug, ['home', 'about-us']))
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Page">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No pages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
