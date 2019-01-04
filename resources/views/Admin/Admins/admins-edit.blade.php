@extends('Admin.Public.public')
@section('content')
@section('title','管理员添加')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>管理员添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admins/{{$data->id}}" method="post" class="mws-form">
                         @if (count($errors)>0)
                  <div class="mws-form-message error">
                    <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                         <li>
                            {{$error}}
                         </li>
                         @endforeach
                    </ul>
                  </div>
                 </div>   
                 @endif
                                   <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">管理员:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="username" value="{{$data->username}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">确认密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="repassword" class="small" value="">
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                    <input type="hidden" name="status" value="0">
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
               </form>
          </div>         
      </div>
@endsection