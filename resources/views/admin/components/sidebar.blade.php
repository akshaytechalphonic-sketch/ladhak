<aside id="sidebar">
    <div class="sidebar-header p-4 d-flex align-items-center">
       <div>

            <img src="{{ asset('storage/logo.png') }}" alt="Ladakh Tourism Logo" style="height: 50px;">
        </div>
    </div>
    
    <div class="sidebar-menu flex-grow-1 overflow-y-auto mt-2">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        
        <div class="ps-4 text-uppercase text-muted fw-bold mt-4 mb-2 sidebar-text" style="font-size: 0.7rem; letter-spacing: 1px;">Core Management</div>
        
        <a href="{{ route('admin.hotels.index') }}" class="sidebar-link {{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}">
            <i class="bi bi-buildings"></i>
            <span class="sidebar-text">Hotels</span>
        </a>

        <a href="{{ route('admin.packages.index') }}" class="sidebar-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
            <i class="bi bi-compass"></i>
            <span class="sidebar-text">Tour Packages</span>
        </a>
        
        <a href="{{ route('admin.rooms.index') }}" class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
            <i class="bi bi-door-closed"></i>
            <span class="sidebar-text">Rooms</span>
        </a>
        
        <a href="{{ route('admin.bookings.index') }}" class="sidebar-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
            <i class="bi bi-bookmark-check"></i>
            <span class="sidebar-text">Bookings</span>
        </a>
        
        <div class="ps-4 text-uppercase text-muted fw-bold mt-4 mb-2 sidebar-text" style="font-size: 0.7rem; letter-spacing: 1px;">Content & CRM</div>

        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="bi bi-shield-check"></i>
            <span class="sidebar-text">Services</span>
        </a>

        <a href="{{ route('admin.offers.index') }}" class="sidebar-link {{ request()->routeIs('admin.offers.*') ? 'active' : '' }}">
            <i class="bi bi-tag"></i>
            <span class="sidebar-text">Offers</span>
        </a>

        <a href="{{ route('admin.destinations.index') }}" class="sidebar-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i>
            <span class="sidebar-text">Destinations</span>
        </a>

        <a href="{{ route('admin.galleries.index') }}" class="sidebar-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i>
            <span class="sidebar-text">Gallery</span>
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote"></i>
            <span class="sidebar-text">Testimonials</span>
        </a>

        <a href="{{ route('admin.enquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i>
            <span class="sidebar-text">Enquiries</span>
        </a>

        <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
            <i class="bi bi-question-circle"></i>
            <span class="sidebar-text">FAQs</span>
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i>
            <span class="sidebar-text">Blogs</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span class="sidebar-text">Settings</span>
        </a>

        <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
            <span class="sidebar-text">Pages (CMS)</span>
        </a>

        <div class="ps-4 text-uppercase text-muted fw-bold mt-4 mb-2 sidebar-text" style="font-size: 0.7rem; letter-spacing: 1px;">System</div>
        
        <a href="{{ route('home') }}" class="sidebar-link">
            <i class="bi bi-house-door"></i>
            <span class="sidebar-text">Public Website</span>
        </a>

        {{-- <a href="{{ route('pms.dashboard') }}" class="sidebar-link">
            <i class="bi bi-rocket-takeoff"></i>
            <span class="sidebar-text">PMS Workspace</span>
        </a> --}}
    </div>
    
    <div class="sidebar-footer p-3 border-top" style="border-color: var(--pms-border) !important;">
        <div class="d-flex align-items-center sidebar-profile p-2 rounded" style="background: rgba(67, 97, 238, 0.05);">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4361ee&color=fff" alt="User" class="avatar-sm rounded-circle me-3">
            <div class="sidebar-text overflow-hidden">
                <h6 class="mb-0 fw-bold fs-6 text-truncate">{{ Auth::user()->name }}</h6>
                <small class="text-muted text-truncate d-block" style="font-size: 0.75rem;">{{ Auth::user()->email }}</small>
            </div>
        </div>
    </div>
</aside>
