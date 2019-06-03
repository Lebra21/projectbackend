<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class Products_model extends Model{
    protected $table='products';
    protected $primaryKey = 'id';
    protected $fillabe =['pro_name','pro_code','pro_price', 'size','image', 'pro_info','spl_price', 'stock', 'category_id'];
    protected $hidden = [
        'password', 'token',
    ];


    protected function create($array)
    {
        $product = new Products_model;
        $product-> pro_name = $array['pro_name'];
        $product-> pro_code = $array['pro_code'];
        $product-> pro_price = $array['pro_price'];
        $product-> image = $array['image'];
        $product-> pro_info = $array['pro_info'];
        $product-> size = $array['size'];
        $product-> spl_price = $array['spl_price'];
        $product-> category_id = $array['category_id'];
        $product-> stock = $array['stock'];

        $product-> save();
    }

}
