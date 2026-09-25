@extends('pms.layouts.app')

@section('title', 'Projects')

@section('content')
<!-- Header Section -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
    <div>
        <h2 class="fw-bold mb-1">Projects</h2>
        <p class="text-muted mb-0">Manage and track all your workspace projects.</p>
    </div>
    <div class="d-flex gap-2">
        <div class="btn-group bg-glass p-1 rounded-3 shadow-soft" role="group">
            <button type="button" class="btn btn-light btn-sm rounded-2 active" id="gridViewBtn"><i class="bi bi-grid"></i></button>
            <button type="button" class="btn btn-light btn-sm rounded-2" id="listViewBtn"><i class="bi bi-list-ul"></i></button>
        </div>
        <button class="btn btn-primary btn-modern rounded-3 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#newProjectModal">
            <i class="bi bi-plus-lg me-2"></i> New Project
        </button>
    </div>
</div>

<!-- Filters Bar -->
<div class="card border-0 shadow-soft p-3 mb-4 bg-glass">
    <div class="row g-3 align-items-center">
        <div class="col-md-4">
            <div class="input-group bg-light border-0 rounded-3">
                <span class="input-group-text bg-transparent border-0 pe-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-transparent border-0 shadow-none ps-2" placeholder="Search projects...">
            </div>
        </div>
        <div class="col-md-2">
            <select class="form-select bg-light border-0 rounded-3 shadow-none text-muted small">
                <option selected>All Status</option>
                <option>Active</option>
                <option>Paused</option>
                <option>Completed</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select bg-light border-0 rounded-3 shadow-none text-muted small">
                <option selected>Priority</option>
                <option>High</option>
                <option>Medium</option>
                <option>Low</option>
            </select>
        </div>
        <div class="col-md-4 d-flex justify-content-md-end">
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle border-0 rounded-3 px-3" type="button" data-bs-toggle="dropdown">
                    Sort by: Recently Added
                </button>
                <ul class="dropdown-menu border-0 shadow-soft">
                    <li><a class="dropdown-item" href="#">Name</a></li>
                    <li><a class="dropdown-item" href="#">Deadline</a></li>
                    <li><a class="dropdown-item" href="#">Progress</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Projects Grid -->
<div class="row g-4" id="projectsContainer">
    @php
        $projects = [
            ['id' => 1, 'name' => 'Website Redesign', 'desc' => 'Redesigning the corporate website with a modern look and feel.', 'status' => 'Active', 'priority' => 'High', 'progress' => 65, 'tasks' => 24, 'completed' => 16, 'deadline' => '12 Oct, 2025', 'color' => 'primary'],
            ['id' => 2, 'name' => 'Mobile App v2.0', 'desc' => 'Major update for the iOS and Android application platforms.', 'status' => 'Completed', 'priority' => 'High', 'progress' => 100, 'tasks' => 48, 'completed' => 48, 'deadline' => '28 Sep, 2025', 'color' => 'success'],
            ['id' => 3, 'name' => 'Cloud Migration', 'desc' => 'Moving all legacy servers to a managed cloud infrastructure.', 'status' => 'Paused', 'priority' => 'Medium', 'progress' => 42, 'tasks' => 12, 'completed' => 5, 'deadline' => '05 Nov, 2025', 'color' => 'warning'],
            ['id' => 4, 'name' => 'Brand Identity', 'desc' => 'Refresh of brand colors, logo variations, and marketing guidelines.', 'status' => 'Active', 'priority' => 'Low', 'progress' => 15, 'tasks' => 8, 'completed' => 1, 'deadline' => '20 Dec, 2025', 'color' => 'info'],
            ['id' => 5, 'name' => 'API Integration', 'desc' => 'Connect third-party payment gateways and CRM tools.', 'status' => 'Active', 'priority' => 'High', 'progress' => 88, 'tasks' => 32, 'completed' => 28, 'deadline' => '15 Oct, 2025', 'color' => 'primary'],
            ['id' => 6, 'name' => 'Internal Audit', 'desc' => 'Annual security and compliance audit for the engineering team.', 'status' => 'Paused', 'priority' => 'Medium', 'progress' => 0, 'tasks' => 10, 'completed' => 0, 'deadline' => '10 Jan, 2026', 'color' => 'danger']
        ];
    @endphp

    @foreach($projects as $p)
    <div class="col-md-6 col-lg-4 project-item">
        <div class="card border-0 shadow-soft h-100 card-hover bg-glass">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="rounded-3 bg-{{ $p['color'] }} bg-opacity-10 p-2 text-{{ $p['color'] }}" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi {{ $p['id'] % 2 == 0 ? 'bi-app-indicator' : 'bi-layers' }} fs-4"></i>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm border-0 rounded-circle p-0" style="width: 32px; height: 32px;" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-soft">
                            <li><a class="dropdown-item" href="{{ route('pms.projects.show') }}"><i class="bi bi-eye me-2"></i> View Details</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i> Edit Project</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>

                <h5 class="fw-bold mb-2 text-body clickable" onclick="window.location='{{ route('pms.projects.show') }}'" style="cursor: pointer;">{{ $p['name'] }}</h5>
                <p class="text-muted small mb-4 lh-base">{{ $p['desc'] }}</p>

                <div class="d-flex align-items-center mb-4">
                    <div class="progress flex-grow-1 me-3" style="height: 8px; border-radius: 10px;">
                        <div class="progress-bar bg-{{ $p['color'] }}" role="progressbar" style="width: {{ $p['progress'] }}%" aria-valuenow="{{ $p['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="fw-bold small">{{ $p['progress'] }}%</span>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: rgba(0,0,0,0.05) !important;">
                    <div class="avatar-group">
                        <img src="https://i.pravatar.cc/150?u={{ $p['id'] }}" class="avatar avatar-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Member">
                        <img src="https://i.pravatar.cc/150?u={{ $p['id']+10 }}" class="avatar avatar-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Member">
                        <span class="avatar avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center text-muted small fw-bold" style="margin-left: -10px; border: 2px solid white;">+{{ rand(1, 5) }}</span>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block small">Deadline</small>
                        <span class="fw-bold small {{ strtotime($p['deadline']) < time() && $p['status'] != 'Completed' ? 'text-danger' : 'text-body' }}">
                            <i class="bi bi-calendar-event me-1"></i> {{ $p['deadline'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- New Project Modal -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow bg-glass rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Create New Project</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="newProjectForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 border-light shadow-none" id="projectName" placeholder="Project Name" required>
                        <label for="projectName">Project Name</label>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 text-start">
                            <div class="form-floating">
                                <select class="form-select rounded-3 border-light shadow-none" id="projectPriority">
                                    <option value="high">High</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="low">Low</option>
                                </select>
                                <label for="projectPriority">Priority</label>
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <div class="form-floating">
                                <input type="date" class="form-control rounded-3 border-light shadow-none" id="projectDeadline" required>
                                <label for="projectDeadline">Deadline</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control rounded-3 border-light shadow-none" id="projectDesc" placeholder="Description" style="height: 100px"></textarea>
                        <label for="projectDesc">Project Description</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill flex-grow-1 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill flex-grow-1 fw-bold">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    const container = document.getElementById('projectsContainer');
    const items = document.querySelectorAll('.project-item');

    gridBtn.addEventListener('click', () => {
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
        container.classList.remove('flex-column');
        items.forEach(item => {
            item.classList.remove('col-12');
            item.classList.add('col-md-6', 'col-lg-4');
        });
    });

    listBtn.addEventListener('click', () => {
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
        container.classList.add('flex-column');
        items.forEach(item => {
            item.classList.remove('col-md-6', 'col-lg-4');
            item.classList.add('col-12');
        });
    });

    // Dummy form submission
    document.getElementById('newProjectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const modal = bootstrap.Modal.getInstance(document.getElementById('newProjectModal'));
        modal.hide();
        window.showToast('Success', 'Project created successfully!', 'success');
    });
});
</script>
@endpush
