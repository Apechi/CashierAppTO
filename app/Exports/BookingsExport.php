<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BookingsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::all()->map(function ($booking) {
            return [
                'Tanggal' => $booking->date,
                'Nama Meja' => $booking->table->table_number,
                'Nama Pemesan' => $booking->bookers_name,
                'Waktu Mulai' => $booking->start_time,
                'Waktu Selesai' => $booking->end_time,
                'Total Pelanggan' => $booking->total_customer,
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
            'Nama Meja',
            'Waktu Mulai',
            'Waktu Selesai',
            "Nama Pemesan",
            'Total Pelanggan',
        ];
    }

    /**
     * Set the title for the export.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Data Booking';
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
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFF00']],
        ]);

        // Apply the border style to all cells starting from the second row (below the title)
        $sheet->getStyle('A2:F' . $sheet->getHighestRow())->applyFromArray($borderStyle);

        return [];
    }
}
