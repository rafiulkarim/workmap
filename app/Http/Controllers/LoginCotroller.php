<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCotroller extends Controller
{
    public function login(){
        $data['title'] = 'Login';
        return view('login', $data );
    }

    public function login_process(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard ');
        }

        return redirect("login")->with('danger','Oppes! You have entered invalid credentials');
    }
}
