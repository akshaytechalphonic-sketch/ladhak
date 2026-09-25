@extends('pms.layouts.app')

@section('title', 'Kanban Board')

@section('content')
<!-- Kanban Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
    <div>
        <div class="d-flex align-items-center mb-1">
            <h2 class="fw-bold mb-0 me-3">Kanban Board</h2>
            <span class="badge-soft badge-soft-primary px-3 py-2 rounded-pill small fw-bold">Website Redesign</span>
        </div>
        <p class="text-muted mb-0">Drag and drop tasks to update progress in real-time.</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="avatar-group me-2">
            <img src="https://i.pravatar.cc/150?u=1" class="avatar avatar-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Alice">
            <img src="https://i.pravatar.cc/150?u=2" class="avatar avatar-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Bob">
            <img src="https://i.pravatar.cc/150?u=3" class="avatar avatar-sm rounded-circle shadow-sm" data-bs-toggle="tooltip" title="Charlie">
            <button class="avatar avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fs-5 border-0 shadow-sm" style="margin-left: -10px;"><i class="bi bi-plus-circle"></i></button>
        </div>
        <button class="btn btn-primary btn-modern rounded-3 px-4 shadow-sm">
            <i class="bi bi-filter me-2"></i> Filters
        </button>
    </div>
</div>

<!-- Kanban columns -->
<div class="kanban-board pb-4">
    <!-- To Do -->
    <div class="kanban-column shadow-sm border-0 bg-glass">
        <div class="kanban-column-title">
            <div class="d-flex align-items-center">
                <span class="p-1 rounded bg-secondary bg-opacity-10 me-2" style="width: 24px; height: 24px; display: inline-block;"></span>
                <span class="text-body fw-bold">To Do</span>
                <span class="badge rounded-pill bg-light text-dark ms-2 small">3</span>
            </div>
            <button class="btn btn-sm btn-light rounded-circle shadow-none p-0" style="width: 28px; height: 28px;"><i class="bi bi-plus"></i></button>
        </div>
        <div class="kanban-tasks" id="tasksTodo">
            <div class="kanban-card card-hover shadow-soft border-0 mb-3" data-id="1">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-danger px-2 py-1 rounded small fw-bold">High</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2">Draft Landing Page Copy</h6>
                <p class="text-muted small mb-3">Refine the main value propositions for the new homepage.</p>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-chat-left-text me-1"></i> 4
                        <i class="bi bi-paperclip ms-3 me-1"></i> 2
                    </div>
                    <img src="https://i.pravatar.cc/150?u=1" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>
            
            <div class="kanban-card card-hover shadow-soft border-0 mb-3" data-id="2">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-primary px-2 py-1 rounded small fw-bold">Medium</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2">Iconography Set v1</h6>
                <p class="text-muted small mb-3">Design consistent icons for features section.</p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="badge-soft badge-soft-warning px-2 py-1 rounded small fs-xs">
                        <i class="bi bi-clock me-1"></i> Oct 15
                    </div>
                    <img src="https://i.pravatar.cc/150?u=2" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- In Progress -->
    <div class="kanban-column shadow-sm border-0 bg-glass">
        <div class="kanban-column-title">
            <div class="d-flex align-items-center">
                <span class="p-1 rounded bg-primary bg-opacity-10 me-2" style="width: 24px; height: 24px; display: inline-block;"></span>
                <span class="text-body fw-bold">In Progress</span>
                <span class="badge rounded-pill bg-primary ms-2 small">2</span>
            </div>
            <button class="btn btn-sm btn-light rounded-circle shadow-none p-0" style="width: 28px; height: 28px;"><i class="bi bi-plus"></i></button>
        </div>
        <div class="kanban-tasks" id="tasksInProgress">
            <div class="kanban-card card-hover shadow-soft border-0 mb-3" data-id="3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-danger px-2 py-1 rounded small fw-bold">High</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2">Responsive Prototypes</h6>
                <p class="text-muted small mb-3">Convert Figma mockups to interactive HTML/CSS prototypes.</p>
                <div class="progress mb-3" style="height: 6px; border-radius: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-list-check me-1"></i> 8/12
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>

            <div class="kanban-card card-hover shadow-soft border-0 mb-3" data-id="4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-info px-2 py-1 rounded small fw-bold">Low</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2">Update User Persona</h6>
                <p class="text-muted small mb-3">Review recent feedback from stakeholders.</p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="text-muted small"><i class="bi bi-paperclip me-1"></i> 1</div>
                    <img src="https://i.pravatar.cc/150?u=3" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Review -->
    <div class="kanban-column shadow-sm border-0 bg-glass">
        <div class="kanban-column-title">
            <div class="d-flex align-items-center">
                <span class="p-1 rounded bg-warning bg-opacity-10 me-2" style="width: 24px; height: 24px; display: inline-block;"></span>
                <span class="text-body fw-bold">In Review</span>
                <span class="badge rounded-pill bg-light text-warning ms-2 small">1</span>
            </div>
            <button class="btn btn-sm btn-light rounded-circle shadow-none p-0" style="width: 28px; height: 28px;"><i class="bi bi-plus"></i></button>
        </div>
        <div class="kanban-tasks" id="tasksReview">
            <div class="kanban-card card-hover shadow-soft border-0 mb-3" data-id="5">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-warning px-2 py-1 rounded small fw-bold">Medium</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2">SEO Keyword Research</h6>
                <p class="text-muted small mb-3">Finalize keywords for the blog and core services pages.</p>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="text-xs text-muted bg-light px-2 py-1 rounded small">SEO</span>
                    <span class="text-xs text-muted bg-light px-2 py-1 rounded small">Content</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                    <span class="badge-soft badge-soft-warning px-2 py-1 rounded small fs-xs">Due Oct 10</span>
                    <img src="https://i.pravatar.cc/150?u=4" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Done -->
    <div class="kanban-column shadow-sm border-0 bg-glass">
        <div class="kanban-column-title">
            <div class="d-flex align-items-center">
                <span class="p-1 rounded bg-success bg-opacity-10 me-2" style="width: 24px; height: 24px; display: inline-block;"></span>
                <span class="text-body fw-bold">Done</span>
                <span class="badge rounded-pill bg-success ms-2 small">1</span>
            </div>
            <button class="btn btn-sm btn-light rounded-circle shadow-none p-0" style="width: 28px; height: 28px;"><i class="bi bi-plus"></i></button>
        </div>
        <div class="kanban-tasks" id="tasksDone">
            <div class="kanban-card card-hover shadow-soft border-0 mb-3 opacity-75" data-id="6">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge-soft badge-soft-success px-2 py-1 rounded small fw-bold">Done</span>
                    <i class="bi bi-three-dots text-muted"></i>
                </div>
                <h6 class="fw-bold mb-2 text-decoration-line-through">Moodboard Approval</h6>
                <p class="text-muted small mb-3">Approve the color palette and typography styles.</p>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-check-all text-success me-1 fs-5"></i> Completed
                    </div>
                    <img src="https://i.pravatar.cc/150?u=5" class="avatar avatar-sm rounded-circle shadow-sm">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize SortableJS for each column
    const columns = ['tasksTodo', 'tasksInProgress', 'tasksReview', 'tasksDone'];
    
    columns.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            Sortable.create(el, {
                group: 'kanban',
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    const taskId = evt.item.getAttribute('data-id');
                    const targetCol = evt.to.id;
                    console.log(`Task ${taskId} moved to ${targetCol}`);
                    
                    window.showToast('Task Updated', `Task moved to ${targetCol.replace('tasks', '')}.`, 'info');
                }
            });
        }
    });

    // Tooltip init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush
