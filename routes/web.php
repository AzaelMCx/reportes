<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Htpp\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');