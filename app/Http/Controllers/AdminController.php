<?php

namespace App\Http\Controllers;

use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use App\Models\Sil_Dosen_Makul;
use App\Models\TkDosen;
use App\Models\TkKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $dosen = TkDosen::where('dosen_status','1')
                        ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                        ->where('dosen_nama_sk','!=','')
                        ->get();
        return view('admin.home',[
            "dosen" => $dosen
        ]);
    }
    public function pilihdosen(Request $request)
    {
        Auth::attempt($request->only('username','password'));
        if(Auth::user() !== null){
            if (Auth::user()->isWarek("1")) {
                return redirect("wakil/home");
            }
            else if (Auth::user()->isDekan("")) {
                return redirect("dekan/home");
            }
            else if (Auth::user()->isKajur()) {
                return redirect("kajur/home");
            }
            else if (Auth::user()->isDosen()) {
                return redirect('dosen/home');
            }
        }
    }
    public function matakuliah(Request $request)
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
        return view('admin.matakuliah',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua
        ]);
    }
    public function filtermatakuliah(Request $request)
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
            return redirect("admin/matakuliah");
        }
        return view('admin.matakuliah',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua
        ]);
    }
    public function halassign(Type $var = null)
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
        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk','!=','')
                            ->get();
        $datajumlah = db::table('sil_dosen_makul')
                            ->select(db::raw('count(kode_dosen) as jumlah,kode_dosen,Kode_matkul'))
                            ->where('periode_kode',$now->periode_kode)
                            ->groupby('kode_dosen')
                            ->get();
        // dd($datajumlah);
        return view('admin.Assign',[
            "studi" => $studi,
            "jurusan" => $jurusan,
            "semua" => $semua,
            "dosen" => $dosen,
            "jumlah"=>$datajumlah
        ]);
    }
    public function Deskripsi(Request $input){}
    public function Pengisian(Request $input){}
}
