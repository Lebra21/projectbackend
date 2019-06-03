<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider_model extends Model{
	protected $table='slider';
    protected $primaryKey = 'id';
    protected $fillabe =['label','text','image'];
    protected $hidden = [
        'token',
    ];

    protected function create($array){
    	$slider = new Slider_model;
    	$slider -> label = $array['label'];
    	$slider -> text = $array['text'];
    	$slider -> image = $array['image'];
    	$slider -> save();
    }
    
}
