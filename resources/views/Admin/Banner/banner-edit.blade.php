@extends('Admin.Public.public')
@section('content')
@section('title','轮播图修改')
<!doctype html>
 
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>轮播图修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/banner/{{$data->id}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">图片:</label>
                              <div class="mws-form-item">
                                   <input type="file" class="small" name="pic" value="">
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