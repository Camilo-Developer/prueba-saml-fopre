<?php

use Illuminate\Support\Facades\Route;



use \App\Http\Controllers\C_Senek\ModalityController;
use \App\Http\Controllers\C_Senek\CategoryController;
use \App\Http\Controllers\C_Senek\SizeController;
use \App\Http\Controllers\C_Senek\TransportController;


//Rutas CAMILO

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\User\CompaniesController;
use \App\Http\Controllers\User\PreOrdersController;
use \App\Http\Controllers\Admin\RedirectController;
use App\Http\Controllers\Admin\ChartJSController;


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
Route::get('/checks-pays', function () {
    return view('users.fopre.checks-pays');
});

Route::get('/redirect',[RedirectController::class, 'dashboard']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('pedidos/pendientes',[PreOrdersController::class, 'index'])->name('users.preorders.pendientes');
    Route::post('pagar', [PreOrdersController::class, 'checkCart'])->name('pagar');
    Route::get('/chechekspays/{id}', [PreOrdersController::class, 'checkCartuser'])->name('users.checkpays');
});

Route::resource('modalities', ModalityController::class);

Route::controller(CategoryController::class)->group(function () {
    Route::get('/buscar-categorias', [CategoryController::class, 'getCategory'])->name('buscar-categorias');
});
Route::controller(SizeController::class)->group(function () {
    Route::get('/buscar-tallas', [SizeController::class, 'getSize'])->name('buscar-tallas');
});
Route::controller(TransportController::class)->group(function () {
    Route::get('/buscar-transportes', [TransportController::class, 'getTransport'])->name('buscar-transportes');
});


//Rutas Camilo

Route::get('products', [ProductsController::class, 'index'])->name('products.index');

Route::get('companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
Route::get('cart', [CompaniesController::class, 'cart'])->name('cart');
Route::post('add-to-cart/{id}', [CompaniesController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [CompaniesController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [CompaniesController::class, 'remove'])->name('remove_from_cart');
Route::post('/companies/{company}/edit-documents', [CompaniesController::class, 'editDocuments'])
    ->name('companies.edit_documents');


Route::get('confirmar/empresa',[CompaniesController::class, 'validateCompanies'])->name('validate.auth.companies');
Route::get('/download/{folder}/{filename}',[CompaniesController::class, 'download'])->name('download.document');


Route::get('/products/import', [ProductsController::class, 'showImportForm'])->name('products.import');
Route::post('/products/import', [ProductsController::class, 'importProducts'])->name('products.import.post');
Route::get('chart', [ChartJSController::class, 'index']);
