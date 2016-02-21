@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="/css/admin/admin.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/css/admin/master.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/jquery-easyui/themes/bootstrap/easyui.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/jquery-easyui/themes/icon.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/asset/font-awesome/css/font-awesome.min.css" media="screen" charset="utf-8">
@stop
@section('js')
<script src="/asset/jquery/node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="/asset/jquery-easyui/jquery.easyui.min.js" charset="utf-8"></script>
    <script src="/asset/jquery-easyui/locale/easyui-lang-zh_CN.js" charset="utf-8"></script>
    <script src="/js/admin/list.js" charset="utf-8"></script>
@stop
@section('body')
<table id="user"></table>
  <div id="edit">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <td>
            管理员ID
          </td>
          <td>
            管理员帐号
          </td>
          <td>
            管理员密码
          </td>
          <td>
            操作
          </td>
        </tr>
      </thead>
      <tbody>
          @foreach ($lists as $list)
          <tr>
            <td>{{ $list->id }}</td>
            <td>{{ $list->manager }}</td>
            <td>{{ $list->password }}</td>
            <td>
              <a href="/admin/{{ $list->id }}/edit"><i class="fa fa-edit"></i> 修改</a>
              <a href="/admin/{{ $list->id }}/delete"><i class="fa fa-trash"></i> 删除</a>
            </td>
          </tr>
          @endforeach
      </tbody>
      <!-- @foreach ($fas as $fa)
      <div style="width:30%;float:left"><i class="fa {{ $fa->classname }}"></i> <input type="input" style="width:260px" class="ui input huge" value="<i class=&quot;fa {{ $fa->classname }}&quot;></i>"></div>
      @endforeach -->
    </table>
  </div>
@stop
