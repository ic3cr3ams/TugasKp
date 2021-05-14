<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $input){
        Auth::attempt(
            $input->only('username','password')
        );
        // dd(Auth::user()->isDekan(""));
        if ($input->username == "adminbaak" && $input->pass == "useradmin123") {
            return view("admin.Home");
        }
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
            else return redirect('/')->with(['pesan'=>'Gagal Login']);
        }else{
            return redirect('/')->with(['pesan'=>'Gagal Login']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
