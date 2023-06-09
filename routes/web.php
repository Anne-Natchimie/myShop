<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/addtocart/{product}', [CartController::class, 'addToCart'])->name('addtocart'); //Ne peut ajouter dans le panier que les utilisateurs connectés 
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

});

require __DIR__.'/auth.php';

Route::get('/', [ProductController::class, 'index'])->name('welcome'); 

// Filtre par category
Route::get('/filtre/{category}', [ProductController::class, 'index'])->name('welcome.filtre'); 

// 
Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('welcome.detail');  
