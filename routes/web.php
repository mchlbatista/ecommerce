<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login')
    ]);
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'user' => auth()->user()
        ]);
    })->name('dashboard');

    Route::controller(InventoryController::class)->group(function () {
        Route::get('/inventory', 'index')->name('inventory');
        Route::get('/inventory/quantity-below-than/{threshold}', 'quantityBelowThat')->name('inventory.quantity_below_that');
        Route::get('/inventory/sku/{sku}', 'sku')->name('inventory.sku');
        Route::get('/inventory/product-id/{id}', 'productId')->name('inventory.product_id');
    });
});
