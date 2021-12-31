<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gig;
use App\Models\Report;
use App\Models\SubCategory;
//use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'is_admin']);
    }

    public function admin_dashboard(){
        $data['title'] = 'Dashboard';
        return view('admin.dashboard', $data);
    }

    public function adminCategoryList(){
        $data['title'] = 'Category list';
        $data['categories'] = Category::all();
        return view('admin.admin_category_list', $data);
    }

    public function adminEditCategory($id){
        $data['title'] = 'Edit Category';
        $data['category'] = Category::where('id', $id)->first();
        return view('admin.editcategory', $data);
    }

    public function adminAddCategory(){
        $data['title'] = 'Add Category';
        return view('admin.addcategory', $data);
    }

    public function adminCategory(Request $request){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if ($_POST['action'] == 'create'){
                $cat = new Category;
                $cat->name = $request->name;

                $query = $cat->save();
                if ($query){
                    return redirect()->back()->with('success', 'Category Added Successfully');
                }
            }elseif ($_POST['action'] == 'edit'){
                $id = $request->cat_id;
                $name = $request->name;

                $query = Category::where('id', $id)->update(['name'=>$name]);
                if ($query){
                    return redirect()->back()->with('success', 'Category Updated Successfully');
                }
            }
        }
    }

    public function adminDeleteCategory($id){
        $query = Category::where('id', $id)->delete();
        if ($query){
            return response()->json(array('data'=>200));
        }
    }

    public function adminSubCategoryList(){
        $data['title'] = 'Sub Category list';
        $data['sub_categories'] = SubCategory::all();
        return view('admin.adminsubcategory', $data);
    }

    public function adminAddsubCategory(){
        $data['title'] = 'Sub Category list';
        $data['categories'] = Category::all();
        return view('admin.add_sub_Category', $data);
    }

    public function edit_sub_category($id){
        $data['title'] = 'Edit Sub-category';
        $data['sub_cat'] = SubCategory::where('id', $id)->first();
        $data['categories'] = Category::all();
        return view('admin.edit_sub_category', $data);
    }

    public function adminsubcategory(Request $request){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if ($_POST['action'] == 'create'){
                $sub_cat = new SubCategory;
                $sub_cat->name = $request->name;
                $sub_cat->cat_id = $request->cat_id;
                $query = $sub_cat->save();
                if($query){
                    return redirect()->back()->with('success', 'Sub category Added Successfully');
                }
            }elseif ($_POST['action'] == 'edit'){
                $id = $request->sub_cat;
                $sub_cat_name = $request->name;
                $cat_id = $request->cat_id;
                $query = SubCategory::where('id', $id)->update(['name'=>$sub_cat_name, 'cat_id'=>$cat_id]);
                if ($query){
                    return redirect()->back()->with('success', 'Sub Category Edited Successfully');
                }
            }
        }
    }

    public function delete_subcategory($id){
        $query = SubCategory::where('id', $id)->delete();
        if ($query){
            return response()->json(array('data'=>200));
        }
    }

    // user login for review
    public function user_login(){
        $data['title'] = 'User Login';
        return view('admin.user_login', $data);
    }

    public function user_login_process(Request $request){
        $user = User::where('email', $request->email)->first();
        Auth::login($user);
        if ($user){
            return redirect('dashboard');
        }
    }

    // report list
    public function report_list(){
        $data['title'] = 'Report list';
        $data['reports'] = Report::orderBy('id', 'DESC')->get();
        return view('admin.report_list', $data);
    }

    public function report_view($id){
        $data['title'] = 'Single Report View';
        $data['report'] = Report::where('id', $id)->first();
        return view('admin.single_report_view', $data);
    }

    public function admin_logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}
