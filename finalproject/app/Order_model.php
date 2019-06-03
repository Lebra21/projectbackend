<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products_model;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;	

class Order_model extends Model
{
    protected $table='orders';
    protected $primaryKey='id';
    protected $fillable=['total','status','user_id'];

    public function orderFields(){
    	return $this->belongsToMany(Products_model::class)->withPivot('qty','total');
    }

    public static function createOrder(){
    	$user=Auth::user();
    	$order=$user->orders()->create(['total'=>Cart::total(),'status'=>'pending']);
    	$cartItems=Cart::content();

    	foreach($cartItems as $cartItem){
    		$order->orderFields()->attach($cartItem->id,['qty'=>$cartItem->qty,'tax'=>Cart::tax(),'total'=>$cartItem->qty*$cartItem->price]);
    	}
    }
}
