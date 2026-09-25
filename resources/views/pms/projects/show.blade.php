@extends('pms.layouts.app')

@section('title', 'Project Details')

@section('content')
<!-- Back button & Actions -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('pms.projects.index') }}" class="btn btn-light rounded-pill px-3 shadow-none border-0 text-muted small fw-bold">
        <i class="bi bi-arrow-left me-2"></i> Back to Projects
    </a>
    <div class="d-flex gap-2">
        <button class="btn btn-light rounded-pill px-4 shadow-soft border-0 fw-bold">Edit</button>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">Share</button>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Project Info -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-soft p-4 mb-4 bg-glass position-relative overflow-hidden">
            <div class="rounded-3 bg-primary bg-opacity-10 p-3 mb-4 d-inline-flex text-primary shadow-sm">
                <i class="bi bi-window-stack fs-3"></i>
            </div>
            <h2 class="fw-bold mb-2">Website Redesign</h2>
            <p class="text-muted fs-5 mb-4">Complete overhaul of the corporate landing page and services sections to improve conversion rates by 25%.</p>
            
            <div class="row g-3 mb-2">
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block small mb-1">Status</small>
                    <span class="badge-soft badge-soft-primary px-3 py-1 rounded-pill fw-bold">In Progress</span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block small mb-1">Priority</small>
                    <span class="badge-soft badge-soft-danger px-3 py-1 rounded-pill fw-bold">High</span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block small mb-1">Deadline</small>
                    <span class="text-body fw-bold">Oct 12, 2025</span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block small mb-1">Budget</small>
                    <span class="text-body fw-bold">$12,500</span>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-top border-light">
                <h6 class="fw-bold mb-3">Overall Progress</h6>
                <div class="d-flex align-items-center">
                    <div class="progress flex-grow-1 me-3 shadow-none border-0" style="height: 10px; border-radius: 20px; background: rgba(0,0,0,0.05);">
                        <div class="progress-bar bg-primary shadow-sm" style="width: 65%"></div>
                    </div>
                    <span class="fw-bold">65%</span>
                </div>
            </div>
        </div>

        <!-- Task List -->
        <div class="card border-0 shadow-soft p-4 bg-glass">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Project Tasks</h5>
                <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-none fw-bold"><i class="bi bi-plus me-1"></i> Add Task</button>
            </div>
            
            <div class="list-group list-group-flush">
                <div class="list-group-item px-0 py-3 border-light bg-transparent d-flex align-items-center">
                    <input class="form-check-input me-3 border-2 shadow-none" type="checkbox" checked>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold text-muted text-decoration-line-through">Moodboard Approval</h6>
                        <small class="text-muted">Completed by Alice • Sep 25</small>
                    </div>
                    <span class="badge-soft badge-soft-success rounded-pill fw-bold small">Done</span>
                </div>
                <div class="list-group-item px-0 py-3 border-light bg-transparent d-flex align-items-center">
                    <input class="form-check-input me-3 border-2 shadow-none" type="checkbox">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold">Responsive prototypes</h6>
                        <small class="text-muted">Assigned to Bob • Due Tomorrow</small>
                    </div>
                    <span class="badge-soft badge-soft-primary rounded-pill fw-bold small">In Progress</span>
                </div>
                <div class="list-group-item px-0 py-3 border-light bg-transparent d-flex align-items-center">
                    <input class="form-check-input me-3 border-2 shadow-none" type="checkbox">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold">Draft Landing Page Copy</h6>
                        <small class="text-muted">Assigned to Charlie • Due Oct 05</small>
                    </div>
                    <span class="badge-soft badge-soft-warning rounded-pill fw-bold small">To Do</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Team & Files -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-soft p-4 mb-4 bg-glass">
            <h6 class="fw-bold mb-4">Team Members</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="https://i.pravatar.cc/150?u=1" class="avatar me-3 shadow-sm border border-2 border-white">
                        <div>
                            <h6 class="mb-0 fw-bold small">Alice Smith</h6>
                            <small class="text-muted">Lead Designer</small>
                        </div>
                    </div>
                    <i class="bi bi-chat-text text-muted"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="https://i.pravatar.cc/150?u=2" class="avatar me-3 shadow-sm border border-2 border-white">
                        <div>
                            <h6 class="mb-0 fw-bold small">Bob Johnson</h6>
                            <small class="text-muted">Developer</small>
                        </div>
                    </div>
                    <i class="bi bi-chat-text text-muted"></i>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="https://i.pravatar.cc/150?u=3" class="avatar me-3 shadow-sm border border-2 border-white">
                        <div>
                            <h6 class="mb-0 fw-bold small">Charlie Brown</h6>
                            <small class="text-muted">Content Writer</small>
                        </div>
                    </div>
                    <i class="bi bi-chat-text text-muted"></i>
                </div>
            </div>
            <button class="btn btn-light w-100 rounded-pill mt-4 fw-bold shadow-none border-0 text-primary">Manage Team</button>
        </div>

        <div class="card border-0 shadow-soft p-4 bg-glass">
            <h6 class="fw-bold mb-4">Project Files</h6>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action px-0 border-light bg-transparent py-3 d-flex align-items-center text-decoration-none">
                    <div class="bg-danger bg-opacity-10 p-2 rounded text-danger me-3">
                        <i class="bi bi-file-earmark-pdf fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold small">Design_Guidelines.pdf</h6>
                        <small class="text-muted">4.2 MB • Alice</small>
                    </div>
                    <i class="bi bi-download text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action px-0 border-light bg-transparent py-3 d-flex align-items-center text-decoration-none">
                    <div class="bg-primary bg-opacity-10 p-2 rounded text-primary me-3">
                        <i class="bi bi-file-earmark-image fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold small">HomepageMockup_v2.png</h6>
                        <small class="text-muted">1.8 MB • Bob</small>
                    </div>
                    <i class="bi bi-download text-muted"></i>
                </a>
            </div>
            <button class="btn btn-light w-100 rounded-pill mt-4 fw-bold shadow-none border-0">View All Files</button>
        </div>
    </div>
</div>
@endsection
