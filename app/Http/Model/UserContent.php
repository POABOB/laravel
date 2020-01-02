<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserContent extends Model
{
    protected $table = 'p_users';
    // protected $fillable = ['student_id', 'password', 'name', 'cellphone', 'birthday', 'right', 'avatar', 'update_at'];

    protected $timestamp = True;

    public function socialAccount()
    {
    	return $this->hasMany(SocialAccount::class);
    }
}
