@extends('Admin.Public.public')
@section('content')
@section('title','分类列表')
<!doctype html>
<html>
    <head>
    <script src='/static/jquery-1.8.3.min.js'></script>
    </head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span>
                    <i class="icon-table"></i>分类列表</span>
            </div>
            <div class="mws-panel-body no-padding">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                  <div id="DataTables_Table_1_length" class="dataTables_length">
                    <a href='/cate/create' class='btn btn-info'>添加</a>
                  </div>
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <form action='/cate' method='get'>
                        <label>类名:
                            <input type="text" aria-controls="DataTables_Table_1" name='keyword' value="{{$request['keyword'] or ''}}" />
                            <input class='btn btn-success' type='submit' value='搜索'/>
                        </label>
                    </form>
                    </div>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 255px;">id</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 332px;">类名</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 310px;">PID</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 226px;">PATH</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">显示</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">创建时间</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">修改时间</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 310px;">操作</th>
                                </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($cate as $k=>$v)
                            <tr class="odd">
                                <td class=" sorting_1 num">{{$v->id}}</td>
                                <td class=" ">{{$v->name}}</td>
                                <td class=" ">{{$v->pid}}</td>
                                <td class=" ">{{$v->path}}</td>
                                <td class=" ">
                                <select class="large" name="display" >
                                @if($v->display=='显示')
                                    <option value="0">显示</option>
                                    <option value="1">隐藏</option>
                                @else
                                    <option value="1">隐藏</option>
                                    <option value="0">显示</option>
                                @endif
                                </select>
                                </td>
                                <td class=" ">{{$v->created_at}}</td>
                                <td class=" ">{{$v->updated_at}}</td>
                                <td class="">
                                <form action='/cate/{{$v->id}}' method='post' style="display:inline;">
                                  {{csrf_field()}}
                                  {{method_field('DELETE')}}
                                  <button type='submit' class='btn btn-error del' onclick="return  confirm('你确定要删除吗?');"><i class="icol32-cross"></i></button>
                                </form>
                                  <a href='/cate/{{$v->id}}/edit' class='btn btn-info'><i class="icol32-setting-tools"></i></a>
                                  <!-- <a href='/cate/{{$v->id}}' class='btn btn-danger'><b>查看子类</b></a> -->
                                </td>
                            </tr>
                        @endforeach 
                        </tbody>
                    </table>
                    <div class="dataTables_paginate paging_full_numbers" id="pages">
                        {{$cate->appends($request)->render()}}
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $('select').change(function(){
            // alert($);
            id=$(this).parents("tr").find("td:first").html();
            // alert(id);
            val=$(this).find('option:selected').val();
            // alert(val);
            $.get('/cateedit',{id:id,display:val},function(data){
                // alert(data);
                if(data){
                    $.session.set('success', '修改成功!')
                }else{
                    $.session.set('error', '修改失败!')
                }
            })
        })
    </script>
</html>
@endsection