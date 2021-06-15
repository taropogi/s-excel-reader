<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CustomerSkuController;

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
})->middleware('guest');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/logs', [LogController::class, 'index'])->name('logs');

Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerSKU', [CustomerSkuController::class, 'index'])->name('customer_sku');
Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerSKU/records', [CustomerSkuController::class, 'all_data'])->name('customer_sku.all_data');
