<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'p_category';
    protected $fillable = ['id', 'category'];
    protected $primaryKey = 'id';
    protected $timestamp = Flase;
}
