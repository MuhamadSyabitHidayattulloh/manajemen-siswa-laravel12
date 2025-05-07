@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary bg-gradient p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-person-badge-fill me-2"></i>Detail Siswa
                        </h4>
                        <div class="btn-group">
                            <a href="{{ route('siswa.edit', $siswa->id) }}"
                               class="btn btn-light btn-sm"
                               data-bs-toggle="tooltip"
                               title="Edit Siswa">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="{{ route('siswa.index') }}"
                               class="btn btn-outline-light btn-sm"
                               data-bs-toggle="tooltip"
                               title="Kembali ke Daftar">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
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
                                <div class="p-3 border rounded-3 h-100 bg-light">
                                    <div class="text-muted mb-1">
                                        <i class="bi bi-{{ $field['icon'] }} me-2"></i>{{ $field['label'] }}
                                    </div>
                                    <div class="fw-bold fs-5">{{ $field['value'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
