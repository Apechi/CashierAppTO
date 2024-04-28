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
        $transaksiTerakhir = Transaction::orderBy('created_at', 'desc')->take(10)->get();

        //totalPendapatan
        $totalPendapatan = Transaction::all()->sum('total_price');

        $totalPendapatanPertanggal = Transaction::where('date', date('Y-m-d'))->sum('total_price');

        //menu paling laku dari detail transaksi 
        $menuPalingLaku = TransactionDetail::select('menu_id', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_id')
            ->orderByDesc('total')
            ->first();
        $menuPalingLaku = Menu::find($menuPalingLaku->menu_id);

        //total pendapatan perbulan
        $totalPendapatanPerbulan = Transaction::select(DB::raw("MONTH('date') as bulan"), DB::raw("YEAR('date') as tahun"), DB::raw('SUM(total_price) as total'))
            ->groupBy('bulan', 'tahun')
            ->orderBy('bulan', 'asc')
            ->get();


        //stokhampirhabis
        $menusWithLowStock = Menu::whereHas('stocks', function ($query) {
            $query->where('quantity', '<', 10);
        })->get();



        return view('home', compact('jumlahMenu', 'jumlahPelanggan', 'jumlahTransaksi', 'jumlahTransaksiPertanggal', 'transaksiTerakhir', 'totalPendapatan', 'totalPendapatanPertanggal', 'menuPalingLaku', 'menusWithLowStock'));
    }
}
