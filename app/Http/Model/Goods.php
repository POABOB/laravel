<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'p_goods';
    protected $fillable = ['id', 'good_name', 'image', 'numbers', 'price', 'description', 'how_old', 'user_id'];
    protected $primaryKey = 'id';
    protected $timestamp = True;

    // public function goods()
    // {
    // 	return $this->belongsTo(User::class);
    // }
}
