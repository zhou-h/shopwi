@extends('Admin.Public.public')
@section('content')
@section('title','广告添加')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>广告添加</span>
          </div>
          <div class="mws-panel-body no-padding">
           <!-- 显示表单验证错误 -->
          @if (count($errors) > 0)
               <div class="mws-form-message error">
                    <ul>
                    @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                    @endforeach
                    </ul>
               </div>
          @endif
               <form action="/advertisement" method="post" class="mws-form" enctype="multipart/form-data">
                                   <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">联系人:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="name" value="{{old('name')}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">链接:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="url" class="small" value="{{old('url')}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">是否显示:</label>
                              <div class="mws-form-item">
                                   <select name="display">
                                        <option value="0">不显示</option>
                                        <option value="1">显示</option>
                                   </select>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">标题:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="title" class="small" value="{{old('title')}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">内容:</label>
                              <div class="mws-form-item">
                                   <input type="file" name="content" class="small">
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                         {{csrf_field()}}
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection