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
        $produkTitipan = ProdukTitipan::latest()->get();


        $nambah = intval($this->harga_beli) * 70 / 100;

        $keuntungan = intval($this->harga_beli)  + $nambah;

        $this->harga_jual = ceil($keuntungan / 500) * 500;


        return view('livewire.t-o.titipan', compact('produkTitipan'));
    }


    public function resetField()
    {
        $this->nama_produk = null;
        $this->nama_supplier = null;
        $this->harga_beli = null;
        $this->harga_jual = null;
        $this->keuntungan = null;
        $this->keterangan = null;
        $this->stok = null;
        $this->produkTitipanId = null;
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
        $this->stok = $produkTitipan->stok;
    }


    #[On('edit_stok')]
    public function editStock($id, $stok)
    {

        $produkTitipan = ProdukTitipan::findOrFail($id);

        $produkTitipan->update([
            'stok' => $stok
        ]);

        redirect(route('titipan.index'));
    }



    public function store()
    {

        $rules = [
            'nama_produk' => 'required|string|max:255',
            'nama_supplier' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',

            'stok' => 'required|integer|min:0',
            'keterangan' => 'required|string',
        ];

        $this->validate($rules);

        ProdukTitipan::create([
            'nama_produk' => $this->nama_produk,
            'nama_supplier' => $this->nama_supplier,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->harga_jual,
            'keterangan' => $this->keterangan,
            'stok' => $this->stok
        ]);


        redirect(route('titipan.index'))->with('success', 'Berhasil Di Tambah');
    }




    public function update()
    {
        $rules = [
            'nama_produk' => 'required|string|max:255',
            'nama_supplier' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'required|string',
        ];

        $this->validate($rules);

        $produkTitipan = ProdukTitipan::findOrFail($this->produkTitipanId);

        $produkTitipan->update([
            'nama_produk' => $this->nama_produk,
            'nama_supplier' => $this->nama_supplier,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->harga_jual,
            'stok' => $this->stok,
            'keterangan' => $this->keterangan,
        ]);

        redirect(route('titipan.index'));
    }
}
