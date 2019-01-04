@extends('Admin.Public.public')
@section('content')
@section('title','公告列表')
<!doctype html>
<meat charset="utf-8">
<script src="/static/jquery-1.8.3.min.js"></script>
<style>
  .odd{
    border: 1px solid #ccc;
  }
</style>
    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>公告列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/notice" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords'] or ''}}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
          <th class="checkbox-column">
               <input type="checkbox">
            </th>
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">标题</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">内容</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">状态</th>
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
         
         
         <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($data as $row)
          <tr class="odd" align="center">
          <td class="checkbox-column">
              <input type="checkbox">
            </td> 
           <td class="sorting_1" style="border:1px solid #eee" >{{$row->id}}</td>
           <td class=" ">{{$row->title}}</td> 
           <td class=" ">{!!$row->content!!}</td> 
           <td class="status" style="cursor: pointer;" sta="{{$row->status}}">{{$row->status}}</td> 
           
           <td class=" "> <span class="btn-group"> 
            <a href="/notice/{{$row->id}}/edit" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
            <!-- <a href="javascript:void(0)" class="btn btn-small del"><i class="icon-trash"></i></a> -->
            <form action="/notice/{{$row->id}}" method="post" style="display:inline;">
                <button type="submit" class="btn btn-small" title="删除"><i class="icon-trash"></i>
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    </button> 
            </form> 
            </span></td> 
          </tr>
          @endforeach
         </tbody>
        </table>
        <button class="btn btn-danger delete" style="margin-top: 2px">批量删除</button>
         <div class="dataTables_paginate paging_full_numbers" id="pages">
         <ul class="pagination">{{$data->appends($request)->render()}}
            </ul>  
        </div>
       </div> 
      </div>
     </div> 
    </div> 
    <script>
      $('.del').click(function(){
        // 获取要删除的id
        id = $(this).parents('tr').find('td:eq(1)').html();
        // 获取数据所在的tr
        s = $(this).parents('tr');
        ss = confirm('你确定删除吗？');
        if(ss){
          $.get('/nodel',{id:id},function(data){
            if(data==1){
              // 数据所在的tr从页面删除 
              s.remove();
            }
          });
        }
      });


      // 批量删除
      $('.delete').click(function(){
        d = [];
        // 获取删除的id
        // 遍历
        $(':checkbox').each(function(){
          if($(this).attr('checked')){
            id = $(this).parent().next().html();
            // alert(id);
            // 添加到数组
            d.push(id);
          }
        });
        // console.log(d);
        // ajax
        dd = confirm('你确定删除吗？');
        if(dd){
        $.get("/pdel",{'d':d},function(ust){
          if(ust==1){
            // 把选中的数据所在tr 移出 remove
            // 遍历
            for(var i=0;i<=d.length;i++){
              $(':checked').parents('tr').remove();
            }
          }else{
            alert(ust);
          }
        });
        }
      });
      // 修改状态
      $('.status').click(function(){
        id = $(this).parents('tr').find('td:eq(1)').html();
        // alert(id);
        // 获取状态
        // sta = $(this).html();
        // 获取公告id
        dd = $(this).html();
        if(dd=='禁用'){
          $(this).html('激活');
          sta = 1;
        }else if(dd=='激活'){
          $(this).html('禁用');
          sta = 0;
        }

        $.get('/nostatus',{id:id,sta:sta},function(data){
          // alert(data);
        },'json')
      })
    </script>
@endsection