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

    public function scopeSearch($query, $filters = [])
    {
        return $query
            ->when(isset($filters['search']), function ($query) use ($filters) {
                $query->where(function ($query) use ($filters) {
                    $query->where('nis', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('nama', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('alamat', 'like', '%' . $filters['search'] . '%');
                });
            })
            ->when(isset($filters['kelas']), function ($query) use ($filters) {
                $query->where('kelas', $filters['kelas']);
            })
            ->when(isset($filters['jurusan']), function ($query) use ($filters) {
                $query->where('jurusan', $filters['jurusan']);
            })
            ->when(isset($filters['jenis_kelamin']), function ($query) use ($filters) {
                $query->where('jenis_kelamin', $filters['jenis_kelamin']);
            })
            ->when(isset($filters['sort']) && isset($filters['direction']), function ($query) use ($filters) {
                $query->orderBy($filters['sort'], $filters['direction']);
            });
    }
}
