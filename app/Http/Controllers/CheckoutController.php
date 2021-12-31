<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout($id){
        $data['title'] = 'Checkout';
        $data['gig'] = Gig::where('id', $id)->first();
        return view('checkout', $data);
    }

    public function checkout_change(Request $request){
        $subtotal = $request->price * $request->qty;
        $html = 'Subtotal: <b  class="float-right" id="subtotal">$'.$subtotal.'</b><br>';
        return $html;
    }
}
