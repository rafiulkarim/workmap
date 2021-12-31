<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function review_rating(Request $request){
        $data = $request->all();
        $this->review_create($data);
        Order::where('id', $request->order_id)->update(['review_status'=>1]);
        return redirect()->back();
    }

    public function review_create(array $data){
        return Review::create([
            'freelancer_id' => $data['freelancer_id'],
            'client_id' => $data['client_id'],
            'gig_id' => $data['gig_id'],
            'rating' => $data['rating'],
            'review' => $data['review']
        ]);
    }

}
