<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products_model;
use App\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use App\Slider_model;
use App\Wishlist_model;
use Mail;
use App;
use Lang;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

   public function show ($id){
        
   }
  

    public function logout(Request $request) {
      Session::forget('cart');
      Auth::logout();
      return redirect('/login');
    }
    public function index(){
        $products = Products_model::paginate(4);
        $sliders = Slider_model::all();
        $get1 = $sliders->filter(function($item){
            return $item->id == 1;
        })->first();
        $get3 = $sliders->filter(function($item){
            return $item->id == 3;
        })->first();

        $get2 = $sliders->filter(function($item){
            return $item->id == 2;
        })->first();
        
        
        return view('front.home', compact('products', 'get1','get3','get2'));
    }


    public function about(){
        return view('front.about');
    }

    public function search(Request $request){
        $name = $request->input('search');
        $products = DB::table('products')->where('pro_name','LIKE','%' . $name . '%')->orWhere('pro_info','LIKE','%' . $name . '%')->get();
        return view('front.search', compact('products'));
    }
    public function searchAdmin(Request $request){
        $name = $request->input('search');
        $products = DB::table('products')->where('pro_name','LIKE','%' . $name . '%')->orWhere('pro_info','LIKE','%' . $name . '%')->get();
        return view('admin.search', compact('products'));
    }
    public function shop() {

        $products = Products_model::paginate(4);
        return view('front.shop', compact('products'));
    }
    public function showCategory($id){
        $category_products=Products_model::where('category_id',$id)->get();
        $id_ = $id;
        return view('front.categoryList', compact('category_products', 'id_'));

    }
   

//wishlist
    public function Wishlist(){
        $products=DB::table('wishlist')->leftJoin('products','wishlist.pro_id','=','products.id')->get();
        return view('front.wishlist',compact('products'));
    }
    public function addWishlist(Request $request){
        $wishlist = new Wishlist_model();
        $wishlist->user_id=Auth::user()->id;
        $wishlist->pro_id=$request->pro_id;

        $wishlist->save();
        $products=DB::table('products')->where('id',$request->pro_id);
        return view('front.productDetail',compact('products'));
    }
    public function removeWishlist($id){
        DB::table('wishlist')->where('pro_id','=',$id)->delete();
        return back()->with('msg','Item Removed from Wishlist');
    }
    
    public function changeLocal($local){
        session(['local'=>$local]);
        return redirect()->back();
    }
}
