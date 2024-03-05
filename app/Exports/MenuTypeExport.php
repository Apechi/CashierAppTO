<?php

namespace App\Exports;

use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class MenuTypeExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Type::with('category')->get()->map(function ($type) {
            return [
                'Name' => $type->name,
                'Category' => $type->category->name, // Assuming 'name' is the attribute you want to export from Category
                // Add more columns if needed
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Category',
            // Add headings for additional columns if needed
        ];
    }

    /**
     * @return array
     */
}
