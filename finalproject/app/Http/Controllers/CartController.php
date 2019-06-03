<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Products_model;
use Auth;
class CartController extends Controller
{
    public function index(){
    	$cartItems = Cart::content();
    	return view('cart.index',compact('cartItems'));
    }

    public function addItem($id){
        $product = Products_model::findOrFail($id);
        $cart = Cart::add($id, $product->pro_name, 1,$product->pro_price,['img'=>$product->image,'stock'=>$product->stock]);
        return back();
    }

    public function update(Request $request, $id){
    	$qty = $request->qty;
    	$proID = $request->proId;
    	$product = Products_model::findOrFail($proID);
    	$stock = $product->stock;
    	if($qty<$stock){
    		Cart::update($id,$request->qty);
    		return back()->with('status','Cart is updated');
    	}else{
    		return back()->with('error','Please check your qty is more than product stock');
    	}
    }
    public function destroy($id){
    	Cart::remove($id);
    	return back()->with('deleted');
    }

    public function index2(){
        $cartItems = Cart::content();
        return view('front.navbar',compact('cartItems'));
    }

}
