<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, ShouldAutoSize, WithHeadings
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
            'Nama Meja', // Change 'table_name' to 'Table Name' here
            'Waktu Mulai',
            'Waktu Selesai',
            "Nama Pemesan",
            'Total Pelanggan',
        ];
    }
}
