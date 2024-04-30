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

        $transaksiTerakhir = Transaction::with('transactionDetails')->orderBy('created_at', 'desc')->take(10)->get();

        $transaksiTerbaru = [];

        foreach ($transaksiTerakhir as $transaction) {
            $menuList = [];

            foreach ($transaction->transactionDetails as $detail) {
                $menuList[] = $detail->menu->name;
            }

            $transaksiTerbaru[] = [
                'id' => $transaction->id,
                'list_menu' => $menuList,
                'total' => $transaction->total_price,
            ];
        }

        //totalPendapatan
        $totalPendapatan = Transaction::all()->sum('total_price');

        $totalPendapatanPertanggal = Transaction::where('date', date('Y-m-d'))->sum('total_price');

        $menuPalingLaku = TransactionDetail::select('menu_id', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $menuData = [];

        foreach ($menuPalingLaku as $detail) {
            $menu = Menu::find($detail->menu_id);

            if ($menu) {
                $menuData[] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'image' => $menu->image,
                    'total' => $detail->total

                ];
            }
        }



        //total pendapatan perhari
        $totalPendapatanPerhari = Transaction::where('date', date('Y-m-d'))->sum('total_price');

        //stokhampirhabis
        $menusWithLowStock = Menu::whereHas('stocks', function ($query) {
            $query->where('quantity', '<', 10);
        })->get();



        $bulanSaatIni = date('m');
        $totalPendapatanPerHari = $this->tampilkanGrafik($bulanSaatIni);


        return view('home', compact('jumlahMenu', 'jumlahPelanggan', 'jumlahTransaksi', 'jumlahTransaksiPertanggal', 'transaksiTerakhir', 'totalPendapatan', 'totalPendapatanPertanggal', 'menuPalingLaku', 'menusWithLowStock', 'totalPendapatanPerHari', 'menuData', 'transaksiTerbaru', 'bulanSaatIni'));
    }
    public function tampilkanGrafik($bulan): array
    {
        $tahunSaatIni = date('Y');
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahunSaatIni);
        $totalPendapatanPerHari = [];

        for ($hari = 1; $hari <= $jumlahHari; $hari++) {
            $tanggalSaatIni = date('d/m', strtotime("$tahunSaatIni-$bulan-$hari"));
            $totalPendapatan = Transaction::where('date', "$tahunSaatIni-$bulan-$hari")->sum('total_price');
            $totalPendapatanPerHari[$tanggalSaatIni] = $totalPendapatan;
        }

        return $totalPendapatanPerHari;
    }


    public function totalTransaksi(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $totalTransaksi = Transaction::whereBetween('date', [$tanggalMulai, $tanggalSelesai])->count();

        return response()->json([
            'total_transaksi' => $totalTransaksi,
        ]);
    }
    public function totalPendapatan(Request $request)
    {
        $year = date('Y');
        $month = $request->input('bulan');
        $month_padded = str_pad($month, 2, '0', STR_PAD_LEFT);
        $full_date = "$year-$month_padded";

        $totalPendapatan = Transaction::where('date', 'LIKE', "$full_date%")->sum('total_price');

        return response()->json([
            'total_pendapatan' => $totalPendapatan,
            'month' => $month_padded,
        ]);
    }

    public function totalPendapatanBetween(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $totalPendapatan = Transaction::whereBetween('date', [$tanggalMulai, $tanggalSelesai])->sum('total_price');

        return response()->json([
            'total_pendapatan' => $totalPendapatan,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
        ]);
    }

    public function tampilkanGrafikBetween($tanggalMulai, $tanggalSelesai): array
    {
        $totalPendapatanPerHari = [];

        $tanggalSekarang = $tanggalMulai;
        while ($tanggalSekarang <= $tanggalSelesai) {
            $tanggalFormat = date('d/m', strtotime($tanggalSekarang));
            $totalPendapatan = Transaction::where('date', $tanggalSekarang)->sum('total_price');
            $totalPendapatanPerHari[$tanggalFormat] = $totalPendapatan;
            $tanggalSekarang = date('Y-m-d', strtotime($tanggalSekarang . ' +1 day'));
        }

        return $totalPendapatanPerHari;
    }



    public function getDataChart(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $data = $this->tampilkanGrafikBetween($tanggalMulai, $tanggalSelesai);
        return response()->json($data);
    }
}
