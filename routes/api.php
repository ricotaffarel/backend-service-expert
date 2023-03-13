<?php

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\AlamatController;
use App\Http\Controllers\API\Mitra\MitraController;
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

//Alamat
Route::get('/cities', [AlamatController::class, 'indexcities'])->name('indexcities');



Route::get('/province', [AlamatController::class, 'indexprovinces'])->name('indexprovinces');


Route::get('/districts', [AlamatController::class, 'indexdistricts'])->name('indexdistricts');


Route::get('/villages', [AlamatController::class, 'indexvillages'])->name('indexvillages');

Route::get('/address', [AlamatController::class, 'indexaddress'])->name('indexaddress');
Route::post('/createaddress', [AlamatController::class, 'createaddress'])->name('createaddress');
Route::post('/updateaddress', [AlamatController::class, 'update'])->name('update');
Route::post('/deleteaddress', [AlamatController::class, 'destroy'])->name('destroy');


//Mitra




// Route::post('/update', [AdminController::class, 'update'])->name('update');



// Auth API
Route::name('auth')->group(function () {
    Route::post('login', [AuthUser::class, 'login'])->name('login');
    Route::post('register', [AuthUser::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthUser::class, 'logout'])->name('logout');
        Route::get('user', [AuthUser::class, 'fetch'])->name('fetch');
    }
    );
});

//Admin
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/update-profile', [AdminController::class, 'update'])->name('update');
    });
});

//Mitra
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'mitra'], function () {
        Route::post('/addmitra', [MitraController::class, 'create'])->name('create');
        Route::post('/update', [AdminController::class, 'update'])->name('update');
        Route::delete('/hapusmitra', [MitraController::class, 'destroy'])->name('destroy');
        Route::get('/view', [MitraController::class, 'view'])->name('view');
        // Route::get('/deletemitra', [MitraController::class, 'destroy'])->name('destroy');

    });
});

//Pegawai
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'pegawai'], function () {
        Route::post('/update', [AdminController::class, 'updates'])->name('updates');
    });
});



//customer
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::post('/update', [AdminController::class, 'update'])->name('update');
    });
});
