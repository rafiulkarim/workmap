<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        if(Auth::check()){
            $data['title'] = 'Dashboard';
            return redirect('dashboard');
        }
        $data['title'] = 'Home';
        return view('home', $data);
    }

    public function test(){
        return view('email.emailVerificationEmail');
    }
}
