<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products_model;
use App\Category_model;
use App\Slider_model;
use App\User;
use App\Role_model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index(){
        $products = Products_model::paginate(4);
        $categories = Category_model::all();
        return view('admin.product.index', compact("products", 'categories'));

    }
    public function create(){
        $categories = Category_model::pluck('name','id');
        return view('admin.product.create', compact('categories'))->with('msg','Successfully added');
    }
    public function show($id){
        $product = Products_model::find($id);
        $categories = Category_model::all();
        return view('admin.product.updateProduct',compact('product','id', 'categories'))->with('msg','Successfully updated');  
    }
    public function showAdmin($id){
        $product = Products_model::find($id);
        $categories = Category_model::all();
        return view('admin.product.updateProduct',compact('product','id', 'categories'))->with('msg','Successfully updated');  
    }
    public function productDetail($id){
        $products = DB::table('products')->where('id',$id)->limit(1)->get();
        return view('front.productDetail', compact('products'));
    }
    public function change(Request $request){
        $inputChange = $request;
        Slider_model::create($inputChange);
        return redirect()->back()->with('msg','Successfully changed');;
    }
    public function store(Request $request)
    {
        $formInput = $request->except('image');
        $this->validate($request, [
            'pro_name' => 'required',
            'pro_code' => 'required',
            'pro_price' => 'required|numeric',
            'pro_info' => 'required',
            'stock' => 'required|numeric',
            
            'category_id' => 'required',
            'image' => 'image|mimes:png, jpg,jpd,jpeg|max:10000'
        ]);

        $image = $request->image;

        if ($image) {
            $imageName = $image->getClientOriginalName();
            $image->move('images',$imageName);
            $formInput['image'] = $imageName;
        }
        Products_model::create($formInput);
        return redirect()->back()->with('msg','Successsss');
    }

    public function search(Request $request){
        $name = $request->input('search');
        $products = DB::table('products')->where('pro_name','LIKE','%' . $name . '%')->orWhere('pro_info','LIKE','%' . $name . '%')->get();
        return view('admin.product.search', compact('products'));
    }
    




    public function update(Request $request, $id){
        $slider = Slider_model::find($id);
        $slider->label = $request->get('label');
        $slider->text = $request->get('text');
        if(!empty($request->get('image'))){
            $slider->image= $request->get('image');
        }
        else{
            $slider->image = $request->get('image1');
        }

        $slider->save();
        return back();
        
    }
    
    public function destroy($id){
        $deleteData = Products_model::findOrFail($id);
        $deleteData-> delete();

        return redirect()->back()->with('cass','Deleted');
    }
    public function edit($id){
        $slides = Slider_model::find($id);
        return view('admin.product.edit', compact('slides','id'));
    }
    public function slider(){
        $slides = Slider_model::all();
        return view('admin.product.slider', compact("slides"))->with('msg','Update');
    }
    public function userPagination(){
        $users = User::paginate(15);
        return view('admin.product.userPagination')->with('users',$users);
    }
      public function cartGraph(){
        return view('admin.product.cartGraph');
    }

   public function filter(Request $request){
     $data = $request->all();
     echo "<pre>"; print_r($data); die;
   }
   public function databaseView(){
        return view('admin.product.databaseView');
    }
    public function role(){
        $roles = Role_model::all();
        return view('admin.product.role');
    }
}

