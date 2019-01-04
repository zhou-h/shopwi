@extends('Admin.Public.public')
@section('content')
@section('title','站内信列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>

 <!-- 显示添加成功或失败 -->
           @if(session('success'))
           <div class="mws-form-message success">
               {{session('success')}}
           </div>
           @endif
            @if(session('error'))
           <div class="mws-form-message error">
               {{session('error')}}
           </div>
           @endif
    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>站内信列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/letter" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords'] or ''}}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>

        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">编号</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">标题</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">内容</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 188px;">发件人</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">收件人</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">发件时间</th>
          </tr> 
         </thead> 
        <tbody role="alert" aria-live="polite" aria-relevant="all">
            @foreach( $data as $row)
            <tr class="odd"> 
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->content}}</td>
                <td>{{$row->consignee}}</td>
                <td>{{$row->sender}}</td>
                <td>{{date("Y-m-d H:i:s",$row->addtime)}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

         <div class="dataTables_paginate paging_full_numbers" id="pages">
         {{$data->appends($request)->render()}}
        </div>
       </div> 
      </div>
     </div> 
    </div> 
@endsection
 