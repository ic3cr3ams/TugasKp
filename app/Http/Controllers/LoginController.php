<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $input){
        if ($input->username == "adminbaak" && $input->pass == "useradmin123") {
            return view("admin.Home");
        }
        else if ($input->username == "dosen" && $input->pass == "dosen") {
            return view("dosen.Home");
        }
        else if ($input->username == "kajur" && $input->pass == "kajur") {
            return view("kajur.Home");
        }
        else if ($input->username == "dekan" && $input->pass == "dekan") {
            return view("dekan.Home");
        }
        else if ($input->username == "wakil" && $input->pass == "wakil") {
            return view("wakil.Home");
        }
    }
}
