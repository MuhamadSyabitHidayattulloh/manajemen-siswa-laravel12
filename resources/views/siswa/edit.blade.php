@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header p-4 position-relative" 
                     style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%)">
                    <div class="d-flex justify-content-between align-items-center position-relative z-1">
                        <div>
                            <h4 class="text-white mb-1">
                                <i class="bi bi-pencil-square me-2"></i>Edit Siswa
                            </h4>
                            <div class="text-white-50">NIS: {{ $siswa->nis }}</div>
                        </div>
                        <a href="{{ route('siswa.index') }}"
                           class="btn btn-outline-light px-3">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    <div class="position-absolute top-50 end-0 translate-middle-y opacity-25">
                        <i class="bi bi-pencil-square display-1 text-white"></i>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                            <div class="d-flex gap-3">
                                <div class="alert-icon">
                                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="alert-heading mb-1">Oops! Ada beberapa kesalahan</h6>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            @foreach([
                                ['name' => 'nis', 'icon' => 'hash', 'label' => 'NIS', 'type' => 'number', 'value' => $siswa->nis],
                                ['name' => 'nama', 'icon' => 'person', 'label' => 'Nama', 'type' => 'text', 'value' => $siswa->nama],
                            ] as $field)
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="{{ $field['type'] }}" 
                                               class="form-control bg-body-tertiary border-0 shadow-sm"
                                               id="{{ $field['name'] }}" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ $field['value'] }}"
                                               required>
                                        <label for="{{ $field['name'] }}">
                                            <i class="bi bi-{{ $field['icon'] }}"></i> {{ $field['label'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-body-tertiary border-0 shadow-sm" id="kelas" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach(['10', '11', '12'] as $kelas)
                                            <option value="{{ $kelas }}" {{ $siswa->kelas == $kelas ? 'selected' : '' }}>
                                                Kelas {{ $kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="kelas"><i class="bi bi-mortarboard"></i> Kelas</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-body-tertiary border-0 shadow-sm" id="jurusan" name="jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        @php
                                            $jurusanList = [
                                                'br' => 'Bisnis Ritel (BR)',
                                                'dkv1' => 'Desain Komunikasi Visual 1 (DKV 1)',
                                                'dkv2' => 'Desain Komunikasi Visual 2 (DKV 2)',
                                                'rpl' => 'Rekayasa Perangkat Lunak (RPL)',
                                                'mp' => 'Manajemen Perkantoran (MP)',
                                                'ak' => 'Akuntansi (AK)'
                                            ];
                                        @endphp
                                        @foreach($jurusanList as $key => $label)
                                            <option value="{{ $key }}" {{ $siswa->jurusan == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="jurusan"><i class="bi bi-book"></i> Jurusan</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-body-tertiary rounded-3 shadow-sm h-100">
                                    <label class="form-label mb-3"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</label>
                                    <div class="d-flex gap-4">
                                        @foreach([
                                            ['id' => 'gender-male', 'value' => 'laki-laki', 'icon' => 'gender-male', 'label' => 'Laki-laki', 'color' => 'primary'],
                                            ['id' => 'gender-female', 'value' => 'perempuan', 'icon' => 'gender-female', 'label' => 'Perempuan', 'color' => 'danger']
                                        ] as $gender)
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="jenis_kelamin" 
                                                       id="{{ $gender['id'] }}" 
                                                       value="{{ $gender['value'] }}"
                                                       {{ $siswa->jenis_kelamin == $gender['value'] ? 'checked' : '' }}
                                                       required>
                                                <label class="form-check-label" for="{{ $gender['id'] }}">
                                                    <i class="bi bi-{{ $gender['icon'] }} text-{{ $gender['color'] }}"></i>
                                                    {{ $gender['label'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control bg-body-tertiary border-0 shadow-sm" 
                                              id="alamat" 
                                              name="alamat" 
                                              style="height: 100px"
                                              required>{{ $siswa->alamat }}</textarea>
                                    <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-light shadow-sm px-4">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary shadow px-4">
                                <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
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

.form-floating > label {
    padding-left: 1rem;
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
