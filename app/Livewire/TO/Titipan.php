<?php

namespace App\Livewire\TO;

use App\Http\Requests\StoreProdukTitipanRequest;
use App\Models\ProdukTitipan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Titipan extends Component
{
    //InputVariables
    public $nama_produk, $nama_supplier, $harga_beli, $harga_jual, $keuntungan, $keterangan, $stok;
    public $produkTitipanId;



    public function render()
    {
        $produkTitipan = ProdukTitipan::all();


        $nambah = $this->harga_jual * 70 / 100;

        $keuntungan = $this->harga_jual + $nambah;

        $this->keuntungan = ceil($keuntungan / 500) * 500;


        return view('livewire.t-o.titipan', compact('produkTitipan'));
    }


    #[On('edit')]
    public function edit($id)
    {
        $produkTitipan = ProdukTitipan::findOrFail($id);

        $this->produkTitipanId = $produkTitipan->id;
        $this->nama_produk = $produkTitipan->nama_produk;
        $this->nama_supplier = $produkTitipan->nama_supplier;
        $this->harga_beli = $produkTitipan->harga_beli;
        $this->harga_jual = $produkTitipan->harga_jual;
        $this->keterangan = $produkTitipan->keterangan;
        $this->keuntungan = 0;
        $this->stok = $produkTitipan->stok;
    }


    #[On('edit_stok')]
    public function editStock($id, $stok)
    {


        $produkTitipan = ProdukTitipan::findOrFail($id);

        $produkTitipan->update([
            'stok' => $stok
        ]);
    }

    public function store()
    {

        $rules = [
            'nama_produk' => 'required|string|max:255',
            'nama_supplier' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'keuntungan' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'required|string',
        ];

        $this->validate($rules);

        ProdukTitipan::create([
            'nama_produk' => $this->nama_produk,
            'nama_supplier' => $this->nama_supplier,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->keuntungan,
            'keterangan' => $this->keterangan,
            'stok' => $this->stok
        ]);

        redirect(route('titipan.index'));
    }


    public function update()
    {
        $rules = [
            'nama_produk' => 'required|string|max:255',
            'nama_supplier' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'keuntungan' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'required|string',
        ];

        $this->validate($rules);

        $produkTitipan = ProdukTitipan::findOrFail($this->produkTitipanId);

        $produkTitipan->update([
            'nama_produk' => $this->nama_produk,
            'nama_supplier' => $this->nama_supplier,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->keuntungan,
            'stok' => $this->stok,
            'keterangan' => $this->keterangan,
        ]);

        redirect(route('titipan.index'));
    }
}
