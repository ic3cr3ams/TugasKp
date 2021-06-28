<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MatkulController;

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
