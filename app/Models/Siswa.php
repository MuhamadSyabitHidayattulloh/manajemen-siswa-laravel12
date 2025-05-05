<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'jenis_kelamin',
        'alamat',
    ];

    public function scopeSearch($query, $filters)
    {
        return $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nis', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        })
        ->when($filters['kelas'] ?? false, function ($query, $kelas) {
            $query->where('kelas', $kelas);
        })
        ->when($filters['jurusan'] ?? false, function ($query, $jurusan) {
            $query->where('jurusan', $jurusan);
        })
        ->when($filters['jenis_kelamin'] ?? false, function ($query, $jenis_kelamin) {
            $query->where('jenis_kelamin', $jenis_kelamin);
        });
    }
}
