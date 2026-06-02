<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('companies', CompanyController::class);
    Route::resource('systems', SystemController::class);
    Route::resource('items', ItemController::class);

    Route::resource('companyUsers', CompanyUserController::class)->except(['index', 'edit', 'update', 'destroy']);
    Route::get('companyUsers/{company_id}/index', [CompanyUserController::class, 'index'])->name('companyUsers.index');
    Route::get('companyUsers/{company_id}/{company_user_id}/edit', [CompanyUserController::class, 'edit'])->name('companyUsers.edit');
    Route::put('companyUsers/{company_id}/{company_user_id}/update', [CompanyUserController::class, 'update'])->name('companyUsers.update');
    Route::delete('companyUsers/{company_id}/{company_user_id}/destroy', [CompanyUserController::class, 'destroy'])->name('companyUsers.destroy');
});

require __DIR__.'/auth.php';
