@extends('Admin.Public.public')
@section('content')
@section('title','商品列表')
<!doctype html>
<html>
    <head>
        <title></title>
        <script src="/static/jquery-1.8.3.min.js"></script>
    </head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span>规格列表</span>
            </div>
            @if (count($errors) > 0)
            <div class="mws-form-message warning">
              <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
              </div>
              </div>
            @endif
            <div class="mws-panel-body no-padding">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                <div id="DataTables_Table_1_length" class="dataTables_length">
                  <a href='/sizeadd/{{$good->id}}' class='btn btn-info'>继续添加</a>
                </div>
                    <form action='/goods/{$good->id}' method='get'>
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        <label>颜色: <input type="text" aria-controls="DataTables_Table_1" name='keyword' value="{{$request['keyword'] or ''}}"></label>
                        <input type='submit' value='搜索'/>
                    </div>
                    </form>
                    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 255px;">
                                    ID
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 332px;">
                                    商品
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 310px;">
                                    颜色
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 226px;">
                                    库存
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">
                                    创建时间
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">
                                    修改时间
                                </th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($info as $row)
                            <tr class="odd">
                                <td class=" sorting_1">
                                    {{$row->id}}
                                </td>
                                <td class="">
                                    {{$good->name}}
                                </td>
                                <td class="">
                                    {{$row->color}}
                                </td>
                                <td class="">
                                    {{$row->store}}
                                </td>
                                <td class="">
                                    {{$row->created_at}}
                                </td>
                                <td class="">
                                    {{$row->updated_at}}
                                </td>
                                <td class="">
                                <a href="/goods" class="btn btn-small"><i class="icon-home-2"></i></a>
                                <a href="/sizeedit/{{$row->id}}" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <a href="Javascript:void(0)" class="btn btn-small del"><i class="icon-trash"></i></a>
                                  <!-- form action='/auser/{{$row->id}}' method='post'>
                                  {{csrf_field()}}
                                  {{method_field('DELETE')}}
                                    <button type='submit' class='btn btn-danger'><i class="icol32-weather-rain"></i></button>
                                  </form>
                                  <a href='javascript:void(0)' class='btn btn-warning del'><i class="icol32-perfomance"></i></a>
                                  <a href='/auser/{{$row->id}}/edit' class='btn btn-info'><i class="icol32-toucan"></i></a>
                                  <a href='/auser/{{$row->id}}/' class='btn btn-info'><i class="icol32-qip-angry"></i></a> -->
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>
    <script>
    $('.del').click(function(){
      // alert($);
      id=$(this).parents('tr').find('td:first').html();
      // alert(id);
      s=$(this).parents('tr');
      if(confirm('你确定删除吗?')){
        $.get('/sizedel',{id:id},function(data){
          // alert(data);
          if(data){
            s.remove();
          }
        })
       }
    })
    </script>
</html>
@endsection