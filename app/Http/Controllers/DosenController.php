<?php

namespace App\Http\Controllers;

use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function home(Request $request)
    {
        $dosen_kode = Auth::user()->kodeDosen;
        $now = AkaPeriode::PeriodeSkrg();

        // $kelass = AkaKelas::where('dosen_kode',$dosen_kode)
        //                     ->where('periode_kode',$now->periode_kode)
        //                     ->get();

        $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            // join aka_matkul_kurikulum on aka_matkul_kurikulum.mk_kode = aka_kelas.mk_kode
                            // AND aka_matkul_kurikulum.jur_kode = aka_kelas.jur_kode


                            // join aka_matkul on aka_matkul.matkul_id = aka_matkul_kurikulum.matkul_id
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)
                            ->get();
                            // dd($kelass);
        $jurusan=AkaJurusan::select("jur_nama")->get();
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
        $nama = Auth::user()->namaDenganJabatan();
        // dd($studi);
        return view('dosen.Home',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
            "nama" => $nama
        ]);
    }

    public function search(Type $var = null)
    {
        # code...
    }
    public function Unduh(Request $input){}

}
