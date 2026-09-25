@extends('pms.layouts.app')

@section('title', 'Team Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-1">Team Members</h2>
        <p class="text-muted mb-0">Manage roles and permissions for your team.</p>
    </div>
    <button class="btn btn-primary btn-modern rounded-3 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-person-plus me-2"></i> Add Member
    </button>
</div>

<div class="card border-0 shadow-soft bg-glass">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-muted small">
                        <th class="ps-4 py-3">User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Projects</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $users = [
                            ['name' => 'Alice Smith', 'avatar' => '1', 'role' => 'Lead Designer', 'status' => 'Active', 'email' => 'alice@pms.com', 'count' => 5],
                            ['name' => 'Bob Johnson', 'avatar' => '2', 'role' => 'Full Stack Dev', 'status' => 'Away', 'email' => 'bob@pms.com', 'count' => 3],
                            ['name' => 'Charlie Brown', 'avatar' => '3', 'role' => 'Content Writer', 'status' => 'Active', 'email' => 'charlie@pms.com', 'count' => 8],
                            ['name' => 'David Wilson', 'avatar' => '4', 'role' => 'Project Manager', 'status' => 'Active', 'email' => 'david@pms.com', 'count' => 12],
                            ['name' => 'Eve Taylor', 'avatar' => '5', 'role' => 'Junior Dev', 'status' => 'Offline', 'email' => 'eve@pms.com', 'count' => 2],
                        ];
                    @endphp

                    @foreach($users as $u)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u={{ $u['avatar'] }}" class="avatar me-3 shadow-sm border border-2 border-white">
                                <div>
                                    <h6 class="mb-0 fw-bold small text-body">{{ $u['name'] }}</h6>
                                    <small class="text-muted">Joined Sep 2024</small>
                                </div>
                            </div>
                        </td>
                        <td class="small fw-medium">{{ $u['role'] }}</td>
                        <td>
                            @php
                                $statusClass = match($u['status']) {
                                    'Active' => 'success',
                                    'Away' => 'warning',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge-soft badge-soft-{{ $statusClass }} px-2 py-1 rounded small">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> {{ $u['status'] }}
                            </span>
                        </td>
                        <td class="small text-muted">{{ $u['email'] }}</td>
                        <td class="small fw-bold">{{ $u['count'] }} Projects</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light border-0 rounded-circle p-0 me-1" style="width: 32px; height: 32px;"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light border-0 rounded-circle p-0 text-danger" style="width: 32px; height: 32px;"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Mockup -->
        <div class="p-4 d-flex justify-content-between align-items-center border-top border-light">
            <small class="text-muted">Showing 5 of 12 members</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link border-0 bg-transparent text-muted" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    <li class="page-item active"><a class="page-link rounded-circle border-0 px-3 mx-1" href="#">1</a></li>
                    <li class="page-item"><a class="page-link rounded-circle border-0 px-3 mx-1 text-muted" href="#">2</a></li>
                    <li class="page-item"><a class="page-link border-0 bg-transparent text-primary" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow bg-glass rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Invite New Member</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="addUserForm">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3 border-light shadow-none" id="userEmail" placeholder="Email Address" required>
                        <label for="userEmail">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select rounded-3 border-light shadow-none" id="userRole">
                            <option value="admin">Administrator</option>
                            <option value="pm">Project Manager</option>
                            <option value="member" selected>Team Member</option>
                            <option value="guest">Guest / Client</option>
                        </select>
                        <label for="userRole">Select Role</label>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Assign to Projects</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="checkbox" class="btn-check" id="proj1" autocomplete="off">
                            <label class="btn btn-outline-light btn-sm rounded-pill px-3 shadow-none border-0 bg-info bg-opacity-10 text-body" for="proj1">Website Redesign</label>
                            
                            <input type="checkbox" class="btn-check" id="proj2" autocomplete="off">
                            <label class="btn btn-outline-light btn-sm rounded-pill px-3 shadow-none border-0 bg-info bg-opacity-10 text-body" for="proj2">Mobile App</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill flex-grow-1 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill flex-grow-1 fw-bold">Send Invitation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('addUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
    modal.hide();
    window.showToast('Invitation Sent', `Invitation email sent to ${document.getElementById('userEmail').value}.`, 'success');
});
</script>
@endpush
