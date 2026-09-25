<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PMS Dashboard') | Project Management System</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap 5.3 CSS & Custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pms.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>

    <div id="wrapper">
        
        <!-- Sidebar -->
        @include('pms.components.sidebar')

        <div id="content-wrapper">
            
            <!-- Topbar -->
            @include('pms.components.topbar')

            <!-- Main Content -->
            <main class="main-content">
                @yield('content')
            </main>
            
        </div>
    </div>
    
    <!-- Toast Container -->
    <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060;"></div>

    <!-- Bootstrap 5.3 JS Bundle & Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/pms.js') }}"></script>
    
    <!-- Chart.js (Loaded globally since dashboards & projects use it) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- SortableJS (for Kanban) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    @stack('scripts')
</body>
</html>
