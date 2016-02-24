@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="/css/admin/admin.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/font-awesome/css/font-awesome.min.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css" media="screen" charset="utf-8">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
@stop
@section('body')
@section('body_attr')id="app-layout"@stop
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Laravel
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">首页</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登录</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>登出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@yield('content')
@section('js')
<script src="/asset/jquery/node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="/asset/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
@show{{-- body区域javscript脚本 --}}
@stop
@section('footer')
@show{{-- 尾部申明区域 --}}
