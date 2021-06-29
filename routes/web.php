<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KajurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\warekcontroller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Api\MatkulController;
use App\Http\Controllers\IsiSilabus;

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

Route::prefix("/admin")->middleware('AdminStatus')->group(function() {
    Route::get('home', [AdminController::class,'home']);
    Route::post('pilihdosen', [AdminController::class,'pilihdosen']);
    Route::get('matakuliah',[AdminController::class,'matakuliah']);
    Route::post('filtermatakuliah',[AdminController::class,'filtermatakuliah']);
    Route::get('halassign', [AdminController::class,'halassign']);
    Route::get('silabus/{kodedosen}/{mkkodebaa}/{periode}/{bahasa}', [AdminController::class,'silabus']);
    Route::get('report',[AdminController::class,'report']);
    Route::get('Deskripsi', [AdminController::class,'Deskripsi']);
    Route::get('history/xlsx', [AdminController::class,'xlsx']);
    Route::get('history/csv', [AdminController::class,'csv']);
    Route::get('reportxlsx', [AdminController::class,'reportxlsx']);
    Route::get('export', [AdminController::class,'export']);
});

Route::prefix("/dosen")->middleware('DosenStatus')->group(function() {
    Route::get('home', [DosenController::class,'home']);
    Route::get('cetak', [DosenController::class,'cetak']);
    Route::get('silabus/{kodedosen}/{mkkodebaa}/{periode}/{bahasa}', [IsiSilabus::class,'silabus']);
    Route::get('unduh', [DosenController::class,'unduh']);
});

Route::prefix("/kajur")->middleware('KajurStatus')->group(function() {
    Route::get('cetak', [KajurController::class,'cetak']);
    Route::get('home', [KajurController::class,'home']);
    Route::post('filterkajur', [KajurController::class,'filterkajur']);
    Route::get('assign', [KajurController::class,'assign']);
    Route::get('matkulkajur', [KajurController::class,'matkulkajur']);
    Route::get('silabus/{kodedosen}/{mkkodebaa}/{periode}/{bahasa}', [IsiSilabus::class,'silabus']);
    Route::get('unduh', [KajurController::class,'Unduh']);
    Route::get('verifikasi', [KajurController::class,'verifikasi']);
});

Route::prefix("/dekan")->middleware('DekanStatus')->group(function() {
    Route::post('filtermatkuldekan', [DekanController::class,'filtermatkuldekan']);
    Route::get('matkuldekan', [DekanController::class,'matkuldekan']);
    Route::get('matkuljurusan', [DekanController::class,'matkuljurusan']);
    Route::get('assign', [DekanController::class,'assign']);
    Route::get('cetak', [DekanController::class,'cetak']);
    Route::get('silabus/{kodedosen}/{mkkodebaa}/{periode}/{bahasa}', [IsiSilabus::class,'silabus']);
    Route::get('export', function () {return view('dekan.export');});
    Route::get('verifikasi', [DekanController::class,'verifikasi']);
    Route::get('home', [DekanController::class,'home']);
    Route::post('filterdekanhome', [DekanController::class,'filterdekanhome']);
    Route::get('unduh', [DekanController::class,'Unduh']);
    Route::get('export', [DekanController::class,'Export']);
});

Route::prefix("/wakil")->middleware('WakilStatus')->group(function() {
    Route::get('home', [warekcontroller::class,'home']);
    Route::get('cetak', [warekcontroller::class,'cetak']);
    Route::get('matkulwarek', [warekcontroller::class,'matkulwarek']);
    Route::get('dekanwarek', [warekcontroller::class,'dekanwarek']);
    Route::get('silabus/{kodedosen}/{mkkodebaa}/{periode}/{bahasa}', [IsiSilabus::class,'silabus']);
    Route::post('filtermatakuliah', [warekcontroller::class,'filtermatakuliah']);
    Route::post('filterwarek', [warekcontroller::class,'filterwarek']);
    Route::post('filterdekan', [warekcontroller::class,'filterdekan']);
    Route::get('Unduh', [DekanController::class,'Unduh']);
    Route::get('export', [DekanController::class,'export']);
});
Route::prefix('matkul')->group(function(){
    Route::get('slctddosen/{kodedosen}', [MatkulController::class, 'slctddosen']);
    Route::get('pengisikosong', [MatkulController::class, 'pengisikosong']);
    Route::get('list', [MatkulController::class, 'list']);
    Route::get('listmatkul', [MatkulController::class, 'listmatkul']);
    //---------KAJUR
    Route::get('listmatkulkajur/{jurusan}', [MatkulController::class, 'listmatkulkajur']);
    Route::get('slctddosenjurusan/{kodedosen}/{jurusan}', [MatkulController::class, 'slctddosenjurusan']);
    Route::get('pengisikosongjurusan/{jurusan}', [MatkulController::class, 'pengisikosongjurusan']);
    Route::post('assign', [MatkulController::class, 'assign']);

});

Route::post("fill",[IsiSilabus::class,'fill']);
Route::post("verif",[IsiSilabus::class,'verif']);
Route::post('doUpload', [AdminController::class,'doUpload']);
