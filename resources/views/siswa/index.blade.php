@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div class="container-fluid px-4">
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Siswa</h6>
                            <h3 class="mb-0">{{ $totalSiswa }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Jurusan</h6>
                            <h3 class="mb-0">{{ $totalJurusan }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-diagram-3-fill text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Kelas</h6>
                            <h3 class="mb-0">{{ $totalKelas }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-mortarboard-fill text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Siswa/Siswi</h6>
                            <h3 class="mb-0">{{ $totalLaki }}/{{ $totalPerempuan }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-gender-ambiguous text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Enhanced Table -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <!-- Enhanced Table Header -->
        <div class="card-header border-0 bg-white p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Daftar Siswa</h5>
                            <p class="text-muted mb-0">Total: {{ $siswa->total() }} siswa</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div class="btn-group">
                            <a href="{{ route('siswa.index', array_merge($filters ?? [], ['export' => 'excel']))}}" class="btn btn-success shadow-sm">
                                <i class="bi bi-file-earmark-excel-fill me-2"></i>Excel
                            </a>
                            <a href="{{ route('siswa.index', array_merge($filters ?? [], ['export' => 'pdf']))}}" class="btn btn-danger shadow-sm">
                                <i class="bi bi-file-earmark-pdf-fill me-2"></i>PDF
                            </a>
                        </div>
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary shadow-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i>Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Search Box -->
        <div class="card-body border-bottom p-4">
            <form action="{{ route('siswa.index') }}" method="GET" id="searchForm">
                <!-- Preserve existing filter parameters -->
                @foreach(request()->except(['page', 'search']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $arrayValue)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $arrayValue }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="search" 
                                   class="form-control border-start-0 ps-0" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan nama, NIS, atau alamat..."
                                   onkeyup="submitSearch(event)">
                            @if(request('search'))
                                <a href="{{ route('siswa.index', request()->except('search')) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="button" 
                                    class="btn btn-light w-100" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#filterModal">
                                <i class="bi bi-funnel me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Enhanced Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="min-width: 1200px;">
                <thead class="bg-light">
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                        <tr class="cursor-pointer"
                            data-id="{{ $s->id }}"
                            onclick="window.location='{{ route('siswa.show', $s->id) }}'"
                            oncontextmenu="showContextMenu(event, {{ $s->id }}, '{{ $s->nama }}'); return false;">
                            <td onclick="event.stopPropagation()">
                                <div class="form-check">
                                    <input class="form-check-input row-checkbox" type="checkbox" value="{{ $s->id }}">
                                </div>
                            </td>
                            <td><span class="badge bg-secondary rounded-pill">{{ $s->nis }}</span></td>
                            <td class="fw-semibold">{{ $s->nama }}</td>
                            <td><span class="badge bg-light text-dark">{{ $s->kelas }}</span></td>
                            <td>
                                @switch($s->jurusan)
                                    @case('br') <span class="badge bg-info rounded-pill">BR</span> @break
                                    @case('dkv1') <span class="badge bg-warning rounded-pill">DKV 1</span> @break
                                    @case('dkv2') <span class="badge bg-warning rounded-pill">DKV 2</span> @break
                                    @case('rpl') <span class="badge bg-success rounded-pill">RPL</span> @break
                                    @case('mp') <span class="badge bg-primary rounded-pill">MP</span> @break
                                    @case('ak') <span class="badge bg-danger rounded-pill">AK</span> @break
                                @endswitch
                            </td>
                            <td>
                                <i class="bi {{ $s->jenis_kelamin == 'laki-laki' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }} me-1"></i>
                                {{ ucfirst($s->jenis_kelamin) }}
                            </td>
                            <td class="text-muted">{{ $s->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row align-items-center">
            <div class="col-md-6 text-muted small">
                Menampilkan {{ $siswa->firstItem() ?? 0 }} sampai {{ $siswa->lastItem() ?? 0 }} dari {{ $siswa->total() }} data
            </div>
            <div class="col-md-6">
                <div class="float-md-end">
                    {{ $siswa->links('vendor.pagination.simple-bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Context Menu -->
    <div id="contextMenu" class="position-fixed shadow-sm rounded-3" style="display: none; z-index: 1050; min-width: 200px; background: white;">
        <div class="p-2">
            <h6 class="dropdown-header px-2 text-muted"></h6>
            <a href="#" class="d-flex align-items-center px-3 py-2 text-decoration-none text-dark rounded-2 edit-link">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="#" class="d-flex align-items-center px-3 py-2 text-decoration-none text-danger rounded-2 delete-link">
                <i class="bi bi-trash me-2"></i>Hapus
            </a>
        </div>
    </div>

    <!-- Bulk Delete Button -->
    <div id="bulkActions" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 bg-white shadow-lg rounded-pill px-4 py-2" style="display: none; z-index: 1000;">
        <button class="btn btn-danger btn-sm" onclick="confirmBulkDelete()">
            <i class="bi bi-trash me-2"></i>Hapus <span id="selectedCount">0</span> data terpilih
        </button>
    </div>

    <!-- Delete Modal for each row -->
    @foreach($siswa as $s)
        <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data siswa <strong>{{ $s->nama }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('siswa.destroy', 'bulk') }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
        <input type="hidden" name="ids" id="bulkDeleteIds">
    </form>

    <!-- Add a floating action button for mobile -->
    <div class="position-fixed bottom-0 end-0 m-4 d-md-none">
        <a href="{{ route('siswa.create') }}" 
           class="btn btn-primary btn-lg rounded-circle shadow-lg">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <!-- Enhanced Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title">
                        <i class="bi bi-funnel me-2"></i>Filter & Pengurutan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.index') }}" method="GET" id="filterForm">
                        <!-- Pengurutan -->
                        <div class="mb-4">
                            <label class="form-label text-muted">Urutkan Berdasarkan</label>
                            <div class="row g-2">
                                <div class="col-sm-8">
                                    <select class="form-select" name="sort">
                                        <option value="">Pilih kolom</option>
                                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama Siswa</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select" name="direction">
                                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>A - Z</option>
                                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Z - A</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted">

                        <!-- Kelas Filter -->
                        <div class="mb-4">
                            <label class="form-label text-muted">Kelas</label>
                            <div class="select-tags">
                                @foreach(['10', '11', '12'] as $k)
                                    <input type="checkbox" class="btn-check" name="kelas[]" id="kelas{{ $k }}" 
                                           value="{{ $k }}" {{ in_array($k, (array)request('kelas')) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary btn-sm mb-2 me-2" for="kelas{{ $k }}">
                                        <i class="bi bi-mortarboard-fill me-1"></i>Kelas {{ $k }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Jurusan Filter -->
                        <div class="mb-4">
                            <label class="form-label text-muted">Jurusan</label>
                            <div class="select-tags">
                                @php
                                    $jurusanColors = [
                                        'br' => ['name' => 'Bisnis Ritel', 'color' => 'info'],
                                        'dkv1' => ['name' => 'DKV 1', 'color' => 'warning'],
                                        'dkv2' => ['name' => 'DKV 2', 'color' => 'warning'],
                                        'rpl' => ['name' => 'RPL', 'color' => 'success'],
                                        'mp' => ['name' => 'MP', 'color' => 'primary'],
                                        'ak' => ['name' => 'AK', 'color' => 'danger']
                                    ];
                                @endphp
                                @foreach($jurusanColors as $key => $data)
                                    <input type="checkbox" class="btn-check" name="jurusan[]" id="jurusan{{ $key }}"
                                           value="{{ $key }}" {{ in_array($key, (array)request('jurusan')) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-{{ $data['color'] }} btn-sm mb-2 me-2" for="jurusan{{ $key }}">
                                        <i class="bi bi-book-fill me-1"></i>{{ $data['name'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Jenis Kelamin Filter -->
                        <div class="mb-4">
                            <label class="form-label text-muted">Jenis Kelamin</label>
                            <div class="select-tags">
                                <input type="checkbox" class="btn-check" name="jenis_kelamin[]" id="gender_l" 
                                       value="laki-laki" {{ in_array('laki-laki', (array)request('jenis_kelamin')) ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary btn-sm mb-2 me-2" for="gender_l">
                                    <i class="bi bi-gender-male me-1"></i>Laki-laki
                                </label>
                                
                                <input type="checkbox" class="btn-check" name="jenis_kelamin[]" id="gender_p" 
                                       value="perempuan" {{ in_array('perempuan', (array)request('jenis_kelamin')) ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger btn-sm mb-2 me-2" for="gender_p">
                                    <i class="bi bi-gender-female me-1"></i>Perempuan
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <a href="{{ route('siswa.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                    </a>
                    <button type="submit" form="filterForm" class="btn btn-primary px-4">
                        <i class="bi bi-funnel-fill me-2"></i>Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Active Filters Display -->
    @if(request('sort') || request('kelas') || request('jurusan') || request('jenis_kelamin'))
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
            <span class="text-muted">Filter aktif:</span>
            @if(request('sort'))
                <span class="badge bg-secondary rounded-pill">
                    Urut: {{ request('sort') == 'nama' ? 'Nama' : '' }} ({{ request('direction') == 'asc' ? 'A-Z' : 'Z-A' }})
                    <a href="{{ route('siswa.index', request()->except(['sort', 'direction'])) }}" 
                       class="text-white text-decoration-none ms-1">&times;</a>
                </span>
            @endif
            @if(request('kelas'))
                @foreach((array)request('kelas') as $k)
                    <span class="badge bg-primary rounded-pill">
                        Kelas {{ $k }}
                        <a href="{{ route('siswa.index', array_merge(
                            request()->except('kelas'),
                            ['kelas' => array_diff((array)request('kelas'), [$k])]
                        )) }}" class="text-white text-decoration-none ms-1">&times;</a>
                    </span>
                @endforeach
            @endif
            @if(request('jurusan'))
                @foreach((array)request('jurusan') as $j)
                    <span class="badge bg-{{ $jurusanColors[$j]['color'] }} rounded-pill">
                        {{ $jurusanColors[$j]['name'] }}
                        <a href="{{ route('siswa.index', array_merge(
                            request()->except('jurusan'),
                            ['jurusan' => array_diff((array)request('jurusan'), [$j])]
                        )) }}" class="text-white text-decoration-none ms-1">&times;</a>
                    </span>
                @endforeach
            @endif
            @if(request('jenis_kelamin'))
                @foreach((array)request('jenis_kelamin') as $jk)
                    <span class="badge bg-{{ $jk == 'laki-laki' ? 'primary' : 'danger' }} rounded-pill">
                        {{ ucfirst($jk) }}
                        <a href="{{ route('siswa.index', array_merge(
                            request()->except('jenis_kelamin'),
                            ['jenis_kelamin' => array_diff((array)request('jenis_kelamin'), [$jk])]
                        )) }}" class="text-white text-decoration-none ms-1">&times;</a>
                    </span>
                @endforeach
            @endif
        </div>
    @endif

    <style>
        tr.cursor-pointer { cursor: pointer; }
        tr.cursor-pointer:hover { background-color: rgba(0,0,0,0.02); }
        #contextMenu { min-width: 150px; }
        #contextMenu a:hover { background-color: rgba(0,0,0,0.05); }
        .selected-row { background-color: rgba(0,123,255,0.1) !important; }
        .context-menu-active { background-color: rgba(0,123,255,0.1) !important; }
        .table th {
            font-weight: 600;
            background: var(--bs-gray-100);
        }
        .table td {
            vertical-align: middle;
        }
        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .select-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .btn-check:checked + .btn {
            transform: scale(0.95);
        }

        .badge {
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge a:hover {
            opacity: 0.8;
        }
    </style>

    <script>
        let contextMenu = document.getElementById('contextMenu');
        let bulkActions = document.getElementById('bulkActions');
        let selectedIds = new Set();
        let activeRow = null;

        // Context Menu
        function showContextMenu(event, id, nama) {
            event.preventDefault();

            // Remove active class from previous row
            if (activeRow) activeRow.classList.remove('context-menu-active');

            // Add active class to current row
            activeRow = event.currentTarget;
            activeRow.classList.add('context-menu-active');

            // Set menu header
            contextMenu.querySelector('.dropdown-header').textContent = nama;

            // Set up menu links
            const editLink = contextMenu.querySelector('.edit-link');
            const deleteLink = contextMenu.querySelector('.delete-link');

            editLink.href = `/siswa/${id}/edit`;
            deleteLink.setAttribute('data-bs-toggle', 'modal');
            deleteLink.setAttribute('data-bs-target', `#deleteModal${id}`);

            // Position menu at cursor
            contextMenu.style.display = 'block';

            // Adjust menu position to keep it in viewport
            const menuWidth = contextMenu.offsetWidth;
            const menuHeight = contextMenu.offsetHeight;
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;

            let left = event.pageX;
            let top = event.pageY;

            if (left + menuWidth > windowWidth) {
                left = windowWidth - menuWidth;
            }

            if (top + menuHeight > windowHeight) {
                top = windowHeight - menuHeight;
            }

            contextMenu.style.left = left + 'px';
            contextMenu.style.top = top + 'px';
        }

        // Hide context menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!contextMenu.contains(event.target)) {
                contextMenu.style.display = 'none';
                if (activeRow) {
                    activeRow.classList.remove('context-menu-active');
                    activeRow = null;
                }
            }
        });

        // Prevent default context menu
        document.addEventListener('contextmenu', (event) => {
            if (!event.target.closest('tr[data-id]')) {
                contextMenu.style.display = 'none';
                if (activeRow) {
                    activeRow.classList.remove('context-menu-active');
                    activeRow = null;
                }
            }
        });

        // Close context menu on scroll
        document.addEventListener('scroll', () => {
            contextMenu.style.display = 'none';
            if (activeRow) {
                activeRow.classList.remove('context-menu-active');
                activeRow = null;
            }
        });

        // Checkbox handling
        document.getElementById('selectAll').addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox').forEach(checkbox => {
                checkbox.checked = this.checked;
                handleCheckboxChange(checkbox);
            });
        });

        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(this);
            });
        });

        function handleCheckboxChange(checkbox) {
            const row = checkbox.closest('tr');
            if (checkbox.checked) {
                selectedIds.add(checkbox.value);
                row.classList.add('selected-row');
            } else {
                selectedIds.delete(checkbox.value);
                row.classList.remove('selected-row');
            }

            document.getElementById('selectedCount').textContent = selectedIds.size;
            bulkActions.style.display = selectedIds.size > 0 ? 'block' : 'none';
        }

        function confirmBulkDelete() {
            if (confirm(`Apakah anda yakin ingin menghapus ${selectedIds.size} data terpilih?`)) {
                document.getElementById('bulkDeleteIds').value = Array.from(selectedIds).join(',');
                document.getElementById('bulkDeleteForm').submit();
            }
        }

        // Add click handler for delete links in context menu
        document.querySelectorAll('.delete-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const modalId = this.getAttribute('data-bs-target');
                const modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
            });
        });

        // Prevent row click when selecting text
        document.addEventListener('mousedown', function(e) {
            if (window.getSelection().toString()) {
                e.stopPropagation();
            }
        });

        // Add this to your existing scripts
        function submitSearch(event) {
            // Submit form after 500ms of last keypress
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(() => {
                document.getElementById('searchForm').submit();
            }, 500);
        }
    </script>
</div>
@endsection
