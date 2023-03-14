<?php

use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\UserControllerMitra;
use App\Http\Controllers\API\AlamatController;
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

    Route::middleware('auth:sanctum')->group(
        function () {
            Route::post('logout', [AuthUser::class, 'logout'])->name('logout');
            Route::get('user', [AuthUser::class, 'fetch'])->name('fetch');
            //view data addredd indonesia
            Route::get('cities', [AlamatController::class, 'indexcities'])->name('indexcities');
            Route::get('province', [AlamatController::class, 'indexprovinces'])->name('indexprovinces');
            Route::get('districts', [AlamatController::class, 'indexdistricts'])->name('indexdistricts');
            Route::get('villages', [AlamatController::class, 'indexvillages'])->name('indexvillages');

            //crud address
            Route::post('createaddress', [AlamatController::class, 'createaddress'])->name('createaddress');
            Route::post('updateaddress', [AlamatController::class, 'update'])->name('update');
            Route::post('deleteaddress', [AlamatController::class, 'destroy'])->name('destroy');
            Route::get('address', [AlamatController::class, 'indexaddress'])->name('indexaddress');
        }
    );
});

//Admin
Route::middleware('auth:sanctum')->group(function () {
    Route::group(
        ['prefix' => 'admin'],
        function () {
            Route::post('/update-profile', [AuthUser::class, 'update'])->name('update');
           
            // CRUD USER
            Route::post('/create-user', [UserController::class, 'create'])->name('create');
            Route::post('/update-user', [UserController::class, 'update'])->name('update');
            Route::post('/delete-user', [UserController::class, 'destroy'])->name('destroy');
            Route::get('/view-user', [UserController::class, 'view'])->name('view');
        }
    );
});

//Mitra
Route::middleware('auth:sanctum')->group(function () {
    Route::group(
        ['prefix' => 'mitra'],
        function () {
            Route::post('/update-profile', [AuthUser::class, 'update'])->name('update');

            //CRUD PEGAWAI
             // CRUD USER
             Route::post('/create-pegawai', [UserControllerMitra::class, 'create'])->name('create');
             Route::post('/update-pegawai', [UserControllerMitra::class, 'update'])->name('update');
             Route::post('/delete-pegawai', [UserControllerMitra::class, 'destroy'])->name('destroy');
             Route::get('/view-pegawai', [UserControllerMitra::class, 'view'])->name('view');

        }
    );
});

//Pegawai
Route::middleware('auth:sanctum')->group(function () {
    Route::group(
        ['prefix' => 'pegawai'],
        function () {
            Route::post('/update-profile', [AuthUser::class, 'update'])->name('update');
        }
    );
});



//customer
Route::middleware('auth:sanctum')->group(function () {
    Route::group(
        ['prefix' => 'customer'],
        function () {
            Route::post('/update-profile', [AuthUser::class, 'update'])->name('update');
        }
    );
});