<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    
    Route::post('customers/import-csv', [CustomerController::class, 'importCsv'])->name('customers.import-csv');
    Route::delete('customers/clear-statistics', [CustomerController::class, 'clearStatistics'])->name('customers.clear-statistics');

    Route::resource('customers', CustomerController::class);
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('customers.index');
    }
    return view('welcome');
});