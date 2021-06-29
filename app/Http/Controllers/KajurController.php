<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaPeriode;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class KajurController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan = Auth::user()->jurusanKajur;
        foreach ($jurusan as $key => $value) {
            $jurusan = $value->jur_kode;
        }
        $kelass = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                            ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                            ->where('aka_jurusan.jur_kode',$jurusan)
                            ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode')
                            ->get();
        $silpengisi = SilPengisi::all();
        $dosen = TkDosen::where('dosen_status', '1')
                            ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk', '!=', '')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->get();
        return view('kajur.home',[
            "kelass" => $kelass,
            "silpengisi"=>$silpengisi,
            "dosen" => $dosen,
        ]);
    }
    public function filterkajur(Request $request)
    {
        $kurikulum = $request->krklm;
        Session::put("kurikulum",$kurikulum);
        $jurusan = Auth::user()->jurusanKajur;
        foreach ($jurusan as $key => $value) {
            $jurusan = $value->jur_kode;
        }
        $now = AkaPeriode::PeriodeSkrg();
        $studi=  AkaKelas::where('periode_kode',$now->periode_kode)
                            ->join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('aka_jurusan','aka_jurusan.jur_kode','aka_kelas.jur_kode')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->where('aka_jurusan.jur_kode',$jurusan)
                            ->distinct()
                            ->orderBy('kurikulum_kode')
                            ->get('kurikulum_kode');
        if ($kurikulum!='all') {
            $kelass = AkaKelas::where('periode_kode',$now->periode_kode)
                                ->join('aka_matkul_kurikulum',function($q){
                                    $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                ->join('aka_jurusan','aka_jurusan.jur_kode','aka_kelas.jur_kode')
                                ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                                ->where('aka_jurusan.jur_kode',$jurusan)
                                ->where("aka_matkul_kurikulum.kurikulum_kode",session::get("kurikulum"))
                                ->get();
        }
        else return redirect('kajur/home');
        return view('kajur.home',[
            "kelass" => $kelass,
            "studi" => $studi
        ]);
    }
    public function matkulkajur(Request $request)
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
        return view('kajur.matkulkajur',[
            "kelass" => $matkul_list,
            "dosen_kode" =>$dosen_kode
        ]);
    }
    public function filtermatkulkajur(Request $request)
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
            return redirect("kajur/matkulkajur");
        }
        return view('kajur.matkulkajur',[
            "kelass" => $kelass,
            "studi" => $studi,
            "jurusan" => $jurusan,
        ]);
    }
    public function assign(Type $var = null)
    {
        // dd(Auth::user());
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk','!=','')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->groupBy('tk_dosen.dosen_kode')
                            ->get();
        $jurusan = Auth::user()->jurusanKajur;
        foreach ($jurusan as $key => $value) {
            $jurusan = $value->jur_kode;
        }
        return view('kajur.assign',[
            "listdosen" => $dosen,
            "jurusan" =>$jurusan
        ]);
    }
    public function cetak(Type $var = null)
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
        return view('kajur.cetak',[
            "kelass"=>$matkul_list
        ]);
    }
    public function Unduh(Request $input){}

    public function verifikasi(Type $var = null)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan = Auth::user()->jurusanKajur;
        foreach ($jurusan as $key => $value) {
            $jurusan = $value->jur_kode;
        }

        $silabus = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                    ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                            ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                            ->join('sil_pengisi','sil_pengisi.mk_kodebaa','aka_matkul_kurikulum.mk_kodebaa')
                            ->where('aka_jurusan.jur_kode',$jurusan)
                            ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode')
                            ->get();
        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk','!=','')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->groupBy('tk_dosen.dosen_kode')
                            ->get();
        return view('kajur.verifikasi',[
            "silabus" => $silabus,
            "dosen" => $dosen
        ]);
    }
}
