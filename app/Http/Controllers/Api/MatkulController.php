<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AkaKelas;
use App\Models\AkaPeriode;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MatkulController extends Controller
{
    public function list(Request $request)
    {
        $matkul_list = AkaKelas::join('aka_matkul_kurikulum', function ($q) {
                                    $q->on('aka_matkul_kurikulum.mk_kode', 'aka_kelas.mk_kode')
                                        ->on('aka_matkul_kurikulum.jur_kode', 'aka_kelas.jur_kode');
                                })
                                ->join('aka_matkul', 'aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->join('tk_dosen', 'aka_kelas.dosen_kode', 'tk_dosen.dosen_kode')
                                ->join('aka_jurusan', 'aka_jurusan.jur_kode', 'aka_kelas.jur_kode')
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode");

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
                                ->select("aka_matkul_kurikulum.mk_kodebaa", "matkul_nama", "mk_semester", "jur_nama", "kurikulum_kode", "dosen_nama_sk","tk_dosen.dosen_kode");

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

    public function assign(Request $request)
    {
        $now = AkaPeriode::PeriodeSkrg();
        SilPengisi::create([
            'mk_kodebaa' =>$request->mk_kodebaa,
            'periode_kode'=>$now->periode_kode,
            'dosen_kode'=>$request->dosen_kode,
            'kurikulum_kode'=>$request->kurikulum_kode,
            'pengisi_penugas'=>'admin'
        ]);
        $hasil = [
                    'message'=>'Sukses mengganti dosen',
                    'status'=>200,
                    "payload"=>[
                        "mk_kodebaa" => $request->mk_kodebaa,
                        "dosen_kode" => $request->dosen_kode,
                        "now" => $now->periode_kode
                    ]
                ];
        echo json_encode($hasil);
    }
}
