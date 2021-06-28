<?php

namespace App\Http\Controllers;

use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use App\Models\Sil_Dosen_Makul;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $dosen_kode = Auth::user()->kodeDosen;
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                    $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                        ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                                })
                                ->join('sil_pengisi',function ($e)
                                {
                                    $e->on('sil_pengisi.mk_kodebaa','aka_matkul_kurikulum.mk_kodebaa')
                                        ->on('sil_pengisi.kurikulum_kode','aka_matkul_kurikulum.kurikulum_kode');
                                })
                                ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                                ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                                ->where('sil_pengisi.dosen_kode',$dosen_kode)
                                ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode')
                                ->get();
        return view('dosen.home',[
            "kelass"=>$matkul_list,
            "dosen_kode" =>$dosen_kode
        ]);
    }

    public function cetak(Request $request)
    {
        $dosen_kode = Auth::user()->kodeDosen;
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                    $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                        ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                                })
                                ->join('sil_pengisi',function ($e)
                                {
                                    $e->on('sil_pengisi.mk_kodebaa','aka_matkul_kurikulum.mk_kodebaa')
                                        ->on('sil_pengisi.kurikulum_kode','aka_matkul_kurikulum.kurikulum_kode');
                                })
                                ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                                ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                                ->where('sil_pengisi.dosen_kode',$dosen_kode)
                                ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode')
                                ->get();
        return view('dosen.cetak',[
            "kelass"=>$matkul_list
        ]);
    }
    public function Unduh(Request $input){}

}
