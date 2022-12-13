<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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
    return view('home');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
    
    Route::get('/commission', [CommissionController::class, 'index'])->name('commission');
    Route::post('/commission', [CommissionController::class, 'store'])->name('commission.store');
    Route::get('/commission/{id}/edit', [CommissionController::class, 'edit'])->name('commission.edit');
    Route::delete('/commission/{id}', [CommissionController::class, 'destroy'])->name('commission.destroy');
});

Route::middleware('auth', 'role:admin')->group(function () {   
    
    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::post('/package', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/{id}/edit', [PackageController::class, 'edit'])->name('package.edit');
    Route::put('/package/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::delete('/package/{id}', [PackageController::class, 'destroy'])->name('package.destroy');
    
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{id}', [CommissionController::class, 'destroy'])->name('commission.destroy');
});

Route::get('/test', function () {
    return view('test');
});
require __DIR__.'/auth.php';
