<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

//require __DIR__.'/auth.php';

//Route::view('/close_cash','close_cash', [CloseCashController::class, 'show']);

Route::post('/close_cash', [App\Http\Controllers\CloseCashController::class, 'show'])->name('close.cash');

Route::post('/closecash_store', [App\Http\Controllers\CloseCashController::class, 'store'])->name('closecash.store');
Route::post('/closecash_import', [App\Http\Controllers\CloseCashController::class, 'import'])->name('closecash.import');
Route::get('/closecash_list', [App\Http\Controllers\CloseCashController::class, 'list'])->name('closecash.list');
Route::post('/closecash_destroy', [App\Http\Controllers\CloseCashController::class, 'destroy'])->name('closecash.destroy');
Route::post('/closecash_edit', [App\Http\Controllers\CloseCashController::class, 'edit'])->name('closecash.edit');

Route::get('/valepagoda', [App\Http\Controllers\ValePagodaController::class, 'index'])->name('valepagoda');
Route::get('/valepagodacancel', [App\Http\Controllers\ValePagodaController::class, 'index'])->name('valepagodacancel');

Route::get('/valepagoda_search', [App\Http\Controllers\ValePagodaController::class, 'search'])->name('valepagoda.search');
Route::get('/valepagoda_store', [App\Http\Controllers\ValePagodaController::class, 'store'])->name('valepagoda.store');
Route::get('/valepagoda_list', [App\Http\Controllers\ValePagodaController::class, 'list'])->name('valepagoda.list');
Route::post('/valepagoda_destroy', [App\Http\Controllers\ValePagodaController::class, 'destroy'])->name('valepagoda.destroy');


Route::post('/valespagodarange', [App\Http\Controllers\ValesPagodaRangeController::class, 'index'])->name('valespagodarange');
Route::get('/valespagodarange_search', [App\Http\Controllers\ValesPagodaRangeController::class, 'search'])->name('valespagodarange.search');
Route::post('/valespagodarange_store', [App\Http\Controllers\ValesPagodaRangeController::class, 'store'])->name('valespagodarange.store');
Route::post('/valespagodarange_list', [App\Http\Controllers\ValesPagodaRangeController::class, 'list'])->name('valespagodarange.list');


Route::get('/loans', [App\Http\Controllers\LoansController::class, 'index'])->name('loans');
Route::get('/loans_search', [App\Http\Controllers\LoansController::class, 'search'])->name('loans.search');
Route::post('/loans_store', [App\Http\Controllers\LoansController::class, 'store'])->name('loans.store');
Route::post('/loans_store_new', [App\Http\Controllers\LoansController::class, 'store_new'])->name('loans.store_new');
Route::post('/loans_newuser', [App\Http\Controllers\LoansController::class, 'newuser'])->name('loans.newuser');
Route::post('/loans_update', [App\Http\Controllers\LoansController::class, 'update'])->name('loans.update');

Route::get('/loans_list', [App\Http\Controllers\LoansController::class, 'list'])->name('loans.list');


Route::get('/firma1', function () {
    return view('canvas/tablero3');
});
Route::get('/firma2', function () {
    return view('canvas/tablero4');
});
Route::get('/firma3', function () {
    return view('canvas/tablero5');
});

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('homeredirect');
