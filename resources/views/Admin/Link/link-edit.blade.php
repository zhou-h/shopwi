@extends('Admin.Public.public')
@section('content')
@section('title','友情链接修改')
<!doctype html>

@if(session('error'))
           <div class="mws-form-message error">
               {{session('error')}}
           </div>
           @endif
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>友情链接修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/link/{{$data->id}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">标题:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="title" value="{{$data->title}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">链接:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="url" class="small" value="{{$data->url}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">联系人:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="name" class="small" value="{{$data->name}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">电话:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" class="small" value="{{$data->phone}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">类型:</label>
                              <div class="mws-form-item">
                                   @if($data->type==0)
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1">生活类</option>
                                        <option value="2">文学类</option>
                                        <option value="3">新闻类</option>
                                        <option value="4">体育类</option>
                                        <option value="5">其他</option>
                                   </select>
                                   @elseif($data->type==1)
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1" selected>生活类</option>
                                        <option value="2">文学类</option>
                                        <option value="3">新闻类</option>
                                        <option value="4">体育类</option>
                                        <option value="5">其他</option>
                                   </select>
                                   @elseif($data->type==2)
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1">生活类</option>
                                        <option value="2" selected>文学类</option>
                                        <option value="3">新闻类</option>
                                        <option value="4">体育类</option>
                                        <option value="5">其他</option>
                                   </select>
                                   @elseif($data->type==3)
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1">生活类</option>
                                        <option value="2">文学类</option>
                                        <option value="3" selected>新闻类</option>
                                        <option value="4">体育类</option>
                                        <option value="5">其他</option>
                                   </select>
                                   @elseif($data->type==4)
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1">生活类</option>
                                        <option value="2">文学类</option>
                                        <option value="3">新闻类</option>
                                        <option value="4" selected>体育类</option>
                                        <option value="5">其他</option>
                                   </select>
                                   @else
                                   <select name="type">
                                        <option value="0">游戏类</option>
                                        <option value="1">生活类</option>
                                        <option value="2">文学类</option>
                                        <option value="3">新闻类</option>
                                        <option value="4">体育类</option>
                                        <option value="5" selected>其他</option>
                                   </select>
                                   @endif
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">logo:</label>
                              <div class="mws-form-item">
                                   <input type="file" name="logo" class="small">
                              </div>
                         </div>                         
                    </div>
                    <div class="mws-button-row">
                    {{csrf_field()}}
                    {{method_field("PUT")}}
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection