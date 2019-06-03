<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products_model;

class SliderController extends Controller{
	 public function update(Request $request, $id){
        $product = Products_model::find($id);
    }
       
}
