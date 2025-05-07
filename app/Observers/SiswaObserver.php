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

    private function clearCache()
    {
        Cache::forget('siswa_stats');
        Cache::forget('siswa_list');
    }
}
