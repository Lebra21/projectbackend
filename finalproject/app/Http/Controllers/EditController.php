<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products_model;
use App\User;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function show($id)
    {
        $users = User::find($id);
        return view('admin.product.updateUser',compact('users','id'))->with('msg','Successfully updated');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id){
        $product = Products_model::find($id);
        $product->pro_name = $request->get('pro_name');
        $product->pro_info = $request->get('pro_info');
        $product->pro_code = $request->get('pro_code');
        $product->pro_price = $request->get('pro_price');
        $product->stock = $request->get('stock');
        $product->size = $request->get('size');
        $product->category_id = $request->get('category_id');

        if(!empty($request->get('image'))){
            $product->image= $request->get('image');
        }
        else{
            $product->image = $request->get('image1');
        }

        $product->save();
        return back()->with('status','Product is updated');
    }
    public function update(Request $request, $id){
       $user = User::find($id);
       $status = $request->get('status');
       DB::table('users')->where('id',$id)->update(['admin'=>$status]);
       return back()->with('massa', 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
