<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarKelasSiswa;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruKelasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasMapelController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomMTController;
use App\Http\Controllers\UserController;

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

        Route::prefix('kelasmapel')->group(function () {
            Route::get('index', [KelasMapelController::class, 'index']);
            Route::get('klik/{kelas_id}/{mapel_id}', [KelasMapelController::class, 'klik']);
            Route::get('indexmapel', [KelasMapelController::class, 'indexmapel']);
            Route::post('tambah', [KelasMapelController::class, 'tambah']);
            Route::get('hapus/{id}', [KelasMapelController::class, 'hapus']);
            Route::get('get/{id}', [KelasMapelController::class, 'get']);
            Route::post('edit', [KelasMapelController::class, 'edit']);
        });
        Route::prefix('mapel')->group(function () {
            Route::get('index', [MapelController::class, 'index']);
            Route::post('tambah', [MapelController::class, 'tambah']);
            Route::get('hapus/{id}', [MapelController::class, 'hapus']);
            Route::get('get/{id}', [MapelController::class, 'get']);
            Route::post('edit', [MapelController::class, 'edit']);
        });
        Route::prefix('siswa')->group(function () {
            Route::get('index', [UserController::class, 'index']);
            Route::get('indexkelas', [UserController::class, 'indexkelas']);
            Route::post('tambah', [UserController::class, 'tambah']);
            Route::get('hapus/{id}', [UserController::class, 'hapus']);
            Route::get('get/{id}', [UserController::class, 'get']);
            Route::post('edit', [UserController::class, 'edit']);
        });
        Route::prefix('guru')->group(function () {
            Route::get('index', [GuruController::class, 'index']);
            Route::get('indexkelas', [GuruController::class, 'indexkelas']);
            Route::post('tambah', [GuruController::class, 'tambah']);
            Route::get('hapus/{id}', [GuruController::class, 'hapus']);
            Route::get('get/{id}', [GuruController::class, 'get']);
            Route::post('edit', [GuruController::class, 'edit']);
        });
    });
    Route::prefix('guru')->group(function () {
        Route::prefix('kelas')->group(function () {
            Route::get('index', [GuruKelasController::class, 'index']);
            Route::get('indexkelas', [GuruKelasController::class, 'indexkelas']);
            Route::get('klik/{kelas_id}/{mapel_id}', [GuruKelasController::class, 'klik']);
        });
        Route::prefix('room')->group(function () {
            Route::get('index', [RoomController::class, 'index']);
            Route::get('indexkelas', [RoomController::class, 'indexkelas']);
            Route::post('tambah', [RoomController::class, 'tambah']);
        });
        Route::prefix('roommateri')->group(function () {
            Route::get('index/{id}', [RoomMTController::class, 'index']);
            Route::post('tambah/{id}', [RoomMTController::class, 'tambah']);
            Route::post('tambah', [RoomMTController::class, 'tambah']);
        });
        Route::prefix('materi')->group(function () {
            Route::get('index/{id}', [MateriController::class, 'index']);
            Route::post('index/jawaban/{id}', [MateriController::class, 'jawaban']);
            Route::post('tambah/{id}', [MateriController::class, 'tambah']);
            Route::get('tugas/{id}', [MateriController::class, 'gettugas']);
            Route::post('edit', [MateriController::class, 'edit']);
        });
    });
    
    Route::prefix('siswa')->group(function () {
        Route::prefix('daftarkelas')->group(function () {
            Route::post('index', [DaftarKelasSiswa::class, 'index']);
            Route::post('tambah/{id}', [DaftarKelasSiswa::class, 'tambah']);
            Route::get('jawabtugastugas/{id}', [DaftarKelasSiswa::class, 'jawabtugas']);
            Route::post('edit', [DaftarKelasSiswa::class, 'edit']);
        });
        Route::prefix('materi')->group(function () {
            Route::post('jawabtugas/{id}', [DaftarKelasSiswa::class, 'jawabtugas']);
            Route::post('edittugas', [DaftarKelasSiswa::class, 'edittugas']);
        });
    });
    Route::post('test', [UserController::class, 'test']);
});
