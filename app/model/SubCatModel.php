<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SubCatModel extends Model
{
    protected $table = "sub_cat";
    protected $primaryKey  = "id";
    protected $fillable = ['id','sub_Cat'];
    public $timestamps = false;
}
