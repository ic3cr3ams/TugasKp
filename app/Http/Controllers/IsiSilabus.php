<?php

namespace App\Http\Controllers;

use App\Models\AkaMatkul;
use App\Models\AkaMatkulKurikulum;
use App\Models\Sil_Data;
use App\Models\Sil_History;
use App\Models\SilPengisi;
use App\Models\TkDosen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IsiSilabus extends Controller
{
    public function silabus($kode_dosen,$mk_kodebaa,$kurikulum_kode,$bahasa)
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
        if (Auth::user()->isWarek("1")) {
            return view('wakilrektor.silabus',[
                "kodedosen" => $kode_dosen,
                "mk_kodebaa" =>$mk_kodebaa,
                "periode" => $kurikulum_kode,
                "bahasa" =>$bahasa,
                "status" =>$status,
                "matkul_nama" => $matkul_nama,
                "data" =>$data
            ]);
        }
        else if (Auth::user()->isDekan("")) {
            return view('dekan.silabus',[
                "kodedosen" => $kode_dosen,
                "mk_kodebaa" =>$mk_kodebaa,
                "periode" => $kurikulum_kode,
                "bahasa" =>$bahasa,
                "status" =>$status,
                "matkul_nama" => $matkul_nama,
                "data" =>$data
            ]);
        }
        else if (Auth::user()->isKajur()) {
            return view('kajur.silabus',[
                "kodedosen" => $kode_dosen,
                "mk_kodebaa" =>$mk_kodebaa,
                "periode" => $kurikulum_kode,
                "bahasa" =>$bahasa,
                "status" =>$status,
                "matkul_nama" => $matkul_nama,
                "data" =>$data
            ]);
        }
        else if (Auth::user()->isDosen()) {
            return view('dosen.silabus',[
                "kodedosen" => $kode_dosen,
                "mk_kodebaa" =>$mk_kodebaa,
                "periode" => $kurikulum_kode,
                "bahasa" =>$bahasa,
                "status" =>$status,
                "matkul_nama" => $matkul_nama,
                "data" =>$data
            ]);
        }
        elseif (Session::get('admin')) {
            return view('dosen.silabus',[
                "kodedosen" => $kode_dosen,
                "mk_kodebaa" =>$mk_kodebaa,
                "periode" => $kurikulum_kode,
                "bahasa" =>$bahasa,
                "status" =>$status,
                "matkul_nama" => $matkul_nama,
                "data" =>$data
            ]);
        }
    }
    public function fill(Request $request)
    {
        $r = "";
        if ($request->tm1==null) $tm1="";
        else $tm1 =  $request->tm1;
        if ($request->tm2==null) $tm2="";
        else $tm2 = $request->tm2;
        if ($request->tm3==null) $tm3="";
        else $tm3 = $request->tm3;
        if ($request->tm4==null) $tm4="";
        else $tm4 = $request->tm4;
        if ($request->tm5==null) $tm5="";
        else $tm5 = $request->tm5;
        if ($request->tm6==null) $tm6="";
        else $tm6 = $request->tm6;
        if ($request->tm7==null) $tm7="";
        else $tm7 = $request->tm7;
        if ($request->tm8==null) $tm8="";
        else $tm8 = $request->tm8;
        if ($request->tm9==null) $tm9="";
        else $tm9 = $request->tm9;
        if ($request->tm10==null) $tm10="";
        else $tm10 = $request->tm10;
        if ($request->tm11==null) $tm11="";
        else $tm11 = $request->tm11;
        if ($request->tm12==null) $tm12="";
        else $tm12 = $request->tm12;
        if ($request->tm13==null) $tm13="";
        else $tm13 = $request->tm13;
        if ($request->tm14==null) $tm14="";
        else $tm14 = $request->tm14;
        if ($request->rb1==null) $rb1="";
        else $rb1 =  $request->rb1;
        if ($request->rb2==null) $rb2="";
        else $rb2 =  $request->rb2;
        if ($request->rb3==null) $rb3="";
        else $rb3 =  $request->rb3;
        if ($request->rb4==null) $rb4="";
        else $rb4 =  $request->rb4;
        if ($request->rb5==null) $rb5="";
        else $rb5 =  $request->rb5;

        $materi = $request->materi;
        $tujuan = $request->tujuan;
        $status = $request->status;
        $mk_kodebaa = $request->mk_kodebaa;
        $kurikulum_kode = $request->kurikulum_kode;
        $matkul_nama = AkaMatkul::join('aka_matkul_kurikulum','aka_matkul.matkul_id', 'aka_matkul_kurikulum.matkul_id')
                                ->where('aka_matkul_kurikulum.kurikulum_kode',$kurikulum_kode)
                                ->where('aka_matkul_kurikulum.mk_kodebaa',$mk_kodebaa)
                                ->get('matkul_nama');
        foreach ($matkul_nama as $key => $value) {
            $matkul_nama = $value->matkul_nama;
        }
        if (Auth::user()->kodeDosen==null) $nama_dosen = "Admin";
        else{
            $nama_dosen = TkDosen::where('dosen_kode',Auth::user()->kodeDosen)->get('dosen_nama_sk');
            foreach ($nama_dosen as $key => $value) {
                $nama_dosen = $value->dosen_nama_sk;
            }
        }
        if ($request->bahasa=="i") {
            $bahasa = "Indonesia";

        }else $bahasa = "Inggris";

        if ($status=="0") {
            Sil_Data::create([
                "mk_kodebaa"=>$mk_kodebaa,
                "bahasa"=>$bahasa,
                "kurikulum_kode"=>$kurikulum_kode,
                'materi' =>$materi,
                'tujuan' =>$tujuan,
                "tm_1"=>$tm1,
                "tm_2"=>$tm2,
                "tm_3"=>$tm3,
                "tm_4"=>$tm4,
                "tm_5"=>$tm5,
                "tm_6"=>$tm6,
                "tm_7"=>$tm7,
                "tm_8"=>$tm8,
                "tm_9"=>$tm9,
                "tm_10"=>$tm10,
                "tm_11"=>$tm11,
                "tm_12"=>$tm12,
                "tm_13"=>$tm13,
                "tm_14"=>$tm14,
                "rb_1"=>$rb1,
                "rb_2"=>$rb2,
                "rb_3"=>$rb3,
                "rb_4"=>$rb4,
                "rb_5"=>$rb5,
            ]);
            $r="Sukses mengisi silabus";
            $isi ="Mengisi data silabus ".$matkul_nama."bahasa ".$bahasa;
        }else {
            Sil_Data::where('kurikulum_kode',$kurikulum_kode)
                    ->where('mk_kodebaa',$mk_kodebaa)
                    ->where('bahasa',$bahasa)
                    ->update([
                        'materi' =>$materi,
                        'tujuan' =>$tujuan,
                        "tm_1"=>$tm1,
                        "tm_2"=>$tm2,
                        "tm_3"=>$tm3,
                        "tm_4"=>$tm4,
                        "tm_5"=>$tm5,
                        "tm_6"=>$tm6,
                        "tm_7"=>$tm7,
                        "tm_8"=>$tm8,
                        "tm_9"=>$tm9,
                        "tm_10"=>$tm10,
                        "tm_11"=>$tm11,
                        "tm_12"=>$tm12,
                        "tm_13"=>$tm13,
                        "tm_14"=>$tm14,
                        "rb_1"=>$rb1,
                        "rb_2"=>$rb2,
                        "rb_3"=>$rb3,
                        "rb_4"=>$rb4,
                        "rb_5"=>$rb5,
                    ]);
            $r = "Update berhasil";
            $isi = "Mengubah data silabus ".$matkul_nama." bahasa ".$bahasa;
        }
        if ($bahasa=="Indonesia") {
            SilPengisi::where('kurikulum_kode',$kurikulum_kode)
                        ->where('mk_kodebaa',$mk_kodebaa)
                        ->update([
                            "sd_status_ind" =>1
                        ]);
        }else {
            SilPengisi::where('kurikulum_kode',$kurikulum_kode)
                        ->where('mk_kodebaa',$mk_kodebaa)
                        ->update([
                            "sd_status_eng" =>1
                        ]);
        }
        Sil_History::create([
            "dosen_nama_sk" =>$nama_dosen,
            "isi" => $isi
        ]);
        $result =[
            "hasil" =>$r,
            "value" =>1,
        ];
        echo json_encode($result);
    }

    public function verif(Request $request)
    {
        if ($request->bahasa=="i") $bahasa="indoensia";
        else $bahasa = "inggris";
        if($request->status=="3")   {if ($request->bahasa=="i") $resp = ["sd_status_ind"=>'3'];
                                    else $resp = ["sd_status_eng"=>"3"];
                                    $msg = "Berhasil verifikasi silabus bahasa ".$bahasa." ".$request->matkul_nama;
                                    $isi = "Memverifikasi silabus bahasa ".$bahasa." ".$request->matkul_nama;}
        else    {if ($request->bahasa=="i") $resp = ["sd_status_ind"=>'2'];
                else $resp = ["sd_status_eng"=>'2'];
                $msg="Berhasil Tolak silabus bahasa ".$bahasa." ".$request->matkul_nama;
                $isi = "Menolak silabus bahasa ".$bahasa." ".$request->matkul_nama;}

        $nama_dosen = TkDosen::where('dosen_kode',Auth::user()->kodeDosen)->get('dosen_nama_sk');
        foreach ($nama_dosen as $key => $value) {
            $nama_dosen = $value->dosen_nama_sk;
        }

        Sil_History::create([
            "dosen_nama_sk" =>$nama_dosen,
            "isi" => $isi
        ]);
        SilPengisi::where('mk_kodebaa',$request->mk_kodebaa)
                    ->where('kurikulum_kode',$request->kurikulum_kode)
                    ->update($resp);
        $hasil=[
            "message"=>$msg
        ];
        echo json_encode($hasil);
    }
}
