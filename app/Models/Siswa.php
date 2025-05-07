<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public static function getCachedStatistics()
    {
        return Cache::tags(['siswa', 'statistics'])->remember('siswa_stats', now()->addHours(24), function () {
            return [
                'totalSiswa' => self::count(),
                'totalLaki' => self::where('jenis_kelamin', 'laki-laki')->count(),
                'totalPerempuan' => self::where('jenis_kelamin', 'perempuan')->count(),
                'totalByJurusan' => self::selectRaw('jurusan, count(*) as total')
                    ->groupBy('jurusan')
                    ->pluck('total', 'jurusan')
                    ->toArray(),
                'totalByKelas' => self::selectRaw('kelas, count(*) as total')
                    ->groupBy('kelas')
                    ->pluck('total', 'kelas')
                    ->toArray(),
            ];
        });
    }

    public static function getCachedList($filters = [], $perPage = 15)
    {
        $cacheKey = 'siswa_list:' . md5(serialize($filters) . $perPage . request('page', 1));
        
        return Cache::tags(['siswa', 'lists'])->remember($cacheKey, now()->addMinutes(30), function () use ($filters, $perPage) {
            return self::search($filters)
                ->when(empty($filters['sort']), function ($query) {
                    $query->latest();
                })
                ->paginate($perPage)
                ->withQueryString();
        });
    }
}
