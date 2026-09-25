@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.enquiries.index') }}" 
       class="text-decoration-none d-inline-flex align-items-center gap-2 mb-3"
       style="color: #0B2240; font-weight: 600;">
        <i class="bi bi-arrow-left"></i> Back to Enquiries
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="mb-1">Enquiry Details</h2>
            <p class="text-muted mb-0">ID: #{{ $enquiry->id }} • Received {{ $enquiry->created_at->diffForHumans() }}</p>
        </div>
        <span class="badge {{ $enquiry->is_responded ? 'bg-success' : 'bg-danger' }} px-4 py-2" style="font-size: 0.85rem;">
            @if($enquiry->is_responded)
                <i class="bi bi-check-circle-fill me-1"></i>Responded
            @else
                <i class="bi bi-exclamation-circle-fill me-1"></i>New Enquiry
            @endif
        </span>
    </div>
</div>

<div class="row g-4">
    <!-- Main Enquiry Card -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 56px; height: 56px; background: linear-gradient(135deg, #C90000, #a30000); color: white; font-size: 1.5rem; font-weight: 700; flex-shrink: 0;">
                        {{ strtoupper(substr($enquiry->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="mb-1 fw-bold" style="color: #0B2240;">{{ $enquiry->name }}</h4>
                        <div class="text-muted" style="font-size: 0.88rem;">
                            <i class="bi bi-clock me-1"></i>
                            Submitted on {{ $enquiry->created_at->format('l, F j, Y \a\t g:i A') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <!-- Subject Section -->
                @if($enquiry->subject)
                <div class="mb-4 pb-4 border-bottom">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-tag-fill" style="color: #C90000;"></i>
                        <h6 class="mb-0 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px; color: #6c757d;">Subject</h6>
                    </div>
                    <div class="px-3 py-2 rounded-3" style="background: #e3f2fd; border-left: 4px solid #1976d2;">
                        <p class="mb-0 fw-bold" style="color: #1976d2; font-size: 1rem;">{{ $enquiry->subject }}</p>
                    </div>
                </div>
                @endif

                <!-- Message Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-chat-left-text-fill" style="color: #C90000;"></i>
                        <h6 class="mb-0 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px; color: #6c757d;">Message</h6>
                    </div>
                    <div class="p-4 rounded-4" style="background: #f8f9fa; border: 1px solid #e9ecef;">
                        <p class="mb-0" style="color: #1a1e23; line-height: 1.8; font-size: 0.95rem; white-space: pre-wrap;">{{ $enquiry->message }}</p>
                    </div>
                </div>

                <!-- Package Info (if exists) -->
                @if($enquiry->package_id && $enquiry->package)
                <div class="alert alert-info d-flex align-items-start gap-3 border-0" style="background: #e7f3ff;">
                    <i class="bi bi-box-seam fs-4" style="color: #0066cc;"></i>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: #0066cc;">Package Enquiry</h6>
                        <p class="mb-1"><strong>Package:</strong> {{ $enquiry->package->title }}</p>
                        @if($enquiry->travel_date)
                            <p class="mb-1"><strong>Travel Date:</strong> {{ $enquiry->travel_date->format('M d, Y') }}</p>
                        @endif
                        @if($enquiry->adults || $enquiry->children)
                            <p class="mb-0">
                                <strong>Travelers:</strong> 
                                {{ $enquiry->adults }} Adult(s)
                                @if($enquiry->children), {{ $enquiry->children }} Children @endif
                            </p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Contact & Actions Sidebar -->
    <div class="col-lg-4">
        <!-- Contact Information Card -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: #6c757d;">
                    <i class="bi bi-person-lines-fill me-2" style="color: #C90000;"></i>Contact Information
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <!-- Email -->
                    <div>
                        <div class="text-muted mb-1" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Email Address</div>
                        <a href="mailto:{{ $enquiry->email }}" 
                           class="d-flex align-items-center gap-2 text-decoration-none p-2 rounded-3" 
                           style="background: #f8f9fa; color: #0B2240; font-weight: 600; transition: all 0.2s;"
                           onmouseover="this.style.background='#e9ecef'"
                           onmouseout="this.style.background='#f8f9fa'">
                            <i class="bi bi-envelope-fill" style="color: #C90000;"></i>
                            <span style="font-size: 0.88rem;">{{ $enquiry->email }}</span>
                        </a>
                    </div>

                    <!-- Phone -->
                    <div>
                        <div class="text-muted mb-1" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Phone Number</div>
                        <a href="tel:{{ $enquiry->phone }}" 
                           class="d-flex align-items-center gap-2 text-decoration-none p-2 rounded-3" 
                           style="background: #f8f9fa; color: #0B2240; font-weight: 600; transition: all 0.2s;"
                           onmouseover="this.style.background='#e9ecef'"
                           onmouseout="this.style.background='#f8f9fa'">
                            <i class="bi bi-telephone-fill" style="color: #C90000;"></i>
                            <span style="font-size: 0.88rem;">{{ $enquiry->phone }}</span>
                        </a>
                    </div>

                    <!-- Quick Actions -->
                    <div class="pt-3 border-top">
                        <div class="d-flex flex-column gap-2">
                            <a href="mailto:{{ $enquiry->email }}" 
                               class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center gap-2"
                               style="border-color: #0B2240; color: #0B2240; font-weight: 600;">
                                <i class="bi bi-envelope"></i> Send Email
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->phone) }}" 
                               target="_blank"
                               class="btn btn-success btn-sm d-flex align-items-center justify-content-center gap-2"
                               style="background: #25D366; border: none; font-weight: 600;">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: #6c757d;">
                    <i class="bi bi-gear-fill me-2" style="color: #C90000;"></i>Actions
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <!-- Status Badge -->
                    @if($enquiry->is_responded)
                    <div class="alert alert-success border-0 mb-0 d-flex align-items-center gap-2" style="background: #d4edda;">
                        <i class="bi bi-check-circle-fill" style="color: #155724;"></i>
                        <div>
                            <strong style="color: #155724;">Marked as Responded</strong>
                            <div class="small" style="color: #155724; opacity: 0.8;">This enquiry has been handled</div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning border-0 mb-0 d-flex align-items-center gap-2" style="background: #fff3cd;">
                        <i class="bi bi-exclamation-triangle-fill" style="color: #856404;"></i>
                        <div>
                            <strong style="color: #856404;">Awaiting Response</strong>
                            <div class="small" style="color: #856404; opacity: 0.8;">Please respond to this enquiry</div>
                        </div>
                    </div>
                    @endif

                    <!-- Delete Action -->
                    <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" 
                          method="POST" 
                          onsubmit="return confirm('⚠️ Delete this enquiry permanently?\n\nThis action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2"
                                style="border-color: #C90000; color: #C90000; font-weight: 600;">
                            <i class="bi bi-trash"></i> Delete Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>
@endsection
