<?php

use Illuminate\Support\Facades\Route;

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
})->name('home');

// Public car listing
Route::get('/cars', [App\Http\Controllers\CarController::class, 'index'])->name('cars.index');

Route::middleware('auth')->group(function () {
    // Car creation multi-step form
    Route::get('/cars/create', [App\Http\Controllers\CarController::class, 'showLicensePlateForm'])->name('cars.create');
    Route::post('/cars/create', [App\Http\Controllers\CarController::class, 'storeLicensePlate']);
    Route::get('/cars/create/details', [App\Http\Controllers\CarController::class, 'showDetailsForm'])->name('cars.create.details');
    Route::post('/cars/create/details', [App\Http\Controllers\CarController::class, 'store'])->name('cars.store');
    
    // My listings
    Route::get('/my-listings', [App\Http\Controllers\CarController::class, 'myListings'])->name('cars.my-listings');
    
    // Delete car
    Route::delete('/cars/{car}', [App\Http\Controllers\CarController::class, 'destroy'])->name('cars.destroy');
});

// Public car viewing
Route::get('/cars/{car}', [App\Http\Controllers\CarController::class, 'show'])->name('cars.show');

require __DIR__.'/auth.php';
