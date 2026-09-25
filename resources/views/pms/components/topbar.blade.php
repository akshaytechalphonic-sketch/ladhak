<header class="topbar sticky-top">
    <div class="d-flex align-items-center">
        <a href="#" id="sidebarToggle" class="text-secondary fs-4 text-decoration-none me-3">
            <i class="bi bi-list"></i>
        </a>
        
        <!-- Search -->
        <div class="search-wrapper d-none d-md-block">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" placeholder="Search projects, tasks...">
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-3">
        <!-- Theme Toggle -->
        <a href="#" id="themeToggle" class="text-secondary fs-5 text-decoration-none bg-glass rounded-circle d-flex align-items-center justify-content-center shadow-soft" style="width: 40px; height: 40px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle Theme">
            <i class="bi bi-moon" id="themeIcon"></i>
        </a>
        
        <!-- Notifications -->
        <div class="dropdown">
            <a href="#" class="text-secondary fs-5 text-decoration-none bg-glass rounded-circle d-flex align-items-center justify-content-center shadow-soft position-relative" style="width: 40px; height: 40px;" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow-soft border-0 mt-2 p-0 rounded-4 overflow-hidden" style="width: 320px;">
                <div class="bg-primary text-white p-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Notifications</h6>
                    <span class="badge bg-light text-primary rounded-pill">3 New</span>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action p-3 d-flex gap-3 border-bottom-0 border-top">
                        <div class="text-primary fs-4"><i class="bi bi-check-circle-fill"></i></div>
                        <div>
                            <h6 class="mb-1 fw-bold fs-6 text-body">Task Completed</h6>
                            <p class="mb-0 text-muted small">Sarah finished "UI Design Mockups"</p>
                            <small class="text-muted" style="font-size: 0.7rem;">2 mins ago</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action p-3 d-flex gap-3 border-bottom-0 border-top">
                        <div class="text-warning fs-4"><i class="bi bi-exclamation-circle-fill"></i></div>
                        <div>
                            <h6 class="mb-1 fw-bold fs-6 text-body">Deadline Approaching</h6>
                            <p class="mb-0 text-muted small">"API Integration" is due tomorrow</p>
                            <small class="text-muted" style="font-size: 0.7rem;">1 hour ago</small>
                        </div>
                    </a>
                </div>
                <div class="p-2 text-center border-top">
                    <a href="#" class="text-primary fw-medium text-decoration-none small">View All Notifications</a>
                </div>
            </div>
        </div>
        
        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff" alt="User" class="avatar-sm rounded-circle me-2 shadow-sm">
                <span class="d-none d-md-inline fw-medium text-body">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-soft border-0 mt-3 rounded-3">
                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> My Profile</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Account Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="{{ route('home') }}"><i class="bi bi-box-arrow-right me-2"></i> Exit app</a></li>
            </ul>
        </div>
    </div>
</header>
