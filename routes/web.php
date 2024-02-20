<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaController;

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

Route::middleware(['auth:sanctum', 'verified',])->group(function () {
    Route::resource('/notas', NotaController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
        return view('notas.index');
    })->name('dashboard');
});
