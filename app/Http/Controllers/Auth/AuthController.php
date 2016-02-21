<?php

namespace apple\Http\Controllers\Auth;

use apple\User;
use Validator;
use apple\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    //注册和登录控制器
    //这个控制器处理新用户的注册,以及现有用户的身份验证。
    //默认情况下,该控制器使用一个简单的添加这些行为特征。你为什么不探索吗?
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    //重定向用户登录/注册后在哪里
    //@var string
    protected $redirectTo = '/';
    // protected $redirectPath = '/dashboard';
    // protected $loginPath = '/login';
    //创建一个新的身份验证控制器实例
    //@return void
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'logout']);
      // if (Auth::check())
      // {
      //     p(The user is logged in...);
      // }else{
      //   p('请先登录');
      //   redirect('/auth/login');
      // }

      //$this->authenticate();
    }
    public function getLogin()
    {
      # code...
    }
    public function postLogin()
    {
      # code...
    }
    public function getLogout()
    {
      # code...
    }
    public function authenticate(Request $request)
    {
      $email = $request->input('email');
      $password = $request->input('password');
      if (Auth::attempt(['email' => $email, 'password' => $password]))
      {
          return redirect()->intended('dashboard');
      }
    }
    //得到一个验证器传入登记请求
    //@param  array  $data
    //@return \Illuminate\Contracts\Validation\Validator
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    //创建一个新的用户实例后,一个有效的登记
    //@param  array  $data
    //@return User
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function check(Request $request)
    {
      // p($request->input('manager'));
      // p($request->input('password'));
      $manager = $request->input('manager');
      $password = Hash::make($request->input('password'));
      if (Auth::attempt(['username' => $manager, 'password' => $password ]))
      {
        return '1';
      }else{
        return '2';
      }

    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
        //return Socialite::driver('github')->scopes(['scope1', 'scope2'])->redirect();
        //return Socialite::driver('google')->with(['hd' => 'example.com'])->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        // OAuth Two Providers
        $token = $user->token;

        // OAuth One Providers
        // $token = $user->token;
        // $tokenSecret = $user->tokenSecret;

        // All Providers
        $uid = $user->getId();
        $nickname = $user->getNickname();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $domain = 'www.qixiaojun.com';
        $create = Carbon::now();
        $last_login = Carbon::now();
        $last_ip = ('0.0.0.0');
        //return $uid.$nickname.$name.$email.$avatar;
        $id = DB::table('user')->insertGetId(
          array(
            'uid' => $uid,
            'nickname' => $nickname,
            'name' => $name,
            'email' => $email,
            'avatar' => $avatar,
            'domain' => $domain,
            'create' => $create,
            'last_login' => $last_login,
            'last_ip' => $last_ip
          )
        );
        if($id){
          return redirect('admin/index');
        }else{
          return redirect('admin/login');
        }

    }
}
