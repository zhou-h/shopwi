@extends('Admin.Public.public')
@section('content')
@section('title','修改公告')
<!doctype html>
<html>
<head></head>
<script type="text/javascript" charset="utf-8" src="/article/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/article/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/article/lang/zh-cn/zh-cn.js"></script>
    <body>
<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改公告</span>
          </div>
          <div class="mws-panel-body no-padding">
               <form action="/notice/{{$data->id}}" method="post" class="mws-form">
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
                              <label class="mws-form-label">标题:</label>
                              <div class="mws-form-item">
                                   <input type="text" class="small" name="title" value="{{$data->title}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">内容</label>
                              <!-- <div class="mws-form-item">
                                   <textarea name="content" id="" cols="90" rows="10">{{old('content')}}</textarea>
                              </div> -->
                              <script id="editor" type="text/plain" name='content' style="width:1024px;height:500px;margin-left: 150px">{!!$data->content!!}</script>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态:</label>
                              <div class="mws-form-item">
                                   <select name="status" id="">
                                        <option value="0" name="status">启用</option>
                                        <option value="1" name="status">禁止</option>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <div class="mws-button-row">
                         <input type="submit" class="btn btn-danger" value="修改">
                         <input type="reset" class="btn " value="重置">
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
               </form>
          </div>         
      </div>
      <script type="text/javascript">
        //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
      </script>
@endsection