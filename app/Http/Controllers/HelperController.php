<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Detail;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public static function category(){
        return Category::all();
    }
    public static function sub_cat(){
        return SubCategory::all();
    }

    public static function total_order(){
        return DB::table('orders')->count();
    }

    public static function complete_order(){
        return DB::table('orders')->where(['payment_status'=>1])->count();
    }

    public static function pending_order(){
        return DB::table('orders')->where(['payment_status'=>0])->count();
    }

    public static function today_order(){
        return DB::table('orders')->whereDate('created_at', Carbon::today())->count();
    }

    public static function total_user(){
        return User::where('userrole', '!=', 0)->count();
    }

    public static function freelancer(){
        return User::where('userrole', '=', 2)->count();
    }

    public static function client(){
        return User::where('userrole', '=', 1)->count();
    }

    public static function reviewed(){
        return DB::table('orders')->where(['review_status'=>1])->count();
    }

}
