<?php

namespace App\Http\Controllers;

use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class warekcontroller extends Controller
{
    public function home(Request $request)
    {
        $dosen_kode = Auth::user()->kodeDosen;
        // dd(Auth::user()->IsDekan("DES"));
        $now = AkaPeriode::PeriodeSkrg();
        $jurusan=AkaJurusan::select("jur_nama","jur_kode")->get();
        // dd($jurusan);
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
        $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->get();
        // dd($semua);
        return view('wakilrektor.home',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua
        ]);
    }
    public function matkulwarek()
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

        $jurusan=AkaJurusan::select("jur_nama")->get();
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                        ->join('aka_matkul_kurikulum',function($q){
                            $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                            ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                        })
                        ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                        ->where('dosen_kode',$dosen_kode)->distinct()->orderBy("kurikulum_kode","asc")->get("kurikulum_kode");
        return view('wakilrektor.matkulwarek',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function filterhome(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        $jurusan=AkaJurusan::select("jur_nama","jur_kode")->get();
        if ($kurikulum!= "all") {
            $now = AkaPeriode::PeriodeSkrg();
            $jurusan=AkaJurusan::select("jur_nama")->get();
            $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
            $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->where("aka_matkul_kurikulum.kurikulum_kode",$kurikulum)
                                ->get();
            return view('wakilrektor.home',[
                "studi" => $studi,
                "jurusan" => $jurusan,
                "semua" => $semua
            ]);
        }else if ($jrsn!= "all") {
            $now = AkaPeriode::PeriodeSkrg();
            $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
            $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
            return view('wakilrektor.home',[
                "studi" => $studi,
                "jurusan" => $jurusan,
                "semua" => $semua
            ]);
        }elseif($kurikulum!= "all" && $jrsn != "all"){
            $now = AkaPeriode::PeriodeSkrg();
            $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
            $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->where("aka_matkul_kurikulum.kurikulum_kode",$kurikulum)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
            return view('wakilrektor.home',[
                "studi" => $studi,
                "jurusan" => $jurusan,
                "semua" => $semua
            ]);
        }
        elseif($kurikulum=="all" && $jrsn =="all"){
            Session::forget("jurusan");
            Session::forget("kurikulum");
            return redirect("wakil/home");
        }
    }
    public function filterwarek(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        $jurusan=AkaJurusan::select("jur_nama","jur_kode")->get();
        if ($kurikulum!= "all"&& $jrsn == "all") {
            $dosen_kode = Auth::user()->kodeDosen;
            $now = AkaPeriode::PeriodeSkrg();
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",$kurikulum)
                                ->get();

            $jurusan=AkaJurusan::select("jur_nama")->get();
            $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)->distinct()->orderBy("kurikulum_kode","asc")->get("kurikulum_kode");
            return view('wakilrektor.matkulwarek',[
                "kelass" => $kelass,
                "studi" => $studi,
                "jurusan" => $jurusan,
            ]);
        }else if ($jrsn!= "all" && $kurikulum == "all") {
            $dosen_kode = Auth::user()->kodeDosen;
            $now = AkaPeriode::PeriodeSkrg();
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();

            $jurusan=AkaJurusan::select("jur_nama")->get();
            $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)->distinct()->orderBy("kurikulum_kode","asc")->get("kurikulum_kode");
            return view('wakilrektor.matkulwarek',[
                "kelass" => $kelass,
                "studi" => $studi,
                "jurusan" => $jurusan,
            ]);
        }elseif($kurikulum!= "all" && $jrsn != "all"){
            $dosen_kode = Auth::user()->kodeDosen;
            $now = AkaPeriode::PeriodeSkrg();
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",$kurikulum)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();

            $jurusan=AkaJurusan::select("jur_nama")->get();
            $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->where('dosen_kode',$dosen_kode)->distinct()->orderBy("kurikulum_kode","asc")->get("kurikulum_kode");
            return view('wakilrektor.matkulwarek',[
                "kelass" => $kelass,
                "studi" => $studi,
                "jurusan" => $jurusan,
            ]);
        }
        elseif($kurikulum=="all" && $jrsn =="all"){
            Session::forget("jurusan");
            Session::forget("kurikulum");
            return redirect("wakil/matkulwarek");
        }
    }
}
