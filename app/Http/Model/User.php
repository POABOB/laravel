<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\SocialAccount;
class User extends Model
{
    protected $table = 'p_users';
    protected $fillable = ['name','email','avatar', 'right', 'update_at', 'create_at'];
    protected $primaryKey = 'id';
    protected $timestamp = True;

    public function socialAccount()
    {
    	return $this->hasMany(SocialAccount::class);
    }
}
