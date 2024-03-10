<?php

namespace App\Exports;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;


class MenuExport implements FromCollection, ShouldAutoSize, WithHeadings, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Menu::all()->map(function ($menu) {
            return [
                'Nama' => $menu->name,
                'Harga' => $menu->price,
                'Deskripsi' => $menu->description,
                'Tipe' => $menu->type->name,
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
            'Nama',
            'Harga',
            'Deskripsi',
            'Tipe',
        ];
    }

    /**
     * Add images to the Excel file.
     *
     * @return array
     */
    public function drawings()
    {
        $drawings = [];

        $menus = Menu::all();
        foreach ($menus as $menu) {
            $imagePath = public_path('images/' . $menu->image); // Assuming images are stored in the public directory
            if (file_exists($imagePath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName($menu->name)
                    ->setDescription($menu->name)
                    ->setPath($imagePath)
                    ->setHeight(120); // Set the height of the image as needed
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
