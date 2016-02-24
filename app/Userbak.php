<?php

namespace apple;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
//Model implements AuthenticatableContract,AuthorizableContract,CanResetPasswordContract
{
    //use Authenticatable, Authorizable, CanResetPassword;
    // 这个属性是多个快转让的
    // @var array
    protected $fillable = [
        'name', 'email', 'password',
    ];
    // 这个属性排除来自这个模型的JSON格式
    // @var array
    protected $hidden = [
        'password', 'remember_token',
    ];
    // public function tasks()
    // {
    //    return $this->hasMany(Task::class);
    // }
}
