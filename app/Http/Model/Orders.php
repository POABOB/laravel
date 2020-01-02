<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'p_orders';
    protected $fillable = ['id', 'created_at', 'cash', 'seller_id', 'buyer_id', 'updated_at', 'status'];
    protected $primaryKey = 'id';
    protected $timestamp = True;
}
