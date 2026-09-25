@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-chat-quote text-primary me-2"></i> Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-pill px-4"><i class="bi bi-plus-lg me-1"></i> Add New Testimony</a>
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
                        <th class="ps-4">Guest Info</th>
                        <th>Rating</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $test)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($test->image)
                                    <img src="{{ asset('storage/' . $test->image) }}" class="rounded-circle me-3" width="45" height="45" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bi bi-person text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-navy">{{ $test->name }}</div>
                                    <div class="small text-muted">{{ $test->role ?? 'Guest' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-warning small">
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star{{ $i <= $test->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td><div class="small text-muted" style="max-width: 300px;">{{ Str::limit($test->content, 60) }}</div></td>
                        <td>
                            <span class="badge bg-{{ $test->status ? 'success' : 'danger' }} bg-opacity-10 text-{{ $test->status ? 'success' : 'danger' }} px-3 py-2 rounded-pill small">
                                {{ $test->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.testimonials.edit', $test) }}" class="btn btn-sm btn-outline-primary border-0 rounded-circle"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $test) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimony?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0 rounded-circle ml-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No guest testimonials available yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($testimonials->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>
@endsection
