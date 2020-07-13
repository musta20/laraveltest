<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CatModel extends Model
{
    protected $table = "categories";
    protected $primaryKey  = "id";
    protected $fillable = ['id','cat_name'];
    public $timestamps = false;
}


