<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AbsensiKaryawanExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::all()->map(function ($absensi) {
            return [
                'Tanggal' => $absensi->tanggalMasuk,
                'Nama Karyawan' => $absensi->namaKaryawan,
                'Waktu Masuk' => $absensi->waktuMasuk,
                'Waktu Keluar' => $absensi->waktuKeluar,
                'Status' => $absensi->status,
            ];
        });
    }

    /**
     * Customize the headers for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Karyawan',
            'Waktu Masuk',
            'Waktu Keluar',
            'Status',
        ];
    }

    /**
     * Set the title for the export.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Data Absensi Karyawan';
    }

    /**
     * Apply styles to the export.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        // Define the border style
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];

        // Apply the yellow background to the header row
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFF00']],
        ]);

        // Apply the border style to all cells starting from the second row (below the title)
        $sheet->getStyle('A2:E' . $sheet->getHighestRow())->applyFromArray($borderStyle);

        return [];
    }
}
