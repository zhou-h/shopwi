@extends('Admin.Public.public')
@section('content')
@section('title','轮播图列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
    
    <div class="mws-panel grid_8 mws-collapsible"> 
        <div class="mws-panel-header"> 
            <span><i class="icon-table"></i>轮播图列表</span> 
            <div class="mws-collapse-button mws-inset">
            <span></span>
            </div>

            <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div>
        </div> 
    <div class="mws-panel-inner-wrap">
        <div class="mws-panel-body no-padding"> 
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
                     <thead> 
                        <tr role="row">
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">编号</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">图片</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">状态</th>
                            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
                        </tr> 
                </thead> 

                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    @foreach($data as $row)
                        <tr class="odd"> 
                            <td class="  sorting_1">{{$row->id}}</td> 
                            <td class=" "><img src='{{$row->pic}}'style="height:50px;" ></td> 
                            <td class=" ">
                                 @if($row->status==0)
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
                            <td class=" ">
                                <span class="btn-group"> 
                                    <a href="/banner/{{$row->id}}/edit" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
                                    <a href="" class="btn btn-small del" title="删除"><i class="icon-trash"></i></a>
                                </span> 
                            </td> 
                        </tr> 
                    @endforeach
                    </tbody>
        <!-- Ajax修改状态 -->
        <script>
        $('.status').change(function(){
            // alert(1);
            // 获取改变的值
            status = $('.status').val();
            // alert(display);
            // 获取id
            id=$(this).parents("tr").find("td:first").html();
            // alert(id);
             // Ajax修改状态
            $.get('/adminbannerdoedit',{id:id,status:status},function(data){
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
                    $.get('/adminbannerdel',{id:id},function(data){
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
                </table>

                <div class="dataTables_paginate paging_full_numbers" id="pages">
                    {{$data->render()}}
                </div>
            </div> 
        </div>
    </div> 
</div> 
@endsection