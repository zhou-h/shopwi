@extends('Admin.Public.public')
@section('content')
@section('title','管理员添加')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改密码</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/admin123/{{session('uid')}}" method="post" class="mws-form">
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
                              <label class="mws-form-label">原密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="oldpassword" class="small old" value="" placeholder="请输入原密码"><font class="so" style="margin-left: 5px"></font>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small pass" value="" placeholder="设置新密码"><font class="psso" style="margin-left: 5px"></font>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">确认密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="repassword" class="small repass" value="" placeholder="重复密码"><font class="repa" style="margin-left: 5px"></font>
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                    <input type="hidden" name="status" value="0">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
               </form>
          </div>         
      </div>
      <script>
      // alert($);
        var CONN = false;
        var CODD = false; 
        var PASS = false; 
        // 原密码
        $('.old').blur(function(){
          str = $(this).val();
          if(str==''){
           $('.so').html('＊请输入原密码').css('color','red');
            CONN = false;
          }else{
            CONN = true;
          }
        })
        // 新密码
        $('.pass').blur(function(){
          str1 = $(this).val();
          if(str1==''){
           $('.psso').html('*请设置新密码').css('color','red');
            CODD = false;
          }else{
            CODD = true;
          }
        })
        // 重复密码
           $('.repass').blur(function(){
          str2 = $(this).val();
          if(str2==''){
            $('.repa').html('*请输入重复密码').css('color','red');
            PASS = false;
          }else if(str1!=str2){
           $('.repa').html('*重复密码不一致').css('color','red');
            PASS = false;
          }else{
            PASS = true;
          }
        })
           // 表单提交
           $('.mws-form').submit(function(){
            $("input").trigger("blur");
              if(CONN && CODD && PASS){
                return true
              }else{
                return false;
              }
           })
      </script>
@endsection