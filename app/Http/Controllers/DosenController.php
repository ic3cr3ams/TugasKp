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

class DosenController extends Controller
{
    public function home(Request $request)
    {
        $dosen_kode = Auth::user()->kodeDosen;
        $now = AkaPeriode::PeriodeSkrg();
        $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)
                            ->get();
        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk','!=','')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->get();
        $silpengisi = SilPengisi::all();
        $jurusan=AkaJurusan::select("jur_nama")->get();
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();

        return view('dosen.Home',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
            "silpengisi" => $silpengisi,
            "dosen" =>$dosen
        ]);
    }

    public function search(Type $var = null)
    {
        # code...
    }
    public function Unduh(Request $input){}

}
