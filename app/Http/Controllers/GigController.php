<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChatRequest;
use App\Models\Detail;
use App\Models\Gig;
use App\Models\Order;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GigController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create_gig(){
        $data['title'] = 'Create Gig';
        $data['categories'] = Category::all();
        return view('create_gig', $data);
    }

    public function sub_cat($id){
        $datas = SubCategory::where('cat_id', $id)->get();
        $html = '<option disabled selected>Select</option>';
        foreach ($datas as $data){
            $html = $html.'<option value="'.$data->id.'">'.$data->name.'</option>';
        }
        return $html;
    }

    public function process_gig(Request $request){
        $gig = new Gig;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST['action'] == 'create'){
                $gig->title = $request->title;
                $imageName = $request->file('image');
                $new_name = $imageName->getClientOriginalName();
                $request->image->move(public_path('/assets/img/gig'), $new_name);
                $gig->image = $new_name;
                $gig->description = $request->description;
                $gig->price = $request->price;
                $gig->delivery_time = $request->time;
                $gig->status = 0;
                $gig->cat_id = $request->category;
                $gig->sub_cat_id = $request->sub_cat;
                $gig->user_id = Auth::user()->id;

                $query = $gig->save();

                if($query){
                    return redirect()->back()->with('success', 'Gig added Successfully');
                }
            }elseif ($_POST['action'] == 'edit'){
                $id = $request->gig_id;
                $title = $request->title;
                $gig = Gig::find($id);
                if($request->hasFile('image')){
                    $destination = 'assets/img/gig/'.$gig->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $imageName = $request->file('image');
                    $new_name = $imageName->getClientOriginalName();
                    $request->image->move(public_path('/assets/img/gig'), $new_name);
                    $image = $new_name;
                }
                $description = $request->description;
                $price = $request->price;
                $delivery_time = $request->time;
                $cat_id = $request->category;
                $sub_cat_id = $request->sub_cat;

                $query = Gig::where('id', $id)->update(['title'=>$title, 'image'=>$image, 'description'=>$description,
                    'price'=>$price, 'delivery_time'=>$delivery_time, 'cat_id'=>$cat_id, 'sub_cat_id'=>$sub_cat_id]);
                if($query){
                    return redirect()->back()->with('success', 'Gig Edited Successfully');
                }
            }else{
                $id = $request->delete_id;
                $gig = Gig::find($id);
                if($request->hasFile('image')) {
                    $destination = 'assets/img/gig/' . $gig->image;
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                }
                $query = Gig::where('id', $id)->delete();
                if ($query){
                    return response()->json(array('data'=>200));
                }
            }
        }
    }

    public function gig_active($id){
        $data = Gig::where('id', $id)->update(['status' => 1]);
        if ($data){
            return response()->json(array("data" => true));
        }else{
            return response()->json(array("data" => false));
        }
    }

    public function gig_inactive($id){
        $data = Gig::where('id', $id)->update(['status' => 0]);
        if ($data){
            return response()->json(array("data" => true));
        }else{
            return response()->json(array("data" => false));
        }
    }

    public function single_gig_view($id){
        $data['title'] = 'Single gig';
        $data['details'] = Detail::where('user_id', Auth::user()->id)->first();
        $data['reviews'] = Review::where('gig_id', $id)->get();
        $rating = Review::where('gig_id', $id)->get();
        $rating_arr = [];
        foreach ($rating as $a){
            array_push($rating_arr, $a['rating']);
        }
        if (count($rating_arr) == 0){
            $data['rating'] = 0;
        }else{
            $data['rating'] = array_sum($rating_arr)/count($rating_arr);
        }
        $data['order'] = Order::where('gig_id', $id)->get()->count();
        $data['single_gig_datas'] = Gig::where('id', $id)->first();
        return view('single_gig', $data);
    }

    public function edit_gig($id){
        $data['title'] = 'Edit gig';
        $data['gig_data'] = $get_data = Gig::where('id', $id)->first();
        $data['categories'] = Category::all();
        $data['subcategories'] = SubCategory::where('cat_id', $get_data->cat_id)->get();
        return view('gig_edit', $data);
    }

    public function category_gig($id){
        $cat = Category::where('id', $id)->first();
        $data['title'] = $cat->name;
        $data['breadcumb'] = $cat->name;
        $data['cat_id'] = $cat->id;
        $data['sub_cat_id'] = 0;
        $data['gigs'] = Gig::where(['cat_id'=>$id, 'status'=>0])->get();
        return view('category_wise_gig', $data);
    }

    public function subcategory_gig($id){
        $sub_cat = SubCategory::where('id', $id)->first();
        $data['title'] = $sub_cat->category->name.' - '.$sub_cat->name;
        $data['breadcumb'] = $sub_cat->category->name.' / '.$sub_cat->name;
        $data['sub_cat_id'] = $sub_cat->id;
        $data['cat_id'] = $sub_cat->cat_id;
        $data['gigs'] = Gig::where(['sub_cat_id'=>$id, 'status'=>0])->get();
        return view('category_wise_gig', $data);
    }

    public function delivery_time(){
        $cat_id = request()->get('cat_id');
        $sub_cat_id = request()->get('sub_cat_id');
        $delivery_id = request()->get('delivery_id');
        if ($sub_cat_id == 0){
            $datas = Gig::with('giguser')
                ->where('cat_id', '=', $cat_id)
                ->where('delivery_time', '<=', $delivery_id)->get();

            if($datas){
                return response()->json(array('data'=>$datas));
            }
        }else{
            $datas = Gig::with('giguser')
                ->where('sub_cat_id', '=', $sub_cat_id)
                ->where('delivery_time', '<=', $delivery_id)->get();

            if($datas){
                return response()->json(array('data'=>$datas));
            }
        }

    }

    public function min_max_search(){
        $min = request()->get('min');
        $max = request()->get('max');
        $cat_id = request()->get('cat_id');
        $sub_cat_id = request()->get('sub_cat_id');

        if ($sub_cat_id == 0){
            $datas = Gig::with('giguser')
                ->where('cat_id', '=', $cat_id)
                ->where('price', '>=', $min)
                ->where('price', '<=', $max)->get();

            if($datas){
                return response()->json(array('data'=>$datas));
            }
        }else{
            $datas = Gig::with('giguser')
                ->where('sub_cat_id', '=', $sub_cat_id)
                ->where('price', '>=', $min)
                ->where('price', '<=', $max)->get();

            if($datas){
                return response()->json(array('data'=>$datas));
            }
        }
    }

//    public function local_seller(){
//        $local_seller = request()->get('local_seller');
//        $cat_id = request()->get('cat_id');
//        $sub_cat_id = request()->get('sub_cat_id');
//
////        $country = Detail::where('country', $local_seller)->get();
//
//        if ($sub_cat_id == 0){
//            $datas = Gig::with(['giguser' => function($product) use ($local_seller) {
//                $product->where('country', $local_seller)->get();
//            }])->where('cat_id', $cat_id)->get();
//            dd($datas);
//        }
//
//    }

    public function cart(){
        $data['title'] = 'Cart';
        return view('cart', $data);
    }

    public function addToCart($id){
        $gig = Gig::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $gig->id,
                "user_id" => $gig->user_id,
                "title" => $gig->title,
                "quantity" => 1,
                "price" => $gig->price,
                "image" => $gig->image
            ];
        }
        session()->put('cart', $cart);
        return response()->json(array('data'=>200));
    }

    public function itemUpdate(Request $request){
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(array('data'=>200));
        }
    }

    public function removeItem(Request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(array('data'=>200));
        }
    }

    public function confirmPlaceOrder(Request $request){
        $cart = session()->get('cart');
        foreach ($cart as $cartData){
            $query = User::where('id', $cartData['user_id'])->first();
            DB::table('orders')->insert(['gig_id'=>$cartData['id'], 'user_id'=>$query['id'],
                'client_id'=>Auth::user()->id, 'payment_status'=>0, 'review_status'=>0,
                'qty'=>$cartData['quantity'], 'subtotal'=> $cartData['price']*$cartData['quantity'],
                'created_at' => date('Y-m-d H:i:s')]);
            $chatRequest = ChatRequest::where(['client_id'=>Auth::user()->id, 'freelancer_id'=>$cartData['user_id']])
                ->first();
            $request_data = array(Auth::user()->id, $cartData['user_id']);
            if (!$chatRequest){
                $this->chat_request($request_data);
            }
            $email = $query['email'];
            $data = array('name'=>'Workmap');
            Mail::send('email.jobmail', $data, function($message) use($email){
                $message->to($email);
                $message->subject('You are Hired');
            });
        }
        $request->session()->forget('cart');
        return response()->json(array('data'=>200));
    }

    public function chat_request(array $request_data){
        return ChatRequest::create([
            'client_id' => $request_data[0],
            'freelancer_id' => $request_data[1]
        ]);
    }

    public function gig_report(Request $request){
        $client_id = request()->get('client_id');
        $freelancer_id = request()->get('freelancer_id');
        $gig_id = request()->get('gig_id');
        $message = request()->get('report_msg');

        $query = DB::table('reports')
            ->insert(['client_id'=>$client_id, 'freelancer_id'=>$freelancer_id, 'gig_id'=>$gig_id,
                'message'=>$message, 'created_at'=>date("Y-m-d H:i:s")]);
        if ($query){
            return response()->json(array('data'=>200));
        }
    }

    public function test(){
        return 0;
    }
}
