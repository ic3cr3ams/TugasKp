<?php

namespace App\Http\Controllers;

use App\Models\TkDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        Session::forget("jurusan");
        Session::forget("kurikulum");
        $dosen = TkDosen::select('dosen_kode','dosen_nama_sk')
                        ->where('dosen_status','1')
                        ->where('dosen_nama_sk','!=','')
                        ->get();
        return view('admin.home',[
            "dosen" => $dosen
        ]);
    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }
    public function Deskripsi(Request $input){}
    public function Pengisian(Request $input){}
}
