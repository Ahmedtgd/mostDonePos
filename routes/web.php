<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OrderProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('cards', CardController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('orderProduct', OrderProductController::class);
Route::get('/route-buttons', function () {
    return view('routes');
});

 
