@extends('Admin.Public.public')
@section('content')
@section('title','商品列表')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>商品添加</span>
          </div>
            @if (count($errors) > 0)
            <div class="mws-form-message warning">
              <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
              </div>
              </div>
            @endif
          <div class="mws-panel-body no-padding">
               <form action="/sizedoadd" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">颜色:</label>
                              <div class="mws-form-item" style="width:900px;">
                                  <input type="text" class="color" name="color" value="{{old('color')}}" >
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">库存:</label>
                              <div class="mws-form-item" style="width:500px;">
                                  <input type="text" class="store" name="store" value="{{old('store')}}" >
                              </div>
                         </div>
                         <input type="hidden" name="good_id" class="small" value="{{$id}}">
                    </div>
                    {{csrf_field()}}
                    <div class="mws-button-row">
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection