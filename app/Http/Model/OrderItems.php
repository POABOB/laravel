<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'p_orderitems';
    protected $fillable = ['idOrder', 'user_id', 'good_id', 'numbers'];
    protected $primaryKey = 'idOrder';

    public $timestamps = false;
}
