<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\HomeController as WebHomeController;
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

Route::get('/', [WebHomeController::class, 'index'])->name('web.home');
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::prefix('admin')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
});
