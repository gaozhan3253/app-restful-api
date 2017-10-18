<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_login', 'password', 'user_nickname','user_email', 'mobile','status','description', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_pass', 'remember_token',
    ];

    /**
     * 判断邮箱是否存在
     * @param $email
     * @return Model|null|static
     */
    protected static function  findUserEmail($email) {
        return  Member::where('user_email', $email)->first();
    }


    public function carts()
    {
        return $this->hasMany('App\Models\Cart','user_id','id');
    }
}
