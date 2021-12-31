<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DashboardCotroller extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function dashboard()
    {
        if(Auth::check()){
            $data['title'] = 'Dashboard';
            $data['details'] = Detail::where('user_id', Auth::user()->id)->first();
            $data['gigs'] = Gig::where('user_id', Auth::user()->id)->get();
            $data['orders'] = Order::where('client_id', Auth::user()->id)->get();

            return view('dashboard', $data);
        }else{
            return redirect("login")->with('danger', 'Opps! You do not have access');
        }
    }

    public function profile(){
        $data['title'] = 'Profile';
        $data['userDetails'] = Detail::where('user_id', Auth::user()->id)->first();
        return view('profile', $data);
    }

    public function save_profile(Request $request){
        $details = new Detail;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST['action'] == 'save'){
                $imageName = $request->file('image');
                $new_name = $imageName->getClientOriginalName();
                $request->image->move(public_path('/assets/img/'), $new_name);
                $details->image = $new_name;
                $details->State = $request->state;
                $details->country = $request->country;
                $details->description = $request->description;
                $details->user_id = Auth::user()->id;

                $query = $details->save();
                if ($query){
                    return redirect()->back()->with('success', 'Details added Successfully');
                }
            }elseif ($_POST['action'] == 'edit'){
                $id = Auth::user()->id;
                $state = $request->state;
                $country = $request->country;
                $description = $request->description;
                $imageName = $request->file('image');
                $new_name = $imageName->getClientOriginalName();
                $request->image->move(public_path('/assets/img/'), $new_name);
                $image = $new_name;

                $query = Detail::where('user_id', $id)->update(['image'=>$image, 'State'=>$state,
                    'country'=>$country, 'description'=>$description,
                    ]);
                if($query){
                    return redirect()->back()->with('success', 'Gig Edited Successfully');
                }
            }
        }
    }

    public function my_order(){
        $data['title'] = 'My Order';
        $data['details'] = Detail::where('user_id', Auth::user()->id)->first();
        $data['orders'] = Order::where('user_id', Auth::user()->id)->get();

        return view('my_order', $data);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
