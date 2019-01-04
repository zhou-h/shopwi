@extends('Admin.Public.public')
@section('content')
@section('title','权限分配')
<html>
 <head></head>
<script src="/static/jquery-1.8.3.min.js"></script>
 <body> 
  <div class="container"> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/saveauth" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">角色信息</label> 
       <div class="mws-form-item clearfix"> 
        <h4>当前角色: {{$role->name}} 的角色信息</h4> 
        <ul class="mws-form-list inline">
        @foreach($node as $row)
         <li><input  type="checkbox" name="nids[]" value="{{$row->id}}" @if(in_array($row->id,$nids)) checked  @endif/> <label>{{$row->name}}</label>
         <!-- <input id="s" type="checkbox" name="name[]" value="{{$row->name}}" style="display: block;"> -->
         </li>
         @endforeach 
        </ul> 
       </div> 
      </div> 
     </div> 
     <div class="mws-button-row">
       {{csrf_field()}} 
      <input type="hidden" name="rid" value="{{$role->id}}" /> 
      <input value="分配角色" class="btn btn-danger" type="submit" /> 
      <input value="Reset" class="btn " type="reset" /> 
     </div> 
    </form> 
   </div> 
   <!-- Panels End --> 
  </div>
 </body>
 <script>
  $('input[checked]').next().css('color','red');
 </script>
</html>
@endsection