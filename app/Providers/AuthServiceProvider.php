<?php

namespace apple\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'apple\Model' => 'apple\Policies\ModelPolicy',
    ];

    //注册任何应用程序的身份验证和授权服务
    //@param  \Illuminate\Contracts\Auth\Access\Gate  $gate
    //@return 无效
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        // Auth::extend('riak', function($app) {
        //   //返回一个实例Illuminate\Contracts\Auth\UserProvider...
        //   return new RiakUserProvider($app['riak.connection']);
        // });
    }
    //注册绑定的容器
    //@return 无效
    public function register()
    {
        //
    }
}
