<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Registration extends Controller
{
    public function registration(){
        $data['title'] = 'Registration';
        return view('registration', $data);
    }

    public function registration_process(Request $request)
    {
        $data = $request->all();
        $checkUser = User::where('email', $data['email'])->first();
        if ($checkUser){
            return redirect()->back()->with('danger', 'Email Already exists');
        }else{
            $createUser = $this->create($data);
            $token = Str::random(64);
            UserVerify::create([
                'user_id' => $createUser->id,
                'token' => $token
            ]);
            Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            return redirect('/registration/verify-email')->with('success','Almost done, Check your email and active your account');
        }
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'userRole' => $data['user_type']
        ]);
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        return redirect()->route('login')->with('success', $message);
    }

    public function verify_email(){
        $data['title'] = 'Verify Email';
        return view('verify_email', $data);
    }
}
