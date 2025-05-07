@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary bg-gradient p-3">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-person-plus-fill me-2"></i>Tambah Siswa Baru
                        </h4>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Error!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('siswa.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="nis" name="nis" required>
                                    <label for="nis"><i class="bi bi-hash"></i> NIS</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    <label for="nama"><i class="bi bi-person"></i> Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="kelas" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="10">Kelas 10</option>
                                        <option value="11">Kelas 11</option>
                                        <option value="12">Kelas 12</option>
                                    </select>
                                    <label for="kelas"><i class="bi bi-mortarboard"></i> Kelas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="jurusan" name="jurusan" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="br">Bisnis Ritel (BR)</option>
                                        <option value="dkv1">Desain Komunikasi Visual 1 (DKV 1)</option>
                                        <option value="dkv2">Desain Komunikasi Visual 2 (DKV 2)</option>
                                        <option value="rpl">Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="mp">Manajemen Perkantoran (MP)</option>
                                        <option value="ak">Akuntansi (AK)</option>
                                    </select>
                                    <label for="jurusan"><i class="bi bi-book"></i> Jurusan</label>
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                    <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-3">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-1"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
