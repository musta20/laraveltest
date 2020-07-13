<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = "service";
    protected $primaryKey  = "id";
    protected $fillable = ['id','name','description','Requirements','price'];
    public $timestamps = false;
}
