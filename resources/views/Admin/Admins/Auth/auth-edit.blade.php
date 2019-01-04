@extends('Admin.Public.public')
@section('content')
@section('title','权限修改')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>权限修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/nodeauth/{{$data->id}}" method="post" class="mws-form">
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
                              <label class="mws-form-label">权限名:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="name" value="{{$data->name}}" placeholder="权限名称">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">控制器:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="mname" class="small" value="{{$data->mname}}" placeholder="例：AdminController">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">方法:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="aname" class="small" value="{{$data->aname}}" placeholder="例：index">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <select name="status" id="">
                                <option value="0" @if(($data->status)==0) selected @endif>启动</option>
                                <option value="1" @if(($data->status)==1) selected @endif>禁止</option>
                              </select>
                         </div>
                    </div>
                    <div class="mws-button-row">
                         <input type="submit" class="btn btn-danger" value="修改">
                         
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
               </form>
          </div>         
      </div>
@endsection