<?php

namespace apple\Http\Controllers\Admin;

use Illuminate\Http\Request;

use apple\Http\Requests;
use apple\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use apple\Http\Controllers\Auth\AuthController;
class AdminController extends AuthController
{
    public function index()
    {
      $users = DB::table('users')->get();
      foreach ($users as $user)
      {
        p($user->name);
      }
    }
}
