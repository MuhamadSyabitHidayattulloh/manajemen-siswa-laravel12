<?php

namespace App\Exports;

use App\Models\Siswa;

class SiswaPDFExport 
{
    protected $siswa;

    public function __construct($filters)
    {
        $this->siswa = Siswa::search($filters)->get();
    }

    public function download()
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.siswa-pdf', [
            'siswa' => $this->siswa
        ]);
        
        return $pdf->download('daftar_siswa.pdf');
    }
}
