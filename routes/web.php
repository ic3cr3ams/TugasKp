<?php

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
});

Route::prefix("/dosen")->group(function() {
    Route::get('Home', function () {return view('dosen.Home');});
    Route::get('cetak', function () {return view('dosen.cetak');});
    Route::get('Assign', function () {return view('dosen.Assign');});
});

Route::prefix("/kajur")->group(function() {
    Route::get('Home', function () {return view('kajur.Home');});
    Route::get('Assign', function () {return view('kajur.Assign');});
    Route::get('cetak', function () {return view('kajur.cetak');});
    Route::get('verifikasi', function () {return view('kajur.verifikasi');});
    Route::get('matkulkajur', function () {return view('kajur.matkulkajur');});
});

Route::get("sialbusind",function(){return view('dosen.addsilabusIndo');});
