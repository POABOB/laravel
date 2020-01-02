<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'p_carts';
    protected $fillable = ['user_id','good_id'];
    protected $primaryKey = 'user_id';
    public $timestamps = false;

}

