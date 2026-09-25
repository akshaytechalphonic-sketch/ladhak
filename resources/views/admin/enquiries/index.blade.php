@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Enquiries Management</h2>
        <p class="text-muted mb-0">Manage customer enquiries and support requests</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-danger px-3 py-2">
            {{ $enquiries->where('is_responded', false)->count() }} New
        </span>
        <span class="badge bg-success px-3 py-2">
            {{ $enquiries->where('is_responded', true)->count() }} Responded
        </span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <tr>
                        <th class="px-4 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            <i class="bi bi-calendar3 me-1"></i>Date & Time
                        </th>
                        <th class="px-3 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            <i class="bi bi-person-fill me-1"></i>Name
                        </th>
                        <th class="px-3 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            <i class="bi bi-tag-fill me-1"></i>Subject
                        </th>
                        <th class="px-3 py-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            <i class="bi bi-envelope-fill me-1"></i>Contact
                        </th>
                        <th class="px-3 py-3 text-uppercase text-center" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            <i class="bi bi-circle-fill me-1"></i>Status
                        </th>
                        <th class="px-3 py-3 text-uppercase text-end" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #6c757d;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                    <tr style="border-bottom: 1px solid #f0f0f0; {{ !$enquiry->is_responded ? 'background: #fff8f0;' : '' }}">
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-2">
                                @if(!$enquiry->is_responded)
                                    <span class="badge rounded-pill bg-danger" style="width: 8px; height: 8px; padding: 0;"></span>
                                @endif
                                <div>
                                    <div class="fw-bold" style="font-size: 0.88rem; color: #1a1e23;">
                                        {{ $enquiry->created_at->format('M d, Y') }}
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        {{ $enquiry->created_at->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="fw-bold" style="color: #0B2240; font-size: 0.9rem;">
                                {{ $enquiry->name }}
                            </div>
                            @if($enquiry->package_id)
                                <small class="text-muted">
                                    <i class="bi bi-box-seam me-1"></i>Package Enquiry
                                </small>
                            @endif
                        </td>
                        <td class="px-3 py-3">
                            @if($enquiry->subject)
                                <span class="badge rounded-pill px-3 py-2" style="background: #e3f2fd; color: #1976d2; font-weight: 600; font-size: 0.75rem;">
                                    {{ $enquiry->subject }}
                                </span>
                            @else
                                <span class="text-muted" style="font-size: 0.8rem;">—</span>
                            @endif
                        </td>
                        <td class="px-3 py-3">
                            <div class="d-flex flex-column gap-1">
                                <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none d-flex align-items-center gap-1" style="font-size: 0.82rem; color: #495057;">
                                    <i class="bi bi-envelope" style="font-size: 0.7rem; color: #C90000;"></i>
                                    {{ Str::limit($enquiry->email, 20) }}
                                </a>
                                <a href="tel:{{ $enquiry->phone }}" class="text-decoration-none d-flex align-items-center gap-1" style="font-size: 0.82rem; color: #495057;">
                                    <i class="bi bi-telephone" style="font-size: 0.7rem; color: #C90000;"></i>
                                    {{ $enquiry->phone }}
                                </a>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-center">
                            @if($enquiry->is_responded)
                                <span class="badge rounded-pill px-3 py-2" style="background: #d4edda; color: #155724; font-weight: 600;">
                                    <i class="bi bi-check-circle-fill me-1"></i>Responded
                                </span>
                            @else
                                <span class="badge rounded-pill px-3 py-2" style="background: #f8d7da; color: #721c24; font-weight: 600;">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>New
                                </span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-start" 
                                   title="View Details"
                                   style="border-color: #0B2240; color: #0B2240;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Delete this enquiry permanently?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-end" 
                                            title="Delete"
                                            style="border-color: #C90000; color: #C90000;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                                <div>
                                    <h5 class="text-muted mb-1">No Enquiries Found</h5>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Customer enquiries will appear here</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($enquiries->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted" style="font-size: 0.85rem;">
                Showing {{ $enquiries->firstItem() }} to {{ $enquiries->lastItem() }} of {{ $enquiries->total() }} enquiries
            </div>
            {{ $enquiries->links() }}
        </div>
    </div>
    @endif
</div>

<style>
.table-hover tbody tr:hover {
    background-color: #f8f9fa !important;
    transition: background-color 0.2s;
}
.btn-group .btn:hover {
    transform: translateY(-1px);
    transition: transform 0.2s;
}
</style>
@endsection
