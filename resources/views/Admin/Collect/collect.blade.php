@extends('Admin.Public.public')
@section('content')
@section('title','收藏列表')
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
                  
                </div>
                    <form action='' method='get'>
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
                                    商品ID
                                </th>
                                
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 172px;">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($data as $v)
                            <tr class="odd">
                                <td class=" sorting_1">
                                {{$v->id}}
                                </td>
                                <td class="">
                                {{$v->goods_id}}
                                </td>
                                <td class="">
                                <a href="Javascript:void(0)" class="btn btn-small del"><i class="icon-trash"></i></a>
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