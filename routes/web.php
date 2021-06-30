<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CustomerSkuController;
use App\Http\Controllers\CustomerItemController;

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
    return redirect()->route('customer_sku');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerSKU', [CustomerSkuController::class, 'index'])->name('customer_sku');
Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerSKU/records', [CustomerSkuController::class, 'all_data'])->name('customer_sku.all_data');
Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerSKU/logs', [CustomerSkuController::class, 'logs'])->name('customer_sku.logs');


Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerItems', [CustomerItemController::class, 'index'])->name('customer_items');
Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerItems/records', [CustomerItemController::class, 'all_data'])->name('customer_items.all_data');
Route::middleware(['auth:sanctum', 'verified'])->get('/CustomerItems/logs', [CustomerItemController::class, 'logs'])->name('customer_items.logs');
