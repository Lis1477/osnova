<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GeneratorController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('categories/{id}/products', [CategoryController::class, 'products']);
Route::get('categories/create', [CategoryController::class, 'create']);
Route::get('categories/{id}', [CategoryController::class, 'categoryProducts']);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('pass', function () {
    return view('generators.pass');
});
Route::post('pass', [GeneratorController::class, 'makePassword']);

Route::get('pin', function () {
    return view('generators.pin');
});
Route::post('pin', [GeneratorController::class, 'makePin']);
