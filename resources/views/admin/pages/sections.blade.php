@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
            <li class="breadcrumb-item active">{{ $page->page_name }} Sections</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>{{ $page->page_name }} Sections</h2>
            <span class="text-muted">Manage granular content for this page</span>
        </div>
        <a href="{{ route('admin.pages.sections.create', $page) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Section
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Section Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr>
                    <td class="fw-bold text-uppercase small text-navy">{{ str_replace('_', ' ', $section->section_name) }}</td>
                    <td>{{ $section->title ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $section->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $section->status ? 'Live' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.pages.sections.edit', $section) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.pages.sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this section?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No sections found for this page.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
