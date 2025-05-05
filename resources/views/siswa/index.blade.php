@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div class="container-fluid fade-in">
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

    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <h1 class="h3 mb-2 text-gray-800">
                <i class="bi bi-people-fill text-primary me-2"></i>Daftar Siswa
            </h1>
            <p class="text-muted">Mengelola data siswa dengan mudah dan efisien</p>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap gap-2 justify-content-md-end">
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search Box -->
    <div class="card shadow-sm mb-4 border-0 rounded-3">
        <div class="card-body p-3">
            <form action="{{ route('siswa.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari berdasarkan NIS, Nama, atau Alamat...">
                    @if(request('search'))
                        <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Jurusan Legend -->
    <div class="card shadow-sm mb-4 border-0 rounded-3">
        <div class="card-body">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Keterangan Warna Jurusan:</h6>
            <div class="d-flex flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <span class="badge bg-info rounded-pill me-2">BR</span>
                    <small class="text-muted">Bisnis Ritel</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-warning rounded-pill me-2">DKV</span>
                    <small class="text-muted">Desain Komunikasi Visual</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success rounded-pill me-2">RPL</span>
                    <small class="text-muted">Rekayasa Perangkat Lunak</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary rounded-pill me-2">MP</span>
                    <small class="text-muted">Manajemen Perkantoran</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-danger rounded-pill me-2">AK</span>
                    <small class="text-muted">Akuntansi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive" style="min-width: 100%;">
                <table class="table table-hover align-middle mb-0" style="min-width: 1200px;">
                    <thead class="bg-light">
                        <tr>
                            <th>
                                <a href="{{ route('siswa.index', ['sort' => 'nis', 'direction' => $sort === 'nis' && $direction === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}" 
                                   class="text-decoration-none text-dark d-flex align-items-center gap-1">
                                    NIS
                                    @if($sort === 'nis')
                                        <i class="bi bi-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('siswa.index', ['sort' => 'nama', 'direction' => $sort === 'nama' && $direction === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}"
                                   class="text-decoration-none text-dark d-flex align-items-center gap-1">
                                    Nama
                                    @if($sort === 'nama')
                                        <i class="bi bi-arrow-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0 text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Kelas
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item {{ empty(request('kelas')) ? 'active' : '' }}" href="{{ route('siswa.index', request()->except('kelas')) }}">Semua</a></li>
                                        @foreach(['10', '11', '12'] as $k)
                                            <li><a class="dropdown-item {{ request('kelas') == $k ? 'active' : '' }}" 
                                                  href="{{ route('siswa.index', ['kelas' => $k] + request()->except('kelas')) }}">Kelas {{ $k }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0 text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Jurusan
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item {{ empty(request('jurusan')) ? 'active' : '' }}" href="{{ route('siswa.index', request()->except('jurusan')) }}">Semua</a></li>
                                        @php
                                            $jurusanList = [
                                                'br' => 'Bisnis Ritel',
                                                'dkv1' => 'DKV 1',
                                                'dkv2' => 'DKV 2',
                                                'rpl' => 'RPL',
                                                'mp' => 'MP',
                                                'ak' => 'AK'
                                            ];
                                        @endphp
                                        @foreach($jurusanList as $key => $label)
                                            <li><a class="dropdown-item {{ request('jurusan') == $key ? 'active' : '' }}" 
                                                  href="{{ route('siswa.index', ['jurusan' => $key] + request()->except('jurusan')) }}">{{ $label }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0 text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Jenis Kelamin
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item {{ empty(request('jenis_kelamin')) ? 'active' : '' }}" href="{{ route('siswa.index', request()->except('jenis_kelamin')) }}">Semua</a></li>
                                        <li><a class="dropdown-item {{ request('jenis_kelamin') == 'laki-laki' ? 'active' : '' }}" 
                                              href="{{ route('siswa.index', ['jenis_kelamin' => 'laki-laki'] + request()->except('jenis_kelamin')) }}">Laki-laki</a></li>
                                        <li><a class="dropdown-item {{ request('jenis_kelamin') == 'perempuan' ? 'active' : '' }}" 
                                              href="{{ route('siswa.index', ['jenis_kelamin' => 'perempuan'] + request()->except('jenis_kelamin')) }}">Perempuan</a></li>
                                    </ul>
                                </div>
                            </th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $s)
                            <tr>
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
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('siswa.show', $s->id) }}">
                                                    <i class="bi bi-eye me-2"></i>Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('siswa.edit', $s->id) }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}">
                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Delete Modal -->
                                        <div class="modal fade modal-confirm" id="deleteModal{{ $s->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="icon-box">
                                                            <i class="bi bi-exclamation-triangle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 class="mb-3">Apakah anda yakin?</h4>
                                                        <p class="mb-0">Data siswa {{ $s->nama }} akan dihapus permanen.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
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
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ...existing code for form handling and dropdowns...
</script>
@endpush
