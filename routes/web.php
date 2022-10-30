<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuController::class, 'index']);
    Route::post('/menu/store', [MenuController::class, 'store']);
    Route::get('/menu/{menu}/edit', [MenuController::class, 'edit']);
    Route::put('/menu/update/{menu}', [MenuController::class, 'update']);
    Route::delete('/menu/delete/{menu}', [MenuController::class, 'destroy']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/report', [OrderController::class, 'report']);
    Route::get('/order/{order}', [OrderController::class, 'show']);
    Route::post('/order/store', [OrderController::class, 'store']);
    Route::post('/order/confirmation/{order}', [OrderController::class, 'confirmation']);
    Route::get('/order/{order}/edit', [OrderController::class, 'edit']);
    Route::put('/order/update/{order}', [OrderController::class, 'update']);
    Route::delete('/order/delete/{order}', [OrderController::class, 'destroy']);
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home', function () {
    return view('index');
});
