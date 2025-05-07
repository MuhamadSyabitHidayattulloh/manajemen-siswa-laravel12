@extends('layouts.app')

@section('title', 'Tambah Siswa')

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
                                <i class="bi bi-person-plus-fill me-2"></i>Tambah Siswa
                            </h4>
                            <div class="text-white-50">Silakan lengkapi form di bawah ini</div>
                        </div>
                        <a href="{{ route('siswa.index') }}"
                           class="btn btn-outline-light px-3">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    <div class="position-absolute top-50 end-0 translate-middle-y opacity-25">
                        <i class="bi bi-person-plus display-1 text-white"></i>
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

                    <form action="{{ route('siswa.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           id="nis" 
                                           name="nis" 
                                           placeholder="NIS"
                                           value="{{ old('nis') }}"
                                           required>
                                    <label for="nis"><i class="bi bi-hash me-1"></i>NIS</label>
                                    <div class="invalid-feedback">
                                        Mohon masukkan NIS siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" 
                                           class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           id="nama" 
                                           name="nama" 
                                           placeholder="Nama"
                                           value="{{ old('nama') }}"
                                           required>
                                    <label for="nama"><i class="bi bi-person me-1"></i>Nama</label>
                                    <div class="invalid-feedback">
                                        Mohon masukkan nama siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control form-control-lg bg-light border-0 shadow-sm" id="kelas" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="10">Kelas 10</option>
                                        <option value="11">Kelas 11</option>
                                        <option value="12">Kelas 12</option>
                                    </select>
                                    <label for="kelas"><i class="bi bi-mortarboard"></i> Kelas</label>
                                    <div class="invalid-feedback">
                                        Mohon pilih kelas siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control form-control-lg bg-light border-0 shadow-sm" id="jurusan" name="jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="br">Bisnis Ritel (BR)</option>
                                        <option value="dkv1">Desain Komunikasi Visual 1 (DKV 1)</option>
                                        <option value="dkv2">Desain Komunikasi Visual 2 (DKV 2)</option>
                                        <option value="rpl">Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="mp">Manajemen Perkantoran (MP)</option>
                                        <option value="ak">Akuntansi (AK)</option>
                                    </select>
                                    <label for="jurusan"><i class="bi bi-book"></i> Jurusan</label>
                                    <div class="invalid-feedback">
                                        Mohon pilih jurusan siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-block"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</label>
                                    <div class="d-flex gap-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-male" value="laki-laki" required>
                                            <label class="form-check-label" for="gender-male">
                                                <i class="bi bi-gender-male text-primary"></i> Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-female" value="perempuan" required>
                                            <label class="form-check-label" for="gender-female">
                                                <i class="bi bi-gender-female text-danger"></i> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Mohon pilih jenis kelamin siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control form-control-lg bg-light border-0 shadow-sm" id="alamat" name="alamat" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                    <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                                    <div class="invalid-feedback">
                                        Mohon masukkan alamat siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-4">
                                        <i class="bi bi-save me-2"></i>Simpan Data
                                    </button>
                                </div>
                            </div>
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
