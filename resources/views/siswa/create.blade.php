@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-person-plus-fill me-2"></i>Tambah Siswa Baru
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nis" class="form-label"><i class="bi bi-hash me-1"></i> NIS</label>
                            <input type="number" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label"><i class="bi bi-person me-1"></i> Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label"><i class="bi bi-mortarboard me-1"></i> Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label"><i class="bi bi-book me-1"></i> Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="br">Bisnis Ritel (BR)</option>
                                <option value="dkv1">Desain Komunikasi Visual 1 (DKV 1)</option>
                                <option value="dkv2">Desain Komunikasi Visual 2 (DKV 2)</option>
                                <option value="rpl">Rekayasa Perangkat Lunak (RPL)</option>
                                <option value="mp">Manajemen Perkantoran (MP)</option>
                                <option value="ak">Akuntansi (AK)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label"><i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label"><i class="bi bi-geo-alt me-1"></i> Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary text-white">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
