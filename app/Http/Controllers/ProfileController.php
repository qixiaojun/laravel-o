<?php

namespace apple\Http\Controllers;

use Illuminate\Http\Request;

use apple\Http\Requests;
use apple\Http\Controllers\Controller;

class ProfileController extends Controller
{
  public function updateProfile(Request $request)
  {
      if ($request->user()) {
          // $request->user() returns an instance of the authenticated user...
      }
  }
}
