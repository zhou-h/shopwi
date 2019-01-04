@extends('Admin.Public.public')
@section('content')
@section('title','发送站内信')
<!doctype html>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>发送站内信</span>
          </div>
          <div class="mws-panel-body no-padding">
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
          @if(session('error'))
           <div class="mws-form-message error">
               {{session('error')}}
           </div>
           @endif
               <form action="/letter" method="post" class="mws-form">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">标题:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="title" value="{{old('title')}}" required>
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">收件人:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="sender" class="small" value="{{old('sender')}}" required>
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">内容:</label>
                              <div class="mws-form-item">
                                   <textarea name="content" class="small" required>{{old('content')}}</textarea>
                              </div>
                         </div>
                   
                    </div>
                    <div class="mws-button-row">
                    {{csrf_field()}}
                         <input type="hidden" name="consignee" value="管理者">
                         <input type="hidden" name="addtime" value="{{time()}}">
                         <input type="submit" class="btn btn-danger" value="发送">
                         <input type="reset" class="btn " value="重置">
                    </div>
                   
               </form>
          </div>         
      </div>
@endsection
