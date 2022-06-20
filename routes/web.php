<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NumberController;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
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


Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('admin.login');
Route::get('/logout', [LoginController::class,'logout'])->name('admin.logout');

Route::name('admin.')->middleware('auth')->group(function() {
    Route::resource('companies', CompanyController::class);
    Route::resource('numbers', NumberController::class);
});
Route::post('/submit-number', [NumberController::class,'store'])->name('admin.numbers.store');
Route::post('/submit-number-items', [NumberController::class,'store_item'])->name('admin.numbers.store_item');
Route::get('/{slug}', [CompanyController::class,'show'])->name('companies.show');
