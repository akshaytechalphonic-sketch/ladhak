<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hotel Admin | {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap 5.3 CSS & Custom CSS (Sharing PMS styles for consistency) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pms.css') }}" rel="stylesheet">
    
    <style>
        /* Modern Table Adjustments */
        .table thead th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #6c757d;
            background: rgba(0,0,0,0.02);
            padding: 1.25rem 1rem;
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
    </style>
    @stack('styles')
</head>
<body>

    <div id="wrapper">
        
        <!-- Sidebar -->
        @include('admin.components.sidebar')

        <div id="content-wrapper">
            
            <!-- Topbar -->
            @include('admin.components.topbar')

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="container-fluid py-4">
                    {{-- @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4 px-4 py-3 rounded-3 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif --}}

                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mb-4 px-4 py-3 rounded-3 d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
            
        </div>
    </div>
    
    <!-- Toast Container -->
    <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060;"></div>

    <!-- Bootstrap 5.3 JS Bundle & Custom JS (Sharing PMS JS for toggle logic) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/pms.js') }}"></script>
    
    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.editor').forEach(el => {
                ClassicEditor
                    .create(el, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'imageUpload', 'mediaEmbed', '|', 'undo', 'redo'],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                            ]
                        },
                        ckfinder: {
                            // Point to the upload route
                            uploadUrl: "{{ route('admin.upload.editor.image') }}?_token={{ csrf_token() }}"
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
