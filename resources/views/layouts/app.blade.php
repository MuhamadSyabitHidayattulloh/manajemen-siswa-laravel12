<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Manajemen Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --sidebar-bg: #ffffff;
            --card-bg: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
            --hover-bg: #f7fafc;
            --body-bg: #f8fafc;
            --link-color: #3182ce;
            --link-hover-color: #2c5282;
            --header-bg: #ffffff;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 0px;
            --header-height: 60px;
            --primary-color: #3b82f6;
            --primary-dark: #1e40af;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --primary-rgb: 59, 130, 246;
            --sidebar-hover-bg: rgba(59, 130, 246, 0.08);
            --sidebar-active-text: #ffffff;
            --sidebar-transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            color: var(--text-primary);
            background: var(--body-bg);
        }

        a {
            color: var(--link-color);
            text-decoration: none;
        }

        a:hover {
            color: var(--link-hover-color);
        }

        .text-muted {
            color: var(--text-secondary) !important;
        }

        .sidebar {
            position: fixed;
            left: calc(var(--sidebar-collapsed-width) - var(--sidebar-width));
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            z-index: 1040;
            transition: all var(--sidebar-transition);
            background: var(--sidebar-bg);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
            overflow-x: hidden;
            overflow-y: auto;
            backdrop-filter: blur(10px);
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar-brand {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            margin: 1.25rem;
            border-radius: 1rem;
            padding: 1.5rem !important;
            color: white;
            transition: all var(--sidebar-transition);
            transform-origin: left;
        }

        .sidebar:hover .sidebar-brand,
        .sidebar.show .sidebar-brand {
            transform: scale(1.02);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: var(--text-secondary);
            border-radius: 0.75rem;
            transition: all var(--sidebar-transition);
            margin: 0.25rem 1rem;
            position: relative;
            font-weight: 500;
        }

        .sidebar-link .bi {
            font-size: 1.25rem;
            transition: all var(--sidebar-transition);
            width: 1.5rem;
            text-align: center;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover-bg);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--sidebar-active-text);
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.25);
        }

        .sidebar-link.active .bi {
            transform: scale(1.1);
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-secondary);
            font-weight: 600;
            padding: 1.5rem 1.5rem 0.75rem;
            opacity: 0;
            transition: opacity var(--sidebar-transition);
            margin-top: 0.5rem;
        }

        .link-text {
            margin-left: 1rem;
            opacity: 0;
            transition: all var(--sidebar-transition);
            white-space: nowrap;
        }

        .sidebar:hover .link-text,
        .sidebar.show .link-text,
        .sidebar:hover .sidebar-heading,
        .sidebar.show .sidebar-heading {
            opacity: 1;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1039;
        }

        .sidebar-backdrop.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -100%;
                transform: none;
                z-index: 1041;
            }

            .sidebar.show {
                left: 0;
                transform: none;
            }

            .mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1030;
                background: var(--header-bg);
                padding: 0.75rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
        }

        .stat-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%) !important;
        }

        .sidebar-toggle {
            position: fixed;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0.5rem;
            z-index: 1041;
            transition: all var(--sidebar-transition);
            cursor: pointer;
        }

        .sidebar-toggle.shifted {
            left: var(--sidebar-width);
        }

        .sidebar-toggle:hover {
            background: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Mobile Header -->
        <div class="mobile-header d-md-none">
            <button class="btn btn-primary btn-sm" onclick="toggleMobileSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Add Toggle Button -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-chevron-right"></i>
        </button>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-brand d-flex align-items-center">
                <i class="bi bi-mortarboard-fill text-white fs-4"></i>
                <span class="link-text ms-3 text-white">Manajemen Siswa</span>
            </div>

            <!-- Dashboard Section -->
            <div class="sidebar-heading">Dashboard</div>
            <a href="{{ route('siswa.index') }}"
               class="sidebar-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span class="link-text">Overview</span>
            </a>

            <!-- Manajemen Siswa Section -->
            <div class="sidebar-heading">Manajemen Siswa</div>
            <a href="{{ route('siswa.index') }}"
               class="sidebar-link {{ request()->routeIs('siswa.index') && !request()->query() ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span class="link-text">Daftar Siswa</span>
            </a>
            <a href="{{ route('siswa.create') }}"
               class="sidebar-link {{ request()->routeIs('siswa.create') ? 'active' : '' }}">
                <i class="bi bi-person-plus-fill"></i>
                <span class="link-text">Tambah Siswa</span>
            </a>

            <!-- Filter Section -->
            <div class="sidebar-heading">Filter Cepat</div>
            <a href="{{ route('siswa.index', ['jenis_kelamin' => 'laki-laki']) }}"
               class="sidebar-link {{ request('jenis_kelamin') == 'laki-laki' ? 'active' : '' }}">
                <i class="bi bi-gender-male"></i>
                <span class="link-text">Siswa Laki-laki</span>
            </a>
            <a href="{{ route('siswa.index', ['jenis_kelamin' => 'perempuan']) }}"
               class="sidebar-link {{ request('jenis_kelamin') == 'perempuan' ? 'active' : '' }}">
                <i class="bi bi-gender-female"></i>
                <span class="link-text">Siswa Perempuan</span>
            </a>

            <!-- Kelas Section -->
            <div class="sidebar-heading">Kelas</div>
            @foreach(['10', '11', '12'] as $kelas)
                <a href="{{ route('siswa.index', ['kelas' => $kelas]) }}"
                   class="sidebar-link {{ request('kelas') == $kelas ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i>
                    <span class="link-text">Kelas {{ $kelas }}</span>
                </a>
            @endforeach
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <div class="content-wrapper px-4">
                <!-- Header/Breadcrumb -->
                <header class="bg-white shadow-sm mb-4 p-3 rounded">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </nav>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="py-3">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop" onclick="toggleMobileSidebar()"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleButton = document.getElementById('sidebarToggle');
            const toggleIcon = toggleButton.querySelector('i');

            sidebar.classList.toggle('show');
            mainContent.classList.toggle('shifted');
            toggleButton.classList.toggle('shifted');

            // Update the toggle icon
            if (sidebar.classList.contains('show')) {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
            } else {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
            }
        }

        // Add click event for the toggle button
        document.getElementById('sidebarToggle').addEventListener('click', toggleSidebar);

        // Modify keyboard shortcut to use the new toggle function
        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.shiftKey) {
                toggleSidebar();
            }
        });

        function toggleMobileSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const backdrop = document.querySelector('.sidebar-backdrop');

            sidebar.classList.toggle('show');
            backdrop.classList.toggle('show');

            // Prevent body scroll when sidebar is open
            document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
        }

        // Close sidebar when clicking backdrop
        document.querySelector('.sidebar-backdrop').addEventListener('click', function() {
            toggleMobileSidebar();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.querySelector('.sidebar');
            const backdrop = document.querySelector('.sidebar-backdrop');

            if (window.innerWidth > 768 && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
                document.body.style.overflow = '';
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const sidebar = document.querySelector('.sidebar');
                const sidebarBackdrop = document.querySelector('.sidebar-backdrop');
                const toggleBtn = document.querySelector('.btn-primary');

                if (!sidebar.contains(event.target) && event.target !== toggleBtn) {
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar-backdrop').classList.remove('show');
            }
        });
    </script>
</body>
</html>
