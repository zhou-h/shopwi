@extends('Admin.Public.public')
@section('content')
@section('title','权限添加')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>权限添加</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/nodeauth" method="post" class="mws-form">
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
                                   <input type="text" class="small name" name="name" value="{{old('name')}}" placeholder="权限名称"><font class="names" style="color: red;margin-left: 5px"></font>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">控制器:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="mname" class="small node" value="{{old('mname')}}" placeholder="例：AdminController"><font class="names" style="color: red;margin-left: 5px"></font>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">方法:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="aname" class="small for" value="" placeholder="例：index"><font class="names" style="color: red;margin-left: 5px"></font>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <select name="status" id="">
                                <option value="0">启动</option>
                                <option value="1">禁止</option>
                              </select>
                         </div>
                    </div>
                    <div class="mws-button-row">
                         <input type="submit" class="btn btn-danger" value="添加">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    {{csrf_field()}}
               </form>
          </div>         
      </div>
      <script>
        var UNP = false;
        var OOP = false;
        var DDS = false;
        // 权限名
        $('.name').blur(function(){
            str = $(this).val();
            if(str==''){
                $(this).next().html('*请输入权限名称');
                UNP=false;
            }else{
              UNP = true;
            }
        })
        // 控制器
        $('.node').blur(function(){
            str1 = $(this).val();
            if(str1==''){
                $(this).next().html('*请输入控制器名');
                OOP=false;
            }else{
              OOP = true;
            }
        })
        // 方法
        $('.for').blur(function(){
            str2 = $(this).val();
            if(str2==''){
                $(this).next().html('*请输入方法');
                DDS=false;
            }else{
                DDS = true;
            }
        })
        // 表单提交
        $('.mws-form').submit(function(){
          $("input").trigger("blur");
          if(UNP && OOP && DDS){
            return true;
          }else{
            return false;
          }
        })
      </script>
@endsection