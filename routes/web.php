<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Igra1;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;

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
    return view('Igra1.index')->with(['naslov' => 'Igra tri boje', 'brojTokena' => Auth::user()->coins]);
})->middleware(['auth'])->name('igraTriBoje.index');

Route::post('/dashboard/igra1', [Igra1::class, 'store'])->middleware(['auth'])->name('igraTriBoje.store');

Route::get('/dashboard/igra1/statistika', [Igra1::class, 'statistics'])->middleware(['auth'])->name('igraTriBoje.statistika');




Route::get('/dashboard/osvijeziTokene', function () {
    //stavljam tokene na 500
    $korisnik = Auth::user();
    $korisnik->coins = 500;
    $korisnik->update();

    return back();
})->middleware(['auth'])->name('dashboard.osvijeziTokene');

Route::get('dashboard/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::post('dashboard/profile', [ProfileController::class, 'store'])->middleware(['auth']);

require __DIR__ . '/auth.php';
