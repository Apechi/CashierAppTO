<?php

namespace App\Exports;

use App\Models\Table;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MejaExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Table::all()->map(function ($table) {
            return [
                'Nomor Meja' => $table->table_number,
                'Kapasitas' => $table->capacity,
                'Status' => $table->status,
                'Jumlah Pemesanan' => $table->bookings->count(),
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
            'Nomor Meja',
            'Kapasitas',
            'Status',
            'Jumlah Pemesanan',
        ];
    }
}
