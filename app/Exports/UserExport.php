<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all()->map(function ($user) {
            return [
                'Nama' => $user->name,
                'Email' => $user->email,
                'Role' => $user->roles->implode('name', ', '), // Assuming a user can have multiple roles
                'Super Admin' => $user->isSuperAdmin() ? 'Ya' : 'Tidak',
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
            'Email',
            'Role',
            'Super Admin',
        ];
    }
}
