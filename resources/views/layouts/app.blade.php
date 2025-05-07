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
            left: 0;
            top: 0;
            bottom: 0;
            width: 70px;
            z-index: 1040;
            transition: all 0.35s ease-in-out;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--body-bg) 100%);
        }

        .sidebar:hover {
            width: 250px;
        }

        .sidebar .link-text,
        .sidebar .sidebar-heading {
            display: none;
            transition: opacity 0.3s;
            white-space: nowrap;
        }

        .sidebar:hover .link-text,
        .sidebar:hover .sidebar-heading {
            display: block;
        }

        .sidebar .sidebar-brand {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar:hover .sidebar-brand {
            justify-content: flex-start;
        }

        .sidebar .sidebar-link {
            justify-content: center;
            padding: 0.75rem;
            margin: 0.3rem 0.8rem;
            border-radius: 0.8rem;
        }

        .sidebar:hover .sidebar-link {
            justify-content: flex-start;
            padding: 0.75rem 1rem;
        }

        .sidebar .bi {
            font-size: 1.25rem;
            margin: 0 !important;
            display: block;
        }

        .sidebar:hover .bi {
            margin-right: 0.5rem !important;
            font-size: 1.25rem;
        }

        .card {
            background: var(--card-bg) !important;
            border-color: var(--border-color);
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .form-control, .form-select {
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            background-color: #ffffff;
            border-color: var(--border-color);
            color: var(--text-primary);
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: var(--bs-primary);
            color: var(--text-primary);
        }

        .form-control:hover, .form-select:hover {
            border-color: var(--bs-primary);
        }

        .input-group-text {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .table {
            --bs-table-hover-bg: var(--hover-bg);
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .table th {
            background-color: #f8fafc;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.75rem;
            white-space: nowrap;
            letter-spacing: normal;
            text-transform: none;
        }

        /* Ensure consistent font weight for dropdown toggles in table headers */
        .table th .btn-link {
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0;
        }

        /* Keep dropdown text consistent with other header text */
        .table th .dropdown-toggle {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }

        .alert {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.5rem;
        }

        .bi {
            font-weight: 600;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        header {
            background: var(--header-bg) !important;
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-link {
            color: var(--text-secondary);
            border-radius: 8px;
            margin: 4px 0;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: var(--link-color);
            color: white !important;
        }

        .dropdown-menu {
            background: var(--card-bg);
            border-color: var(--border-color);
        }

        .dropdown-item {
            color: var(--text-primary);
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .dropdown-item.active {
            background: var(--bs-primary);
            color: white;
        }

        .modal-content {
            background: var(--card-bg);
        }

        .modal-header, .modal-footer {
            border-color: var(--border-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 0 0 20px rgba(0,0,0,0.15);
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding-top: 60px;
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

        .sidebar-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            color: var(--text-secondary);
            border-radius: 0.5rem;
            transition: all 0.3s;
            margin-bottom: 0.5rem;
            width: 100%;
        }

        .sidebar-link.active {
            background-color: var(--link-color);
            color: white;
        }

        .sidebar-link.active .bi {
            color: white;
        }

        .sidebar-link:hover:not(.active) {
            background-color: var(--hover-bg);
            color: var(--text-primary);
        }

        .sidebar:hover .sidebar-link {
            justify-content: flex-start;
            padding: 0.75rem 1rem;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            font-weight: 600;
            padding: 0.75rem 1rem;
            margin-top: 1rem;
        }

        .stat-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
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

        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-sm vh-100 overflow-auto">
            <div class="d-flex align-items-center p-3 mb-3 sidebar-brand">
                <i class="bi bi-mortarboard-fill text-primary fs-3"></i>
                <span class="link-text ms-2">Manajemen Siswa</span>
            </div>

            <!-- Dashboard Section -->
            <div class="sidebar-heading">Dashboard</div>
            <a href="{{ route('siswa.index') }}"
               class="sidebar-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}"
               title="Overview">
                <i class="bi bi-speedometer2"></i>
                <span class="link-text ms-2">Overview</span>
            </a>

            <!-- Manajemen Siswa Section -->
            <div class="sidebar-heading">Manajemen Siswa</div>
            <a href="{{ route('siswa.index') }}"
               class="sidebar-link {{ request()->routeIs('siswa.index') && !request()->query() ? 'active' : '' }}"
               title="Daftar Siswa">
                <i class="bi bi-people-fill"></i>
                <span class="link-text ms-2">Daftar Siswa</span>
            </a>
            <a href="{{ route('siswa.create') }}"
               class="sidebar-link {{ request()->routeIs('siswa.create') ? 'active' : '' }}"
               title="Tambah Siswa">
                <i class="bi bi-person-plus-fill"></i>
                <span class="link-text ms-2">Tambah Siswa</span>
            </a>

            <!-- Filter Section -->
            <div class="sidebar-heading">Filter Cepat</div>
            <a href="{{ route('siswa.index', ['jenis_kelamin' => 'laki-laki']) }}"
               class="sidebar-link {{ request('jenis_kelamin') == 'laki-laki' ? 'active' : '' }}"
               title="Siswa Laki-laki">
                <i class="bi bi-gender-male"></i>
                <span class="link-text ms-2">Siswa Laki-laki</span>
            </a>
            <a href="{{ route('siswa.index', ['jenis_kelamin' => 'perempuan']) }}"
               class="sidebar-link {{ request('jenis_kelamin') == 'perempuan' ? 'active' : '' }}"
               title="Siswa Perempuan">
                <i class="bi bi-gender-female"></i>
                <span class="link-text ms-2">Siswa Perempuan</span>
            </a>

            <!-- Kelas Section -->
            <div class="sidebar-heading">Kelas</div>
            @foreach(['10', '11', '12'] as $kelas)
                <a href="{{ route('siswa.index', ['kelas' => $kelas]) }}"
                   class="sidebar-link {{ request('kelas') == $kelas ? 'active' : '' }}"
                   title="Kelas {{ $kelas }}">
                    <i class="bi bi-mortarboard"></i>
                    <span class="link-text ms-2">Kelas {{ $kelas }}</span>
                </a>
            @endforeach
        </div>

        <!-- Main Content -->
        <div class="main-content">
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

        function toggleMobileSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-backdrop').classList.toggle('show');
        }

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
                document.querySelector('.sidebar').classList.remove('show');
                document.querySelector('.sidebar-backdrop').classList.remove('show');
            }
        });
    </script>
</body>
</html>
