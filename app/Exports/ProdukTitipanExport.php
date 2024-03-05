<?php

namespace App\Exports;

use App\Models\ProdukTitipan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ProdukTitipanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return ProdukTitipan::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Nama Supplier',
            'Harga Beli',
            'Harga Jual',
            'Stok',
            'Keterangan',
        ];
    }
}
