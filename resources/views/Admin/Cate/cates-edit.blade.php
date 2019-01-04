@extends('Admin.Public.public')
@section('content')
@section('title','分类管理')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>分类修改</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/cate/{{$cate->id}}" method="post" class="mws-form">
                    <div class="mws-form-inline">
                        <div class="mws-form-row">
                            <label class="mws-form-label">类名</label>
                            <div class="mws-form-item">
                            <input type="text" class="large" name="name" value={{$cate->name}} /></div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">父名</label>
                            <div class="mws-form-item">
                                <select class="large" name="pid">
                                  <option value="{{$cate->pid}}" >{{$class}}</option>
                                  @foreach($data as $row)
                                    @if($pid==$row->id)
                                      <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                      @else
                                      <option value="{{$row->id}}">{{$row->name}}</option>
                                      @endif
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">是否显示</label>
                            <div class="mws-form-item">
                                <select class="large" name="display">
                                   @if($cate->display=='显示')
                                   <option value="0" >显示</option>
                                   <option value="1">隐藏</option>
                                   @else
                                   <option value="1" >隐藏</option>
                                   <option value="0" >显示</option>
                                   @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    {{ method_field('PUT') }}
                    {{csrf_field()}}
                    <div class="mws-button-row">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
               </form>
          </div>         
      </div>
@endsection