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

Route::get('/test', [App\Http\Controllers\test::class, 'test'])->name('test.list');

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
Route::post('/valespagodarange_delete', [App\Http\Controllers\ValesPagodaRangeController::class, 'delete'])->name('valespagodarange.delete');

Route::get('/loans', [App\Http\Controllers\LoansController::class, 'index'])->name('loans');
Route::get('/loans_debt', [App\Http\Controllers\LoansController::class, 'indexDebt'])->name('loans_debt');
Route::get('/loans_debt_search', [App\Http\Controllers\LoansController::class, 'searchDebt'])->name('loans_debt.search');
Route::get('/loans_search', [App\Http\Controllers\LoansController::class, 'search'])->name('loans.search');
Route::post('/loans_store', [App\Http\Controllers\LoansController::class, 'store'])->name('loans.store');
Route::post('/loans_store_new', [App\Http\Controllers\LoansController::class, 'store_new'])->name('loans.store_new');
Route::post('/loans_newuser', [App\Http\Controllers\LoansController::class, 'newuser'])->name('loans.newuser');
Route::post('/loans_update', [App\Http\Controllers\LoansController::class, 'update'])->name('loans.update');
Route::get('/loans_list', [App\Http\Controllers\LoansController::class, 'list'])->name('loans.list');
Route::post('/loans_list_delete', [App\Http\Controllers\LoansController::class, 'destroy'])->name('loans.destroy');
Route::post('/loans_list/{id}', [App\Http\Controllers\LoansController::class, 'show'])->name('loans.show');
Route::post('/loans_list', [App\Http\Controllers\LoansController::class, 'updateLoan'])->name('loans.updateLoan');
Route::post('/loans', [App\Http\Controllers\LoansController::class, 'updatePayment'])->name('loans.updatePayment');

Route::get('/facture', [App\Http\Controllers\FactureController::class, 'index'])->name('factures');
Route::post('/facture/resume', [App\Http\Controllers\FactureController::class, 'resume'])->name('factures.resume');
Route::post('/facture', [App\Http\Controllers\FactureController::class, 'store'])->name('factures.store');
Route::post('/facture_update', [App\Http\Controllers\FactureController::class, 'update'])->name('factures.update');
Route::post('/facture_edit', [App\Http\Controllers\FactureController::class, 'edit'])->name('factures.edit');
Route::delete('/marketinvoice/{id}', [App\Http\Controllers\FactureController::class, 'borrar'])->name('factures.borrar');
//Route::post('/facture/{id}', [App\Http\Controllers\FactureController::class, 'show'])->name('factures.show');
Route::post('/factures/{id}', [App\Http\Controllers\FactureController::class, 'show'])->name('factures.show');

Route::delete('/facture/get_credit', [App\Http\Controllers\FactureController::class, 'borrar'])->name('factures.eliminar');
Route::get('/factures/{id}', [App\Http\Controllers\FactureController::class,'update'])->name('factures.update');
Route::post('/facture/search_by_provider', [App\Http\Controllers\FactureController::class, 'searchByProvider'])->name('factures.searchByProvider');
Route::post('/facture/get_credit', [App\Http\Controllers\FactureController::class, 'getAllCredit'])->name('factures.credit');
//Route::post('/facture', [App\Http\Controllers\FactureController::class, 'pagar'])->name('factures.pagar');

// Ruta para mostrar la página del mercado (método GET)
Route::get('/market', [App\Http\Controllers\MarketController::class, 'index'])->name('market');
// Ruta para procesar el formulario del mercado (método POST)
Route::post('/market/create', [App\Http\Controllers\MarketController::class, 'store'])->name('market.store');
Route::post('/market', [App\Http\Controllers\MarketController::class, 'charge'])->name('market.charge');
Route::post('/market/{id}', [App\Http\Controllers\MarketController::class, 'update'])->name('market.update');
Route::get('/market/{id}', [App\Http\Controllers\MarketController::class, 'edit'])->name('market.edit');
Route::get('/marketinvoice', [App\Http\Controllers\MarketController::class, 'show'])->name('marketinvoice');
Route::post('/marketinvoice', [App\Http\Controllers\MarketController::class, 'shopday'])->name('market.day');

Route::get('/firma1', function () {
    return view('canvas/tablero3');
});
Route::get('/firma2', function () {
    return view('canvas/tablero4');
});
Route::get('/firma3', function () {
    return view('canvas/tablero5');
});

// Ruta para dompdf
Route::get('download-pdf', [App\Http\Controllers\CloseCashController::class, 'downloadPdf'])->name('download-pdf');
Route::post('facture-pdf', [App\Http\Controllers\FactureController::class, 'downloadPdf'])->name('facture-pdf');

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('homeredirect');
