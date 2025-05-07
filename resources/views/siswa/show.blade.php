@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header p-4 position-relative" 
                     style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%)">
                    <div class="d-flex justify-content-between align-items-center position-relative z-1">
                        <div>
                            <h4 class="text-white mb-1">
                                <i class="bi bi-person-circle me-2"></i>Detail Siswa
                            </h4>
                            <div class="text-white-50">NIS: {{ $siswa->nis }}</div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" 
                               class="btn btn-light px-3">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                            <a href="{{ route('siswa.index') }}" 
                               class="btn btn-outline-light px-3">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="position-absolute top-50 end-0 translate-middle-y opacity-25">
                        <i class="bi bi-person-circle display-1 text-white"></i>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        @foreach([
                            ['icon' => 'hash', 'label' => 'NIS', 'value' => $siswa->nis],
                            ['icon' => 'person', 'label' => 'Nama', 'value' => $siswa->nama],
                            ['icon' => 'mortarboard', 'label' => 'Kelas', 'value' => $siswa->kelas],
                            ['icon' => 'book', 'label' => 'Jurusan', 'value' => match($siswa->jurusan) {
                                'br' => 'Bisnis Ritel',
                                'dkv1' => 'Desain Komunikasi visual 1',
                                'dkv2' => 'Desain Komunikasi visual 2',
                                'rpl' => 'Rekayasa Perangkat Lunak',
                                'mp' => 'Manajemen Perkantoran',
                                'ak' => 'Akuntansi',
                            }],
                            ['icon' => 'gender-ambiguous', 'label' => 'Jenis Kelamin', 'value' => ucfirst($siswa->jenis_kelamin)],
                            ['icon' => 'geo-alt', 'label' => 'Alamat', 'value' => $siswa->alamat],
                        ] as $field)
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 h-100 bg-light border shadow-sm hover-lift">
                                    <div class="text-muted small fw-medium mb-1">
                                        <i class="bi bi-{{ $field['icon'] }} me-2"></i>{{ $field['label'] }}
                                    </div>
                                    <div class="fw-bold fs-5 text-dark">{{ $field['value'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.bg-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}
.hover-lift {
    transition: all 0.2s ease;
    background: white !important;
}
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08) !important;
}
</style>
@endsection
