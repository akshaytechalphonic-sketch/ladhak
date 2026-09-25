<nav id="topbar" class="navbar navbar-expand bg-glass px-4 border-bottom" style="border-color: var(--pms-border) !important;">
    <div class="container-fluid d-flex align-items-center justify-content-between p-0">
        <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="btn btn-light rounded-circle shadow-none me-3">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h5 class="mb-0 fw-bold d-none d-md-block text-body">Admin Workspace</h5>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <!-- Notifications -->
            <div class="dropdown">
                <button class="btn btn-light rounded-circle shadow-none p-0 position-relative" style="width: 40px; height: 40px;" data-bs-toggle="dropdown">
                    <i class="bi bi-bell-fill text-muted"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 8px; margin-left: -8px;"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow-soft border-0 p-3 mt-2" style="width: 300px;">
                    <h6 class="fw-bold mb-3">Notifications</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3 text-primary"><i class="bi bi-bookmark-plus"></i></div>
                            <div class="small">
                                <p class="mb-0 fw-bold">New Booking Received</p>
                                <small class="text-muted">Highland Suite • Just now</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light rounded-pill px-2 py-1 shadow-none d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4361ee&color=fff" class="avatar-sm rounded-circle">
                    <span class="small fw-bold me-1 d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down text-muted small"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-soft border-0 mt-2 p-2" style="min-width: 200px;">
                    <!--<li><a class="dropdown-item rounded-2 py-2" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>-->
                    <!--<li><a class="dropdown-item rounded-2 py-2" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>-->
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item rounded-2 py-2 text-danger fw-bold" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
