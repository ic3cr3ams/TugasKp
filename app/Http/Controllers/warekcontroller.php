<?php

namespace App\Http\Controllers;

use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use App\Models\Sil_Data;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use PDF;


class warekcontroller extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan=AkaJurusan::select('jur_nama','jur_kode')->get();
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();

            return view('wakilrektor.home',[
                "studi" => $studi,
                "jurusan" => $jurusan
            ]);
    }
    public function matkulwarek()
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
        return view('wakilrektor.matkulwarek',[
        "kelass"=>$matkul_list,
        "dosen_kode" =>$dosen_kode
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

        $kelass = AkaKelas::join('aka_matkul_kurikulum',function($q){
                                $q->on('aka_matkul_kurikulum.mk_kode','aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode','aka_kelas.jur_kode');
                            })
                            ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                            ->join('tk_dosen','aka_kelas.dosen_kode','tk_dosen.dosen_kode')
                            ->join('aka_jurusan','aka_kelas.jur_kode','aka_jurusan.jur_kode')
                            ->where('aka_jurusan.jur_fakultas',$fakultas)
                            ->orderBy('jur_fakultas')
                            ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode')
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

        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->leftJoin('sil_pengisi','sil_pengisi.dosen_kode','tk_dosen.dosen_kode')
                            ->where('dosen_nama_sk','!=','')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->select('*')
                            ->selectRaw('count(sil_pengisi.dosen_kode) as jumlah')
                            ->groupBy('tk_dosen.dosen_kode')
                            ->get();
        $silpengisi = SilPengisi::all();
        return view('wakilrektor.dekanwarek',[
        "kelass" => $kelass,
        "studi" => $studi,
        "jurusan" => $jurusan,
        "silpengisi" => $silpengisi,
        "dosen" =>$dosen
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
        return view('wakilrektor.cetak',[
            "kelass"=>$matkul_list
        ]);
    }

    public function export(Type $var = null)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan=AkaJurusan::select('jur_nama','jur_kode')->get();
        return view('wakilrektor.export',[
            "jurusan" => $jurusan
        ]);
    }
    public function reportxlsx(Request $request)
    {
        return Excel::download(new datajurusan($request->username), 'data.xlsx');

    }



    public function cetakpdf(Request $request)
    {
        $mk_kodebaa = Str::substr($request->kode, 0, 5);
        $kurikulum = Str::substr($request->kode, 5, 9);
        $data = Sil_Data::where('mk_kodebaa',$mk_kodebaa)
                        ->where('kurikulum_kode',$kurikulum)
                        ->get();
        $matkul_nama = AkaMatkulKurikulum::join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                            ->where('aka_matkul_kurikulum.kurikulum_kode',$kurikulum)
                                            ->where('mk_kodebaa',$mk_kodebaa)
                                            ->first();
                                            // dd($matkul_nama);
        $pdf = PDF::loadview('pdf',['silabus'=>$data,"nama"=>$matkul_nama]);
        return $pdf->stream();
    }
}
