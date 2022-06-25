<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;

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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::middleware('auth:api')->group(function () {
            Route::get('user', [AuthController::class, 'user']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    Route::prefix('admin')->group(function () {

        Route::prefix('kelas')->group(function () {
            Route::get('index', [KelasController::class, 'index']);
            Route::post('tambah', [KelasController::class, 'tambah']);
            Route::get('hapus/{id}', [KelasController::class, 'hapus']);
            Route::get('get/{id}', [KelasController::class, 'get']);
            Route::post('edit', [KelasController::class, 'edit']);
        });
    });
});
