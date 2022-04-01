<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Igra1;

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

Route::get('/dashboard', function () {
    return view('dashboard')->with(['naslov' => 'Dashboard']);
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/igra1', function () {
    return view('igra1')->with(['naslov' => 'Igra tri boje']);
})->middleware(['auth'])->name('igraTriBoje.index');
Route::post('/dashboard/igra1', [Igra1::class, 'store'])->middleware(['auth'])->name('igraTriBoje.store');

require __DIR__ . '/auth.php';
