<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SiswaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Siswa::search($this->filters)->get();
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Kelas',
            'Jurusan',
            'Jenis Kelamin',
            'Alamat'
        ];
    }

    public function map($siswa): array
    {
        $jurusanMap = [
            'br' => 'Bisnis Ritel',
            'dkv1' => 'Desain Komunikasi Visual 1',
            'dkv2' => 'Desain Komunikasi Visual 2',
            'rpl' => 'Rekayasa Perangkat Lunak',
            'mp' => 'Manajemen Perkantoran',
            'ak' => 'Akuntansi'
        ];

        return [
            $siswa->nis,
            $siswa->nama,
            'Kelas ' . $siswa->kelas,
            $jurusanMap[$siswa->jurusan] ?? $siswa->jurusan,
            ucfirst($siswa->jenis_kelamin),
            $siswa->alamat
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E9ECEF']
                ]
            ],
            'A1:F'.$sheet->getHighestRow() => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}
