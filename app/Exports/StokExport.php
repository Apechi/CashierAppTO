<?php

namespace App\Exports;

use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Stock::all()->map(function ($stock) {
            return [
                'Jumlah' => $stock->quantity,
                'Menu' => $stock->menu->name,
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
            'Jumlah',
            'Menu',
        ];
    }
}
