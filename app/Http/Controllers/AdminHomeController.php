<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    public function adminLogin(){
        $data['title'] = 'Admin Login';
        return view('admin.admin_login', $data);
    }

    public function admin_login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/admin/dashboard');
        }
        return redirect('/admin/login')->with('danger','Oppes! You have entered invalid credentials');
    }

    public function user_login(Request $request){

    }


}
