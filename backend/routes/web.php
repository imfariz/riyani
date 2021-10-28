<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')
    ->group( function() {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/{id}/set-status', [TransactionController::class, 'setStatus'])->name('transactions.status');
        // Route::get('product', [ProductController::class, 'index'])->name('product');
        Route::resource('product', ProductController::class);
        Route::resource('transactions', TransactionController::class);
    });