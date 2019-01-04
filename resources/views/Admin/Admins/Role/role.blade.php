@extends('Admin.Public.public')
@section('content')
@section('title','角色列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>


    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>角色列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/role" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords'] or ''}}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">角色</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">状态</th>
           <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">负责模块</th> -->
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
         
         
         <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($role as $row)
          <tr class="odd" align="center"> 
           <td class="  sorting_1">{{$row->id}}</td> 
           <td class=" ">{{$row->name}}</td> 
           <td class="status" sta="{{$row->status}}" style="cursor: pointer;">@if($row->status==0) 启用 @elseif($row->status==1) 关闭 @endif</td>
           <!-- <td class=" ">{{$row->auth}}</td>  -->
           <td class=" "> <span class="btn-group"> 
           <a href="/adminsauth/{{$row->id}}" class="btn btn-small del">分配权限</a>
            <a href="/role/{{$row->id}}/edit" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
            <form action="/role/{{$row->id}}" method="post" style="display:inline;">
                <button type="submit" class="btn btn-small" title="删除"><i class="icon-trash"></i></button> 
                {{csrf_field()}}
                {{method_field("DELETE")}}
            </form> 
            
            </span> </td> 
          </tr>
          @endforeach
                   </tbody>
        </table>

         <div class="dataTables_paginate paging_full_numbers" id="pages">
         <ul class="pagination">
         {{$role->render()}}
            </ul>
         

        </div>
       </div> 
      </div>
     </div> 
    </div>
    <script>
      $('.status').click(function(){
        // 获取角色状态
        sta = $(this).attr('sta');
        // 获取角色id
        id = $(this).parents('tr').find('td:first').html();
        if(sta==0){
          $(this).html('关闭');
        }else if(sta==1){
          $(this).html('启用');
        }
        $.get('/adminstus',{id:id,sta:sta},function(data){
          // alert(data);
        })
        
      })
    </script>
@endsection