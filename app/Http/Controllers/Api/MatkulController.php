<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AkaKelas;
use App\Models\AkaPeriode;
use App\Models\Sil_History;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class MatkulController extends Controller
{
    // --------------------------ADMIN
    public function list(Request $request)
    {
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                    $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                        ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                                ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                                ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode');

        $dosen = TkDosen::where('dosen_status', '1')
                                ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                                ->where('dosen_nama_sk', '!=', '')
                                ->orderBy('tk_karyawan.karyawan_nama','asc')
                                ->get();

        $dosen_matkul_list = SilPengisi::all();
        return DataTables::of($matkul_list)
                            ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                                $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    public function listmatkul(Request $request)
    {
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                    $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                        ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                                ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                                ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode');

        $dosen = TkDosen::where('dosen_status', '1')
                                ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                                ->where('dosen_nama_sk', '!=', '')
                                ->orderBy('tk_karyawan.karyawan_nama','asc')
                                ->get();

        $dosen_matkul_list = SilPengisi::all();
        return DataTables::of($matkul_list)
                            ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                                $actionBtn = view('partial.select2_listmatkul',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    public function pengisikosong(Request $result)
    {
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
                            ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "aka_matkul_kurikulum.kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                            ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode');

        $dosen = TkDosen::where('dosen_status', '1')
                            ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk', '!=', '')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->get();

        $dosen_matkul_list = SilPengisi::all();
        return DataTables::of($matkul_list)
                            ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                                $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    public function slctddosen($kode)
    {
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
                                ->where('sil_pengisi.dosen_kode',$kode)
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "aka_matkul_kurikulum.kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                                ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode');
        $dosen = TkDosen::where('dosen_status', '1')
                ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                ->where('dosen_nama_sk', '!=', '')
                ->orderBy('tk_karyawan.karyawan_nama','asc')
                ->get();
        $dosen_matkul_list = SilPengisi::all();

        return DataTables::of($matkul_list)
                ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                    $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    // ---------------------------------------------------------
    // ----------------------------Kajur
    public function pengisikosongjurusan($jurusan)
    {
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
                            ->where('aka_jurusan.jur_kode',$jurusan)
                            ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "aka_matkul_kurikulum.kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                            ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode');

        $dosen = TkDosen::where('dosen_status', '1')
                            ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                            ->where('dosen_nama_sk', '!=', '')
                            ->orderBy('tk_karyawan.karyawan_nama','asc')
                            ->get();

        $dosen_matkul_list = SilPengisi::all();
        return DataTables::of($matkul_list)
                            ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                                $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                                return $actionBtn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    public function slctddosenjurusan($kode,$jurusan)
    {
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
                                ->where('sil_pengisi.dosen_kode',$kode)
                                ->where('aka_jurusan.jur_kode',$jurusan)
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "aka_matkul_kurikulum.kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                                ->groupBy('aka_matkul_kurikulum.mk_kodebaa','matkul_nama','mk_semester','jur_nama','aka_matkul_kurikulum.kurikulum_kode');
        $dosen = TkDosen::where('dosen_status', '1')
                ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                ->where('dosen_nama_sk', '!=', '')
                ->orderBy('tk_karyawan.karyawan_nama','asc')
                ->get();
        $dosen_matkul_list = SilPengisi::all();

        return DataTables::of($matkul_list)
                ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                    $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function listmatkulkajur($jurusan)
    {
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                            $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                        })
                        ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                        ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                        ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                        ->where('aka_jurusan.jur_kode',$jurusan)
                        ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode")
                        ->groupBy('mk_kodebaa','matkul_nama','mk_semester','jur_nama','kurikulum_kode');

        $dosen = TkDosen::where('dosen_status', '1')
                        ->join('Tk_Karyawan', 'Tk_Karyawan.karyawan_nip', 'Tk_Dosen.karyawan_nip')
                        ->where('dosen_nama_sk', '!=', '')
                        ->orderBy('tk_karyawan.karyawan_nama','asc')
                        ->get();

        $dosen_matkul_list = SilPengisi::all();
        return DataTables::of($matkul_list)
                        ->addColumn('action', function ($row) use ($dosen,$dosen_matkul_list) {
                            $actionBtn = view('partial.select2_dosen',['dosen'=>$dosen,'list_dosen'=>$dosen_matkul_list,'selected'=>$row]);
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function assign(Request $request)
    {
        if (Session::get('admin')) $nama_dosen = "Admin";
        else{
            $nama_dosen = TkDosen::where('dosen_kode',Auth::user()->kodeDosen)->first();
        }
        $now = AkaPeriode::PeriodeSkrg();
        $namadosen = TkDosen::where('dosen_kode',$request->dosen_kode)->first();
        $result = SilPengisi::where('mk_kodebaa',$request->mk_kodebaa)
                                ->where('kurikulum_kode',$request->kurikulum_kode)
                                ->first();
        if ($result==null){
            SilPengisi::create([
                'mk_kodebaa' =>$request->mk_kodebaa,
                'periode_kode'=>$now->periode_kode,
                'dosen_kode'=>$request->dosen_kode,
                'kurikulum_kode'=>$request->kurikulum_kode,
                'pengisi_penugas'=>$nama_dosen->dosen_nama_sk
            ]);
            $hasil = ['message'=>'Sukses assign '.$request->matkul_nama.' dengan '.$namadosen->dosen_nama_sk];
            $isi = "Assign ".$request->matkul_nama.' dengan '.$namadosen->dosen_nama_sk;
        }
        else {
            $nama_dosen_awal = TkDosen::join('sil_pengisi','sil_pengisi.dosen_kode','tk_dosen.dosen_kode')
                                        ->where('sil_pengisi.kurikulum_kode',$request->kurikulum_kode)
                                        ->where('sil_pengisi.mk_kodebaa',$request->mk_kodebaa)
                                        ->first();
            SilPengisi::where('mk_kodebaa',$request->mk_kodebaa)
                        ->where('kurikulum_kode',$request->kurikulum_kode)
                        ->update(['dosen_kode'=>$request->dosen_kode]);
            $hasil = ['message'=>'Berhasil ganti '.$nama_dosen_awal->dosen_nama_sk.' dengan '.$namadosen->dosen_nama_sk];
            $isi ="Mengganti ".$nama_dosen_awal->dosen_nama_sk." pengisi silabus ".$request->matkul_nama.' dengan '.$namadosen->dosen_nama_sk;
        }

        Sil_History::create([
            "dosen_nama_sk" =>$nama_dosen->dosen_nama_sk,
            "isi" => $isi
        ]);
        echo json_encode($hasil);
    }
}
