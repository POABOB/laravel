<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\User;
class SocialAccount extends Model
{
    protected $table = 'p_social_accounts';
    protected $fillable = [
    	'user_id', 'provider_id', 'provider_name'
    ];
    protected $primaryKey = 'id';
    protected $timestamp = True;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
