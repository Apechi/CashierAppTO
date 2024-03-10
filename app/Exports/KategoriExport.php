<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::all()->map(function ($category) {
            return [
                'Icon' => $category->icon,
                'Nama' => $category->name,
                'Jumlah Tipe' => $category->types->count(),
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
            'Icon',
            'Nama',
            'Jumlah Tipe',
        ];
    }
}
