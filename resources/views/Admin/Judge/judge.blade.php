@extends('Admin.Public.public')
@section('content')
@section('title','评论列表')
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
            <span><i class="icon-table"></i>评论列表</span> 
            <div class="mws-collapse-button mws-inset">
            <span></span>
            </div>

            <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div>
        </div> 
    <div class="mws-panel-inner-wrap">
        <div class="mws-panel-body no-padding"> 
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                <form action="/judge" method="get">
                    <div class="dataTables_filter" id="DataTables_Table_0_filter">
                        <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords'] or ''}}"></label>
                        <input type="submit" value="搜索">
                    </div>
                </form>
                <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
                     <thead> 
                        <tr role="row">
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">编号</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">商品编号</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">评论内容</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">用户编号</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">评价</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">评论时间</th>
                            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
                        </tr> 
                </thead> 

                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($data as $row)
                        <tr class="odd"> 
                            <td class="  sorting_1">{{$row->id}}</td> 
                            <td class=" ">{{$row->goods_id}}</td> 
                            <td class=" ">{!!$row->judge!!}</td>
                            <td class=" ">{{$row->user_id}}</td> 
                            <td class=" ">{{$row->status}}</td> 
                            <td class=" ">{{$row->addtime}}</td> 
                            <td class=" ">
                                <span class="btn-group"> 
                                    <a href="javascript:void(0)" class="btn btn-small del" title="删除"><i class="icon-trash"></i></a>
                                </span> 
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ajax删除 -->
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
                            $.get('/judjedel',{id:id},function(data){
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
                <div class="dataTables_paginate paging_full_numbers" id="pages">
                    {{$data->appends($request)->render()}}
                </div>
            </div> 
        </div>
    </div>
</div> 
@endsection