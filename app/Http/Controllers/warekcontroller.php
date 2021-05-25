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
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $now = AkaPeriode::PeriodeSkrg();
        $jurusan=AkaJurusan::select('jur_nama','jur_kode')->get();
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
        $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->get();
        return view('wakilrektor.home',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua
        ]);
    }
    public function matkulwarek()
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
        return view('wakilrektor.matkulwarek',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function dekanwarek()
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $now = AkaPeriode::PeriodeSkrg();
        // ------------------------ Jurusan ------------------------ //
        $fakultas = Auth::user()->dekanFakultas;
        $jurusan = Auth::user()->jurusanDekan;
        // ------------------------ Isi Kelas ------------------------ //
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
        // ------------------------ Isi Kurikulum ------------------------ //
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('kurikulum_kode')
                            ->distinct()
                            ->get('kurikulum_kode');
        return view('wakilrektor.dekanwarek',[
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
        $jurusan=AkaJurusan::select(['jur_kode','jur_nama'])->get();
        if ($kurikulum!= "all") {
            $now = AkaPeriode::PeriodeSkrg();
            $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
            $semua =  AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->get();
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
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
        }
        elseif($kurikulum=="all" && $jrsn =="all"){
            return redirect("wakil/home");
        }
        return view('wakilrektor.home',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua
        ]);
    }
    public function filterwarek(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        // ------------------------------ Program ------------------------------ //
        $now = AkaPeriode::PeriodeSkrg();
        $dosen_kode = Auth::user()->kodeDosen;
        // Kurikulum
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
        $jurusan=AkaJurusan::select("jur_nama","jur_kode")->get();
        if ($kurikulum!= "all"&& $jrsn == "all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->get();

        }else if ($jrsn!= "all" && $kurikulum == "all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->where('dosen_kode',$dosen_kode)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->get();
        }elseif($kurikulum!= "all" && $jrsn != "all"){
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
            return redirect("wakil/matkulwarek");
        }
        return view('wakilrektor.matkulwarek',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function filterdekan(Request $request)
    {
        $kurikulum = $request -> krklm;
        $jrsn = $request -> jrsn;;
        Session::put("kurikulum",$kurikulum);
        Session::put("jurusan",$jrsn);
        // ------------------------------------ Program ------------------------------------ //
        $now = AkaPeriode::PeriodeSkrg();
        $fakultas = Auth::user()->dekanFakultas;
        $jurusan = Auth::user()->jurusanDekan;
        $studi= AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('kurikulum_kode')
                            ->distinct()
                            ->get('kurikulum_kode');

        if ($kurikulum!="all" && $jrsn=="all") {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                                ->where('aka_jurusan.jur_fakultas',$fakultas)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->orderBy('jur_fakultas')
                                ->get();
        }
        elseif ($kurikulum=="all" && $jrsn!='all') {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                                ->where('aka_jurusan.jur_fakultas',$fakultas)
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
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
                                ->where('aka_jurusan.jur_fakultas',$fakultas)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->where("aka_matkul_kurikulum.jur_kode",session::get("jurusan"))
                                ->orderBy('jur_fakultas')
                                ->get();
        }
        elseif($kurikulum=="all" && $jrsn =="all"){
            return redirect("wakil/dekanwarek");
        }
        return view('wakilrektor.dekanwarek',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
}
