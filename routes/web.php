<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KajurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
    return view('Login');
});
Route::post('/HomePage',[LoginController::class,'login']);


Route::prefix("/admin")->group(function() {
    Route::get('Home', function () {return view('admin.Home');});
    Route::get('MataKuliah', function () {return view('admin.MataKuliah');});
    Route::get('Assign', function () {return view('admin.Assign');});
    Route::get('Pengisian',[AdminController::class,'Pengisian']);
    Route::get('Deskripsi', [AdminController::class,'Deskripsi']);
});

Route::prefix("/dosen")->group(function() {
    Route::get('Home', function () {return view('dosen.Home');});
    Route::get('Cetak', function () {return view('dosen.cetak');});
    Route::get('Unduh', [DosenController::class,'Unduh']);
});

Route::prefix("/kajur")->group(function() {
    Route::get('Home', function () {return view('kajur.Home');});
    Route::get('Assign', function () {return view('kajur.Assign');});
    Route::get('cetak', function () {return view('kajur.cetak');});
    Route::get('verifikasi', function () {return view('kajur.verifikasi');});
    Route::get('matkulkajur', function () {return view('kajur.matkulkajur');});
    Route::get('Unduh', [KajurController::class,'Unduh']);
});

Route::prefix("/dekan")->group(function() {
    Route::get('AssignDekan', function () {return view('dekan.AssignDekan');});
    Route::get('cetak', function () {return view('dekan.cetak');});
    Route::get('export', function () {return view('dekan.export');});
    Route::get('Home', function () {return view('dekan.Home');});
    Route::get('Unduh', [DekanController::class,'Unduh']);
    Route::get('Export', [DekanController::class,'Export']);
});

Route::prefix("/wakil")->group(function() {
    Route::get('AssignWakil', function () {return view('wakilrektor.assign');});
    Route::get('cetak', function () {return view('wakilrektor.cetak');});
    Route::get('export', function () {return view('wakilrektor.export');});
    Route::get('Home', function () {return view('wakilrektor.Home');});
    Route::get('Unduh', [DekanController::class,'Unduh']);
    Route::get('Export', [DekanController::class,'Export']);
});

Route::get("sialbusind",function(){return view('dosen.addsilabusIndo');});
