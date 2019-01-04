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
               <form action="/goods" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">商品名:</label>
                              <div class="mws-form-item" style="width:900px;">
                                   <input type="text" class="small" name="name" value="{{old('name')}}" >
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">类别:</label>
                              <div class="mws-form-item" style="width:500px;">
                              <select class="large" name="type_id">
                                  <option disabled >--请选择--</option>
                                  @foreach($type as $row)
                                      <option value="{{$row->id}}">{{$row->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">图片:</label>
                              <div class="mws-form-item" style="width:500px;">
                                   <input type="file" name="pic" class="small" value="" >
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">描述:</label>
                              <div class="mws-form-item">                                   
                                   <textarea rows="10" cols="60" name='descr' maxlength="400"  placeholder="请填写400字以下的描述!">{{old('descr')}}</textarea>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item" style="width:500px;">
                                   <select class="large" name="static">
                                        <option value="0">显示</option>
                                        <option value="1">隐藏</option>
                                </select>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">价格(￥):</label>
                              <div class="mws-form-item" style="width:900px;">
                                   <input type="text" name="price" class="small" value="{{old('price')}}" placeholder="单位:RMB">
                              </div>
                         </div>
                         <input type="hidden" name="sales" class="small" value="0">
                         <input type="hidden" name="recom" class="small" value="3">
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