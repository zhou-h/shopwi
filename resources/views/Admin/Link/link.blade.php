@extends('Admin.Public.public')
@section('content')
@section('title','友情链接列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>友情链接列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/link" method="get">
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
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">链接</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 188px;">状态</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">联系人</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">电话</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">类型</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">logo</th>
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
            <tr class="odd"> 
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->url}}</td>
                <td>
                    @if($row->status ==0 )
                        <select name="status" class="status">
                            <option value="0">隐藏</option>
                            <option value="1">显示</option>
                        </select>
                    @else
                        <select name="status" class="status">
                            <option value="1">显示</option>
                            <option value="0">隐藏</option>
                        </select>
                    @endif
                </td>
                <td>{{$row->name}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->type}}</td>
                <td><img src="{{$row->logo}}" width="50px"></td>
               
                <td class=" "> <span class="btn-group"> 
                <a href="/link/{{$row->id}}/edit" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-small del" title="删除"><i class="icon-trash"></i></a>
                </span> </td> 
            </tr>
        @endforeach  
        <!-- Ajax修改状态 -->
        <script>
        $('.status').change(function(){
            // alert(1);
            // 获取改变的值
            status = $('.status').val();
            // alert(status);
            // 获取id
            id=$(this).parents("tr").find("td:first").html();
            // alert(id);
            // Ajax修改状态
            $.get('/adminlinkdoedit',{id:id,status:status},function(data){
                // alert(data);
                if (data==1) {
                    alert('修改成功');
                }else{
                    alert('修改失败');
                    window.location.reload();
                }
            });
        });
        </script>
        <!-- ajax删除   -->
        <script>
            $('.del').click(function(){
                // alert(1);
                id=$(this).parents("tr").find("td:first").html();
                // alert(id);
                s=$(this).parents("tr");
                // alert(s);
                // //Ajax
                ss = confirm('你确定要删除吗？');
                if (ss) {
                    $.get('/adminlinkdel',{id:id},function(data){
                    // alert(data);
                    if(data==1){
                        alert("删除成功");
                        //把删除数据所在的tr从dom里移除
                        s.remove();
                    }else{
                        alert("删除失败");
                    }
                    });
                }
            });
        </script>                   
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
 