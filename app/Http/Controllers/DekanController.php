<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use Illuminate\Support\Facades\Session;

class DekanController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $now = AkaPeriode::PeriodeSkrg();
        // -------- Jurusan
        $fakultas = Auth::user()->dekanFakultas;
        $jurusan = Auth::user()->jurusanDekan;

        $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('jur_fakultas')
                            ->get();
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('jur_fakultas')
                            ->orderBy('kurikulum_kode')
                            ->distinct()
                            ->get('kurikulum_kode');
        return view('dekan.home',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan
        ]);
    }
    public function filterdekanhome(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        $fakultas = Auth::user()->dekanFakultas;
        $jurusan = Auth::user()->jurusanDekan;
        $now = AkaPeriode::PeriodeSkrg();
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('jur_fakultas')
                            ->orderBy('kurikulum_kode')
                            ->distinct()
                            ->get('kurikulum_kode');
        // --------------------------- Program --------------------------- //
        if ($kurikulum=='all' && $jrsn!='all') {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->orderBy('jur_fakultas')
                                ->get();
        }
        elseif ($kurikulum!='all' && $jrsn=='all') {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->orderBy('jur_fakultas')
                                ->get();
        }
        elseif ($kurikulum!='all' && $jrsn!='all') {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->orderBy('jur_fakultas')
                                ->get();
        }
        return view('dekan.home',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan
        ]);
    }
    public function matkuldekan()
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
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

        $jurusan=AkaJurusan::select("jur_nama",'jur_kode')->get();
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)
                            ->distinct()
                            ->orderBy("kurikulum_kode","asc")
                            ->get("kurikulum_kode");
        return view('dekan.matkuldekan',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function filtermatkuldekan(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        $dosen_kode = Auth::user()->kodeDosen;
        $now = AkaPeriode::PeriodeSkrg();
        $jurusan=AkaJurusan::select("jur_nama",'jur_kode')->get();
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)
                            ->distinct()
                            ->orderBy("kurikulum_kode","asc")
                            ->get("kurikulum_kode");
        // ---------------------- Program ---------------------- //
        if ($kurikulum!="all" && $jrsn=="all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->get();
        }elseif ($kurikulum=="all" && $jrsn!="all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
        }
        elseif ($kurikulum!="all" && $jrsn!="all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
        }
        elseif($kurikulum=="all" && $jrsn =="all"){
            return redirect("dekan/matkuldekan");
        }
        return view('dekan.matkuldekan',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function Unduh(Request $input){}
    public function Export(Request $input){}
}
