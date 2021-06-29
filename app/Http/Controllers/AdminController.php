<?php

namespace App\Http\Controllers;

use App\Exports\datajurusan;
use App\Exports\history;
use App\Models\AkaJurusan;
use App\Models\AkaKelas;
use App\Models\AkaMatkulKurikulum;
use App\Models\AkaPeriode;
use App\Models\Sil_Data;
use App\Models\Sil_Dosen_Makul;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use App\Models\TkKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $dosen = TkDosen::where('dosen_status','1')
                        ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                        ->where('dosen_nama_sk','!=','')
                        ->orderBy('tk_karyawan.karyawan_nama','asc')
                        ->get();
        return view('admin.home',[
            "dosen" => $dosen
        ]);
    }
    public function pilihdosen(Request $request)
    {
        $dosen_kode =$request->username;
        $nama = TkDosen::where('dosen_kode',$dosen_kode)->get('dosen_nama_sk');
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
        return view('admin.logdosen',[
            'dosen_kode' => $dosen_kode,
            'nama' => $nama,
            'kelass' =>$matkul_list
        ]);
    }

    public function matakuliah(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan=AkaJurusan::select('jur_nama','jur_kode')->get();
        $studi= AkaMatkulKurikulum::select("kurikulum_kode")->distinct()->get();
        return view('admin.matakuliah',[
            "studi" => $studi,
            "jurusan" => $jurusan
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
            $semua =  AkaKelas::join('aka_matkul_kurikulum',function($q){
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
        $dosen = TkDosen::where('dosen_status','1')
                            ->join('Tk_Karyawan','Tk_Karyawan.karyawan_nip','Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk','!=','')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->groupBy('tk_dosen.dosen_kode')
                            ->get();

        return view('admin.Assign',[
            "listdosen" => $dosen
        ]);
    }

    public function silabus($dosen_kode,$mk_kodebaa,$kurikulum_kode,$bahasa)
    {
        if ($bahasa=="i") {
            $status =  SilPengisi::where('mk_kodebaa',$mk_kodebaa)
                                ->where('kurikulum_kode',$kurikulum_kode)
                                ->get('sd_status_ind');
        } else  $status =  SilPengisi::where('mk_kodebaa',$mk_kodebaa)
                            ->where('kurikulum_kode',$kurikulum_kode)
                            ->get('sd_status_eng');
        $data = Sil_Data::where('mk_kodebaa',$mk_kodebaa)
                            ->where('kurikulum_kode',$kurikulum_kode)
                            ->get();
        $matkul_nama = AkaMatkulKurikulum::where('aka_matkul_kurikulum.mk_kodebaa',$mk_kodebaa)
                                        ->join('aka_matkul','aka_matkul.matkul_id','aka_matkul_kurikulum.matkul_id')
                                        ->where('aka_matkul_kurikulum.kurikulum_kode',$kurikulum_kode)
                                        ->get();
        $nama =         $nama = TkDosen::where('dosen_kode',$dosen_kode)->get('dosen_nama_sk');
        // dd($status);
        return view('admin.silabus',[
            "kodedosen" => $dosen_kode,
            "mk_kodebaa" =>$mk_kodebaa,
            "periode" => $kurikulum_kode,
            "bahasa" =>$bahasa,
            "status" =>$status,
            "matkul_nama" => $matkul_nama,
            "data" =>$data,
            "nama" => $nama
        ]);
    }
    public function doUpload(Request $request)
    {
        $request->validate(
            ['myFile' => 'required|mimes:pdf,docx,doc,png,jpg,ppt,pptx']
        );
        $nama = 'Pedoman.'.$request->file('myFile')->getClientOriginalExtension();;
        $path =$request->file('myFile')->move('Pedoman', $nama);
        return redirect()->back()->with('success','Berhasil upload file pedoman silabus');
    }
    public function report(Request $input){
        return view('admin.report');
    }
    public function xlsx(Type $var = null)
    {
        return Excel::download(new history, 'history.xlsx');

    }
    public function csv(Type $var = null)
    {
        return Excel::download(new history, 'history.csv');
    }
    public function export(Type $var = null)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $jurusan=AkaJurusan::select('jur_nama','jur_kode')->get();
        return view('admin.export',[
            "jurusan" => $jurusan
        ]);
    }
    public function reportxlsx(Request $request)
    {
        return Excel::download(new datajurusan($request->username), 'data.xlsx');

    }
}
