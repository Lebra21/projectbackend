<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_model extends Model{
    protected $table='category';
    protected $primaryKey = 'id';
    protected $fillabe = 'name';

    protected function create($array){
    	$category = new Category_model;
    	$category ->name = $array['name'];
    	$category->image = $array['image'];

    	$category->save();
    }
}
