<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all()->map(function ($customer) {
            return [
                'Nama' => $customer->name,
                'Email' => $customer->email,
                'Nomor Telepon' => $customer->no_telp,
                'Alamat' => $customer->address,
                'Jumlah Transaksi' => $customer->transactions->count(),
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
            'Nomor Telepon',
            'Alamat',
            'Jumlah Transaksi',
        ];
    }
}
