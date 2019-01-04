@extends('Admin.Public.public')
@section('content')
@section('title','角色列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>

<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>角色添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/role" method="post" class="mws-form" onsubmit="return check()">
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
                              <label class="mws-form-label">角色名:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="name" value="{{old('name')}}">
                              </div>
                         </div>
                         
                         <div class="mws-form-row" >

                              <label class="mws-form-label">赋予权限:</label>
                              <div style="width: 850px;margin-left: 150px">
                              <ul class="mws-form-list inline">
                              @foreach($node as $row)
                                <li><input type="checkbox" name="nids[]" value="{{$row->id}}"/> <label>{{$row->name}}</label></li>
                              @endforeach
                                
        </ul></div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <select name="status" id="">
                                <option value="0">启用</option>
                                <option value="1">禁止</option>
                              </select>
                         </div>
                    </div>
                    <div class="mws-button-row">
                    <input type="hidden" name="status" value="0">
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    {{csrf_field()}}
               </form>
          </div>         
      </div>
      <script>
        function check(){
          $a= $('.small').val();
          if($a==""){
            alert("请输入角色"); 
            $('.small').focus; 
          return false;//false:阻止提交表单 
          }
        }
      </script>
@endsection