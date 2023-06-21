<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\PaysController;
use App\Http\Controllers\Admin\SaleReportsController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PreOrdersController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RedirectController;

Route::middleware(['verificarcompany'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('can:admin.dashboard')->name('admin.dashboard');
    Route::resource('products', ProductsController::class)->names('admin.products');
    Route::resource('states', StatesController::class)->names('admin.states');
    Route::resource('users', UsersController::class)->names('admin.users');
    Route::resource('pays', PaysController::class)->names('admin.pays');
    Route::resource('salereports', SaleReportsController::class)->names('admin.salereports');
    Route::get('/preorders/entregados', [PreOrdersController::class, 'entregados'])->name('admin.preorders.entregados');
    Route::resource('preorders', PreOrdersController::class)->names('admin.preorders');
    Route::resource('companies', CompaniesController::class)->names('admin.companies');
    Route::resource('roles', RoleController::class)->names('admin.roles');

    Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('users/search', [UsersController::class, 'search'])->name('admin.users.search');
    Route::get('users/reset', [UsersController::class, 'reset'])->name('admin.users.reset');

    Route::get('/buscar-usuario', [PreOrdersController::class, 'getUsers'])->name('buscar-usuario');
    Route::get('/buscar-empresa', [PreOrdersController::class, 'getCompanies'])->name('buscar-empresa');

});

Route::get('/{company}/document_required', [RedirectController::class, 'requeridos_companies'])->name('admin.requeridos');


