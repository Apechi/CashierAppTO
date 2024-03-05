<?php

namespace App\Livewire\Transaction;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Type;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mockery\Undefined;
use PHPUnit\TestRunner\TestResult\Collector;

class Index extends Component
{

    use WithPagination;
    use LivewireAlert;

    //Menu List
    public Collection $types;

    public $search;
    public $kategori_id = 0;
    public $type_id = 0;


    //Shopping Cart
    public $qty = 0;
    public $produk_detail = [];
    public $stokBeak;

    //Checkout
    public $total_price;
    public $no_faktur;
    public $tipe_pembayaran;
    public $keterangan_pembayaran;
    public $tanggal;
    public $total_bayar;
    public $customer_id;
    public $kembalian;




    public function getTotalHarga()
    {

        $totalPrice = 0;

        foreach ($this->produk_detail as $produk) {
            $subTotal =  $produk['sub_total'];
            $totalPrice += $subTotal;
        }

        $this->total_price = $totalPrice;
    }

    public function setupCheckout()
    {

        $this->getTotalHarga();

        $no_faktur = $this->generateCustomId();

        $this->no_faktur = $no_faktur;
    }


    public function checkout()
    {
        $rules = [
            'tanggal' => 'required|date',
            'total_price' => 'required|numeric',
            'tipe_pembayaran' => 'required|in:cash,debit',
            'keterangan_pembayaran' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
        ];

        if ($this->tipe_pembayaran == 'cash') {
            $rules['total_bayar'] = 'required|numeric|min:' . $this->total_price;
        }

        $this->validate($rules);

        $transactionData = [
            'id' => $this->no_faktur,
            'date' => $this->tanggal,
            'total_price' => $this->total_price,
            'payment_method' => $this->tipe_pembayaran,
            'keterangan' => $this->keterangan_pembayaran,
            'customer_id' => $this->customer_id
        ];

        Transaction::create($transactionData);

        foreach ($this->produk_detail as $produk) {
            $subtractQty = $produk['qty'];

            DB::beginTransaction();
            try {
                $transactionDetailData = [
                    'menu_id' => $produk['id'],
                    'transaction_id' => $this->no_faktur,
                    'qty' => $produk['qty'],
                    'unitPrice' => $produk['price'],
                    'subTotal' => $produk['sub_total']
                ];

                TransactionDetail::create($transactionDetailData);

                Stock::where('menu_id', $produk['id'])->update([
                    'quantity' => DB::raw("quantity - $subtractQty")
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }


        $this->alert('success', 'Transaksi Berhasil', [
            'position' => 'center',
            'toast' => true,
            'timer' => 99999999,
            'showConfirmButton' => true,
            'onConfirmed' => "transactionDialogTrue",
            'confirmButtonText' => 'Nota Faktur',
            'showCancelButton' => true,
            'onDismissed' => "transactionDialogFalse",
            'cancelButtonText' => 'Ok',

        ]);


        // $this->dispatch('transactionDialogTrue');
    }



    #[On('transactionDialogFalse')]
    public function rFalse()
    {
        redirect(route('transaction.index'));
    }






    public function kembalianGen()
    {

        if ($this->total_bayar >= $this->total_price) {
            $totalKembalian =    $this->total_bayar - $this->total_price;
            $this->kembalian = $totalKembalian;
        } else {
            $this->kembalian = 'Pembayaran Kurang!';
        }
    }

    public function mount()
    {
    }


    public function changeKategori($id)
    {
        $this->kategori_id = $id;
        $this->type_id = 0;
    }

    public function changeTipe($id)
    {
        $this->type_id = $id;
    }


    public function pilihMenu($id)
    {

        $produkIds = collect($this->produk_detail)->pluck('id');

        $menu = Menu::findOrFail($id);
        $stok = Stock::where('menu_id', $id)->first();


        if ($produkIds->contains($id)) {
            $index = $produkIds->search($id);

            if ($this->produk_detail[$index]['qty'] >= $stok->quantity) {
                $this->stokBeak = $id;
                $this->addError('stok-habis', "Stok tidak mencukupi");
            } else {

                $this->produk_detail[$index]['qty']++;
            }


            $this->subTotalChange($index);
        } else {
            $data = [
                'id' => $menu->id,
                'image' => $menu->image,
                'name' => $menu->name,
                'price' => $menu->price,
                'sub_total' => $menu->price,
                'qty' => 1,
            ];

            $this->produk_detail[] = $data;
        }

        $this->getTotalHarga();
    }



    public function subTotalChange($index)
    {

        $price =  $this->produk_detail[$index]['price'];
        $qty = $this->produk_detail[$index]['qty'];

        $this->produk_detail[$index]['sub_total'] = $price * $qty;
    }

    public function increaseQuantity($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');
        $index = $produkIds->search($id);

        $stok = Stock::where('menu_id', $id)->first();


        if ($this->produk_detail[$index]['qty'] >= $stok->quantity) {
            $this->stokBeak = $id;
            $this->addError('stok-habis', "Stok tidak mencukupi");
        } else {
            $this->produk_detail[$index]['qty']++;
        }

        $this->subTotalChange($index);
        $this->getTotalHarga();
    }

    public function clearOrder()
    {
        $this->produk_detail = [];
    }

    public function decreaseQuantity($id)
    {
        $produkIds = collect($this->produk_detail)->pluck('id');
        $index = $produkIds->search($id);

        if ($index !== false && array_key_exists($index, $this->produk_detail)) {
            $this->produk_detail[$index]['qty']--;

            if ($this->produk_detail[$index]['qty'] <= 0) {
                unset($this->produk_detail[$index]);
                $this->produk_detail = array_values($this->produk_detail);
            } else {
                $this->subTotalChange($index);
            }
        }

        $this->getTotalHarga();
    }



    public function render()
    {
        $categories = Category::all();
        $customer = Customer::all();

        if ($this->kategori_id != 0) {
            $type =  Type::where('category_id', $this->kategori_id)->get();
            $this->types = $type;
        }

        if ($this->type_id != 0) {
            $produk = Menu::where('name', 'like', '%' . $this->search . '%')
                ->where('type_id', $this->type_id)
                ->simplePaginate(15);
        } else {
            $produk = Menu::where('name', 'like', '%' . $this->search . '%')
                ->with('stocks')
                ->simplePaginate(15);
        }
        return view('livewire.transaction.index', compact('categories', 'customer', 'produk'));
    }

    public function generateCustomId()
    {
        $today = now()->format('Ymd');
        $lastCustomId = Transaction::where('date', $today)->orderBy('id', 'desc')->first();



        if ($lastCustomId) {
            $lastId = substr($lastCustomId->id, -4);
            $newId = $today . str_pad((intval($lastId) + 1), 4, '0', STR_PAD_LEFT);
        } else {
            $newId = $today . '0001';
        }

        return $newId;
    }
}
