<?php

namespace App\Observers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Cache;

class SiswaObserver
{
    public function created(Siswa $siswa)
    {
        $this->clearCache();
    }

    public function updated(Siswa $siswa)
    {
        $this->clearCache();
    }

    public function deleted(Siswa $siswa)
    {
        $this->clearCache();
    }

    public function restored(Siswa $siswa)
    {
        $this->clearCache();
    }

    public function forceDeleted(Siswa $siswa)
    {
        $this->clearCache();
    }

    private function clearCache()
    {
        // Clear using cache tags
        Cache::tags(['siswa', 'statistics'])->flush();

        // Clear specific caches that might not be tagged
        $keysToForget = [
            'siswa_stats',
            'total_siswa',
            'total_by_gender',
            'total_by_jurusan',
            'total_by_kelas',
        ];

        foreach ($keysToForget as $key) {
            Cache::forget($key);
        }
    }
}
