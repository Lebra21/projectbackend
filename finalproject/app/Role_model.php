<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_model extends Model
{
    protected $table='role';
    protected $id='id';
    protected $fillable=['name'];
}
