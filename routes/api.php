<?php

use App\Http\Controllers\API\AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth API
Route::name('auth')->group(function () {
    Route::post('login', [AuthUser::class, 'login'])->name('login');
    Route::post('register', [AuthUser::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthUser::class, 'logout'])->name('logout');
        Route::get('user', [AuthUser::class, 'fetch'])->name('fetch');
    });
});
