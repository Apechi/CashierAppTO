<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TryoutExController;
use App\Models\ProdukTitipan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('types', TypeController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('tables', TableController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('users', UserController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('menus', MenuController::class);
        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/index', [TransactionController::class, 'listTransaksi'])->name('transaction.listTransaksi');
        Route::get('transaksi/invoice/{id}', [TransactionController::class, 'notaFaktur']);
        Route::get('transaction/show/{id}', [TransactionController::class, 'show']);

        //TO Exclusive
        Route::resource('titipan', ProdukTitipanController::class);


        //Excel Export


        Route::get('type/export/', [TypeController::class, 'exportExcel']);

        Route::get('category/export/', [CategoryController::class, 'exportExcel']);

        Route::get('menu/export/', [MenuController::class, 'exportExcel']);
        Route::get('stok/export/', [StockController::class, 'exportExcel']);
        Route::get('table/export/', [TableController::class, 'exportExcel']);
        Route::get('customer/export/', [CustomerController::class, 'exportExcel']);

        Route::get('booking/export/', [BookingController::class, 'exportExcel']);

        Route::get('/listTransaction/export/', [TransactionController::class, 'exportExcel']);
        Route::get('user/export/', [UserController::class, 'exportExcel']);

        Route::get('produktitip/export', [ProdukTitipanController::class, 'export']);

        //Excel Import

        Route::post('produktitip/import', [ProdukTitipanController::class, 'import']);
        
        Route::get('category/import', [CategoryController::class, 'import']);
        Route::get('tipemenu/import', [TypeController::class, 'import']);
        Route::get('menu/import', [MenuController::class, 'import']);
        Route::get('stok/import', [StockController::class, 'import']);
        Route::get('meja/import', [TableController::class, 'import']);
        Route::get('pelanggan/import', [CustomerController::class, 'import']);
        Route::get('pemesanan/import', [BookingController::class, 'import']);



        // PDF Export

        Route::get('category/exportpdf', [CategoryController::class, 'exportpdf']);
        Route::get('tipemenu/exportpdf', [TypeController::class, 'exportpdf']);
        Route::get('menu/exportpdf', [MenuController::class, 'exportpdf']);
        Route::get('stok/exportpdf', [StockController::class, 'exportpdf']);
        Route::get('meja/exportpdf', [TableController::class, 'exportpdf']);
        Route::get('produktitip/exportpdf', [ProdukTitipanController::class, 'exportpdf']);
        Route::get('pelanggan/exportpdf', [CustomerController::class, 'exportpdf']);
        Route::get('pemesanan/exportpdf', [BookingController::class, 'exportpdf']);
        Route::get('pengguna/exportpdf', [UserController::class, 'exportpdf']);
        Route::get('transaksilist/exportpdf', [TransactionController::class, 'exportpdf']);
        // Route::get('produktitip/exportpdf', [ProdukTitipanController::class, 'exportpdf']);
        // Route::get('produktitip/exportpdf', [ProdukTitipanController::class, 'exportpdf']);

        //TO Exclusive
    });

//TO Exclusive
Route::get('tentang', [TryoutExController::class, 'about']);
Route::get('layanan', [TryoutExController::class, 'layanan']);
