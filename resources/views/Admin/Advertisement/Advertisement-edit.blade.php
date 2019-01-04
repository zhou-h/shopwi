@extends('Admin.Public.public')
@section('content')
@section('title','广告修改')
<!doctype html>
          @if(session('error'))
           <div class="mws-form-message error">
               {{session('error')}}
           </div>
           @endif
            
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>广告修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/advertisement/{{$data->id}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">链接:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="url" value="{{$data->url}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">联系人:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="name" class="small" value="{{$data->name}}">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">标题:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="title" class="small" value="{{$data->title}}">
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
                         {{method_field("PUT")}}
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    
               </form>
          </div>         
      </div>
@endsection