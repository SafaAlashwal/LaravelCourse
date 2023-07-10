<?php


use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthUserController;
use App\Http\Controllers\API\ProducttController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return auth()->user();
});

Route::post('/register', [AuthUserController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthUserController::class, 'login'])
    ->middleware('guest')
    ->name('login');


Route::post('/logout', [AuthUserController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

 Route::middleware(['auth:sanctum'])->resource('products',ProducttController::class)->except(['index']);

 ?>
