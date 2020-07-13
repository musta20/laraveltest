<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SerCatModel extends Model
{
    protected $table = "service_cat";
 
    protected $fillable = ['cat_id','service_id'];
    public $timestamps = false;
}
