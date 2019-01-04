@extends('Admin.Public.public')
@section('content')
@section('title','轮播图添加')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>轮播图添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/banner" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
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
                         <div class="mws-form-row">
                              <label class="mws-form-label">图片:</label>
                              <div class="mws-form-item">
                                   <input type="file" class="small" name="pic" value="">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                   <select name="status">
                                        <option value="0" selected>禁用</option>
                                        <option value="1">启用</option>
                                   </select>
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