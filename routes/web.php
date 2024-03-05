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
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

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

Route::get('/tes', function () {
    return view('appLayout.app');
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

        //Excel Export

        Route::get('type/export/', [TypeController::class, 'exportExcel']);
        Route::get('category/export/', [CategoryController::class, 'exportExcel']);
        Route::get('menu/export/', [MenuController::class, 'exportExcel']);
        Route::get('stok/export/', [StockController::class, 'exportExcel']);
        Route::get('table/export/', [TableController::class, 'exportExcel']);
        Route::get('customer/export/', [CustomerController::class, 'exportExcel']);
        Route::get('booking/export/', [BookingController::class, 'exportExcel']);
        Route::get('listTransaction/export/', [TransactionController::class, 'exportExcel']);
        Route::get('user/export/', [UserController::class, 'exportExcel']);
        Route::get('role/export/', [RoleController::class, 'exportExcel']);
        Route::get('permission/export/', [PermissionController::class, 'exportExcel']);
    });
