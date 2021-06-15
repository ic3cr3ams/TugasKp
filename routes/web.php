<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KajurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\warekcontroller;
use Illuminate\Support\Facades\Session;

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
Route::post('login', [LoginController::class,'login']);
Route::get('logout',[LoginController::class,'logout']);


Route::prefix("/admin")->group(function() {
    Route::get('home', [AdminController::class,'home']);
    Route::post('pilihdosen', [AdminController::class,'pilihdosen']);
    Route::get('matakuliah',[AdminController::class,'matakuliah']);
    Route::post('filtermatakuliah',[AdminController::class,'filtermatakuliah']);
    Route::get('halassign', [AdminController::class,'halassign']);
    Route::get('Pengisian',[AdminController::class,'Pengisian']);
    Route::get('Deskripsi', [AdminController::class,'Deskripsi']);
});

Route::prefix("/dosen")->group(function() {
    Route::get('home', [DosenController::class,'home']);
    Route::get('cetak', function () {return view('dosen.cetak');});
    Route::get('unduh', [DosenController::class,'Unduh']);
});

Route::prefix("/kajur")->group(function() {
    Route::get('home', [KajurController::class,'home']);
    Route::post('filterkajur', [KajurController::class,'filterkajur']);
    Route::get('assign', function () {return view('kajur.Assign');});
    Route::get('cetak', function () {return view('kajur.cetak');});
    Route::get('verifikasi', function () {return view('kajur.verifikasi');});
    Route::get('matkulkajur', [KajurController::class,'matkulkajur']);
    Route::post('filtermatkulkajur', [KajurController::class,'filtermatkulkajur']);
    Route::get('unduh', [KajurController::class,'Unduh']);
});

Route::prefix("/dekan")->group(function() {
    Route::post('filtermatkuldekan', [DekanController::class,'filtermatkuldekan']);
    Route::get('matkuldekan', [DekanController::class,'matkuldekan']);
    Route::get('cetak', function () {return view('dekan.cetak');});
    Route::get('export', function () {return view('dekan.export');});
    Route::get('home', [DekanController::class,'home']);
    Route::post('filterdekanhome', [DekanController::class,'filterdekanhome']);
    Route::get('unduh', [DekanController::class,'Unduh']);
    Route::get('export', [DekanController::class,'Export']);
});

Route::prefix("/wakil")->group(function() {
    Route::get('home', [warekcontroller::class,'home']);
    Route::get('matkulwarek', [warekcontroller::class,'matkulwarek']);
    Route::get('dekanwarek', [warekcontroller::class,'dekanwarek']);
    Route::post('filtermatakuliah', [warekcontroller::class,'filtermatakuliah']);
    Route::post('filterwarek', [warekcontroller::class,'filterwarek']);
    Route::post('filterdekan', [warekcontroller::class,'filterdekan']);
    Route::get('Unduh', [DekanController::class,'Unduh']);
    Route::get('Export', [DekanController::class,'Export']);
});

Route::get("sialbusind",function(){return view('dosen.addsilabusIndo');});
