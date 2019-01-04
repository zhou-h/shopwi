@extends('Admin.Public.public')
@section('content')
@section('title','公告列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
<style>
  .odd{
    border: 1px solid #ccc;
  }
</style>

    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>用户列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/user" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords']}}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">用户名</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">密码</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">状态</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">创建时间</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">修改时间</th>
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
         
         
         <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($data as $row)
            <tr class="odd" align="center"> 
               <td class="  sorting_1" style="border:1px solid #eee">{{$row->id}}</td> 
               <td class=" ">{{$row->username}}</td> 
               <td class=" ">{{$row->password}}</td> 
               <td class=" ">@if($row->status==2) 已激活 @else 未激活 @endif</td> 
               <td class=" ">{{$row->addtime}}</td> 
               <td class=" ">{{$row->uptime}}</td> 
               
               <td class=" "> <span class="btn-group"> 
               <a href="/user/{{$row->id}}" class="btn btn-small del" title="用户详情"><i class="icon-official"></i></a>
              <a href="/address/{{$row->id}}" class="btn btn-small" title="收货地址"><i class="icon-map-marker"></i></a> 
                </span> </td> 
          </tr>
          @endforeach
            </tbody>
        </table>
  <div class="dataTables_info" id="DataTables_Table_0_info">一共4条数据</div>
         <div class="dataTables_paginate paging_full_numbers" id="pages">
         <ul class="pagination">
            {{$data->render()}}
            </ul>
            

        </div>
       </div> 
      </div>
     </div> 
    </div> 
@endsection