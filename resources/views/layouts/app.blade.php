<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ChemLab - Laboratory Equipment Management System')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <!-- Custom Styles -->
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        /* Select2 Dark Mode Styles */
        .dark .select2-container--default .select2-selection--single {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f9fafb;
        }
        
        .dark .select2-dropdown {
            background-color: #374151;
            border-color: #4b5563;
        }
        
        .dark .select2-results__option {
            color: #f9fafb;
        }
        
        .dark .select2-results__option--highlighted {
            background-color: #3b82f6;
        }
        
        /* DataTables Dark Mode */
        .dark .dataTables_wrapper {
            color: #f9fafb;
        }
        
        .dark table.dataTable thead th {
            border-bottom-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark table.dataTable tbody td {
            border-top-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark .dataTables_filter input {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        /* Flatpickr Dark Mode */
        .dark .flatpickr-calendar {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark .flatpickr-day {
            color: #f9fafb;
        }
        
        .dark .flatpickr-day:hover {
            background: #4b5563;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    @auth
        @include('layouts.navigation')
    @endauth
    
    <!-- Main Content -->
    <main class="{{ auth()->check() ? 'lg:pl-64' : '' }}">
        @yield('content')
    </main>
    
    <!-- Toast Notifications -->
    <div x-data="{ show: false, message: '', type: 'success' }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         @toast.window="show = true; message = $event.detail.message; type = $event.detail.type || 'success'; setTimeout(() => show = false, 5000)"
         class="fixed bottom-4 right-4 z-50 max-w-sm">
        <div :class="{
            'bg-green-500': type === 'success',
            'bg-red-500': type === 'error',
            'bg-blue-500': type === 'info',
            'bg-yellow-500': type === 'warning'
        }" class="text-white px-6 py-4 rounded-lg shadow-lg">
            <p x-text="message"></p>
        </div>
    </div>
    
    <!-- Initialize Libraries -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
        
        // Dark mode toggle
        window.toggleDarkMode = function() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTables with responsive and dark mode support
            if (typeof $.fn.DataTable !== 'undefined') {
                $('.data-table').each(function() {
                    $(this).DataTable({
                        responsive: true,
                        pageLength: 10,
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "No entries found",
                            emptyTable: "No data available in table"
                        }
                    });
                });
            }
            
            // Initialize Flatpickr
            if (typeof flatpickr !== 'undefined') {
                flatpickr('.date-picker', {
                    dateFormat: 'Y-m-d',
                    theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                });
                
                flatpickr('.datetime-picker', {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                });
            }
            
            // Initialize Select2
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2({
                    theme: 'default',
                    width: '100%'
                });
            }
            
            // Show success/error messages
            @if(session('success'))
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: { message: '{{ session('success') }}', type: 'success' }
                }));
            @endif
            
            @if(session('error'))
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: { message: '{{ session('error') }}', type: 'error' }
                }));
            @endif
            
            @if($errors->any())
                @foreach($errors->all() as $error)
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: { message: '{{ $error }}', type: 'error' }
                    }));
                @endforeach
            @endif
        });
    </script>
    
    @stack('scripts')
</body>
</html>