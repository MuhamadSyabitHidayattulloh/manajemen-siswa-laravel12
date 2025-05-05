@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-person-badge-fill me-2"></i>Detail Siswa
                        </h4>
                        <div>
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-light btn-sm me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="{{ route('siswa.index') }}" class="btn btn-outline-light btn-sm text-white">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-hash me-2"></i>NIS:</div>
                        <div class="col-md-8">{{ $siswa->nis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-person me-2"></i>Nama:</div>
                        <div class="col-md-8">{{ $siswa->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-mortarboard me-2"></i>Kelas:</div>
                        <div class="col-md-8">{{ $siswa->kelas }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-book me-2"></i>Jurusan:</div>
                        <div class="col-md-8">
                            @switch($siswa->jurusan)
                                @case('br') Bisnis Ritel @break
                                @case('dkv1') Desain Komunikasi visual 1 @break
                                @case('dkv2') Desain Komunikasi visual 2 @break
                                @case('rpl') Rekayasa Perangkat Lunak @break
                                @case('mp') Manajemen Perkantoran @break
                                @case('ak') Akuntansi @break
                            @endswitch
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin:</div>
                        <div class="col-md-8">{{ ucfirst($siswa->jenis_kelamin) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold"><i class="bi bi-geo-alt me-2"></i>Alamat:</div>
                        <div class="col-md-8">{{ $siswa->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
