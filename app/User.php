<?php

namespace apple;

use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
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
