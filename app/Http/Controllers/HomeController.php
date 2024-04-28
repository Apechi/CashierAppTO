<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        //jumlah data menu
        $jumlahMenu = Menu::all()->count();

        //jumlah data pelanggan

        $jumlahPelanggan = Customer::all()->count();

        //jumlah data transaksi
        $jumlahTransaksi = Transaction::all()->count();

        //jumlah data transaksi pertanggal
        $jumlahTransaksiPertanggal = Transaction::where('date', date('Y-m-d'))->count();

        //10 transaksi terakhir
        $transaksiTerakhir = Transaction::orderBy('date', 'desc')->take(10)->get();

        //totalPendapatan
        $totalPendapatan = Transaction::all()->sum('total_price');

        $totalPendapatanPertanggal = Transaction::where('date', date('Y-m-d'))->sum('total_price');

        //menu paling laku dari detail transaksi 
        $menuPalingLaku = TransactionDetail::select('menu_id', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_id')
            ->orderByDesc('total')
            ->first();
        $menuPalingLaku = Menu::find($menuPalingLaku->menu_id);

        //total pendapatan perhari
        $totalPendapatanPerhari = Transaction::where('date', date('Y-m-d'))->sum('total_price');

        //stokhampirhabis
        $menusWithLowStock = Menu::whereHas('stocks', function ($query) {
            $query->where('quantity', '<', 10);
        })->get();



        $totalPendapatanPerMinggu = $this->showChart();


        return view('home', compact('jumlahMenu', 'jumlahPelanggan', 'jumlahTransaksi', 'jumlahTransaksiPertanggal', 'transaksiTerakhir', 'totalPendapatan', 'totalPendapatanPertanggal', 'menuPalingLaku', 'menusWithLowStock', 'totalPendapatanPerMinggu'));
    }

    public function tampilkanGrafik(): array
    {
        $bulanSaatIni = date('m');
        $tahunSaatIni = date('Y');

        $jumlahMinggu = ceil(date('t') / 7);
        $totalPendapatanPerMinggu = [];

        for ($minggu = 1; $minggu <= $jumlahMinggu; $minggu++) {
            $tanggalAwalMinggu = date('Y-m-d', strtotime("$tahunSaatIni-$bulanSaatIni-01 +" . ($minggu - 1) . " weeks"));
            $tanggalAkhirMinggu = date('Y-m-d', strtotime("$tanggalAwalMinggu +6 days"));
            $totalPendapatan = Transaction::whereBetween('date', [$tanggalAwalMinggu, $tanggalAkhirMinggu])->sum('total_price');
            $totalPendapatanPerMinggu["Minggu ke $minggu"] = $totalPendapatan;
        }

        return $totalPendapatanPerMinggu;
    }
}
