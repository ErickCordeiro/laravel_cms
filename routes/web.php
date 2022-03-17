<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Web\HomeController as WebHomeController;
use App\Http\Controllers\Web\PageController as WebPageController;
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

//Rota de Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

//Roda de Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//Rota Reset Password
Route::get('/password/reset', [ResetPasswordController::class, 'index'])->name('password.reset');

//Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin');

    //Rota Settings 
    Route::get('/settings', [SettingsController::class, 'edit'])->name('admin.settings');
    Route::put('/settings/{code}/update', [SettingsController::class, 'update'])->name('admin.settings.update');

    //Rotas Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    //Rotas de Usuários
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('admin.users.show');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('admin.users.destroy');

    //Rotas Pages
    Route::get('/pages', [PageController::class, 'index'])->name('admin.pages');
    Route::get('/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('admin.pages.store');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/{page}/update', [PageController::class, 'update'])->name('admin.pages.update');
    Route::delete('/pages/{page}/destroy', [PageController::class, 'destroy'])->name('admin.pages.destroy');
});

Route::fallback([WebPageController::class, 'index']);