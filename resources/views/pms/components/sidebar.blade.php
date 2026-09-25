<aside id="sidebar">
    <div class="sidebar-header p-4 d-flex align-items-center">
        <i class="bi bi-hexagon-fill text-primary fs-3 me-2"></i>
        <h4 class="mb-0 fw-bold sidebar-text text-primary" style="letter-spacing: -0.5px;">PMS<span class="text-body d-inline">Pro</span></h4>
    </div>
    
    <div class="sidebar-menu flex-grow-1 overflow-y-auto mt-2">
        <a href="{{ route('pms.dashboard') ?? '#' }}" class="sidebar-link {{ request()->routeIs('pms.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        
        <div class="ps-4 text-uppercase text-muted fw-bold mt-4 mb-2 sidebar-text" style="font-size: 0.7rem; letter-spacing: 1px;">Workspace</div>
        
        <a href="{{ route('pms.projects.index') ?? '#' }}" class="sidebar-link {{ request()->routeIs('pms.projects.index') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i>
            <span class="sidebar-text">Projects</span>
        </a>
        
        <a href="{{ route('pms.projects.board') ?? '#' }}" class="sidebar-link {{ request()->routeIs('pms.projects.board') ? 'active' : '' }}">
            <i class="bi bi-kanban"></i>
            <span class="sidebar-text">Kanban Board</span>
        </a>
        
        <a href="{{ route('pms.users.index') ?? '#' }}" class="sidebar-link {{ request()->routeIs('pms.users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span class="sidebar-text">Team Members</span>
        </a>
        
        <div class="ps-4 text-uppercase text-muted fw-bold mt-4 mb-2 sidebar-text" style="font-size: 0.7rem; letter-spacing: 1px;">Settings</div>
        
        <a href="#" class="sidebar-link">
            <i class="bi bi-gear"></i>
            <span class="sidebar-text">Project Settings</span>
        </a>
    </div>
    
    <div class="sidebar-footer p-3 border-top" style="border-color: var(--pms-border) !important;">
        <div class="d-flex align-items-center sidebar-profile p-2 rounded" style="background: rgba(67, 97, 238, 0.05);">
            <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff" alt="User" class="avatar-sm rounded-circle me-3">
            <div class="sidebar-text overflow-hidden">
                <h6 class="mb-0 fw-bold fs-6 text-truncate">Sys Admin</h6>
                <small class="text-muted text-truncate d-block" style="font-size: 0.75rem;">admin@hotelres.com</small>
            </div>
        </div>
    </div>
</aside>
