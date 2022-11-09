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

Route::post('/close_cash',[App\Http\Controllers\CloseCashController::class, 'show'])->name('close.cash');

Route::post('/closecash_store',[App\Http\Controllers\CloseCashController::class, 'store'])->name('closecash.store');
Route::post('/closecash_import',[App\Http\Controllers\CloseCashController::class, 'import'])->name('closecash.import');
Route::post('/closecash_list',[App\Http\Controllers\CloseCashController::class, 'list'])->name('closecash.list');
Route::post('/closecash_destroy',[App\Http\Controllers\CloseCashController::class, 'destroy'])->name('closecash.destroy');

Route::get('/valepagoda',[App\Http\Controllers\ValePagodaController::class, 'index'])->name('valepagoda');
Route::get('/valepagodacancel',[App\Http\Controllers\ValePagodaController::class, 'index'])->name('valepagodacancel');

Route::get('/valepagoda_search',[App\Http\Controllers\ValePagodaController::class, 'search'])->name('valepagoda.search');
Route::get('/valepagoda_store',[App\Http\Controllers\ValePagodaController::class, 'store'])->name('valepagoda.store');
Route::get('/valepagoda_list',[App\Http\Controllers\ValePagodaController::class, 'list'])->name('valepagoda.list');
Route::post('/valepagoda_destroy',[App\Http\Controllers\ValePagodaController::class, 'destroy'])->name('valepagoda.destroy');


Route::post('/valespagodarange',[App\Http\Controllers\ValesPagodaRangeController::class, 'index'])->name('valespagodarange');
Route::get('/valespagodarange_search',[App\Http\Controllers\ValesPagodaRangeController::class, 'search'])->name('valespagodarange.search');
Route::post('/valespagodarange_store',[App\Http\Controllers\ValesPagodaRangeController::class, 'store'])->name('valespagodarange.store');
Route::post('/valespagodarange_list',[App\Http\Controllers\ValesPagodaRangeController::class, 'list'])->name('valespagodarange.list');


Route::post('/loans',[App\Http\Controllers\LoansController::class, 'index'])->name('loans');
Route::post('/loans_search',[App\Http\Controllers\LoansController::class, 'search'])->name('loans.search');
Route::post('/loans_store',[App\Http\Controllers\LoansController::class, 'store'])->name('loans.store');
Route::post('/loans_list',[App\Http\Controllers\LoansController::class, 'list'])->name('loans.list');


//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('homeredirect');

