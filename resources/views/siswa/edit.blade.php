@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-gradient">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="bi bi-pencil-square me-2"></i>Edit Siswa
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

                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nis" class="form-label"><i class="bi bi-hash me-1"></i> NIS</label>
                            <input type="number" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label"><i class="bi bi-person me-1"></i> Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label"><i class="bi bi-mortarboard me-1"></i> Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <option value="10" {{ $siswa->kelas == '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ $siswa->kelas == '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ $siswa->kelas == '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label"><i class="bi bi-book me-1"></i> Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="br" {{ $siswa->jurusan == 'br' ? 'selected' : '' }}>Bisnis Ritel (BR)</option>
                                <option value="dkv1" {{ $siswa->jurusan == 'dkv1' ? 'selected' : '' }}>Desain Komunikasi Visual 1 (DKV 1)</option>
                                <option value="dkv2" {{ $siswa->jurusan == 'dkv2' ? 'selected' : '' }}>Desain Komunikasi Visual 2 (DKV 2)</option>
                                <option value="rpl" {{ $siswa->jurusan == 'rpl' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                <option value="mp" {{ $siswa->jurusan == 'mp' ? 'selected' : '' }}>Manajemen Perkantoran (MP)</option>
                                <option value="ak" {{ $siswa->jurusan == 'ak' ? 'selected' : '' }}>Akuntansi (AK)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block"><i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin</label>
                            <div class="d-flex gap-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-male" value="laki-laki" {{ $siswa->jenis_kelamin == 'laki-laki' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="gender-male">
                                        <i class="bi bi-gender-male text-primary"></i> Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-female" value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="gender-female">
                                        <i class="bi bi-gender-female text-danger"></i> Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label"><i class="bi bi-geo-alt me-1"></i> Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required>{{ $siswa->alamat }}</textarea>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
