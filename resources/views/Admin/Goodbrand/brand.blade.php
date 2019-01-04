@extends('Admin.Public.public')
@section('content')
@section('title','商品列表')
<!doctype html>
<head>
    <script src="/static/jquery-1.8.3.min.js"></script>
</head>
    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>商品列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
       <div id="DataTables_Table_1_length" class="dataTables_length">
          <a href='/goods/create' class='btn btn-info'>添加</a>
        </div>
        <form action="/goods" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>商品名: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value="{{$request['keywords'] or '' }}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">商品</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">类别</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 188px;">图片</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">描述</th>
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">状态</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">价格(￥)</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">销量</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">总库存</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">创建时间</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">修改时间</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">操作</th>
          </tr>
         </thead> 
         
         
         <tbody role="alert" aria-live="polite" aria-relevant="all">
         @foreach($goods as $v)
          <tr class="odd"> 
           <td class="  sorting_1">{{$v->id}}</td> 
           <td class=" ">{{$v->name}}</td> 
           <td class=" ">{{$v->type_id}}</td> 
           <td class=" "><img src="{{$v->pic}}" /></td> 
           <td class=" ">{{$v->descr}}</td>
           <td class=" ">
            <select class="large" name="display" >
                @if($v->static=='显示')
                    <option value="0">显示</option>
                    <option value="1">隐藏</option>
                @else
                    <option value="1">隐藏</option>
                    <option value="0">显示</option>
                @endif
            </select>
           </td> 
           <td class=" ">{{$v->price}}</td> 
           <td class=" ">{{$v->sales}}</td>
           <td class=" ">{{$v->stocks}}</td>  
           <td class=" ">{{$v->created_at}}</td> 
           <td class=" ">{{$v->updated_at}}</td> 
           <td class=" "> 
           <span class="btn-group"> 
              <a href="/goods/{{$v->id}}" class="btn btn-small"><i class="icon-home-2"></i></a>
              <a href="/goods/{{$v->id}}/edit" class="btn btn-small"><i class="icon-pencil"></i></a>
              <a href="Javascript:void(0)" class="btn btn-small del"><i class="icon-trash"></i></a>
              <a href="/sizeadd/{{$v->id}}" class="btn btn-small">添加库存</a>
              <!-- <form action="/goods/{{$v->id}}" method="post" style="display:inline;">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-small" onclick="return  confirm('你确定要删除吗?');">
                <i class="icon-trash"></i>
                </button> 
            </form> -->   
          </span> 
          </td> 
          </tr>
          @endforeach
        </tbody>
        </table>
        <div class="dataTables_paginate paging_full_numbers" id="pages">
            {{$goods->appends($request)->render()}}
        </div> 
       </div> 
      </div>
     </div> 
    </div> 
    <script>
        $('select').change(function(){
            // alert($);
            id=$(this).parents("tr").find("td:first").html();
            // alert(id);
            val=$(this).find('option:selected').val();
            // alert(val);
            $.get('/goodsedit',{'id':id,'static':val},function(data){
                // alert(data);
                if(data){
                    $.session.set('success', '修改成功!')
                }else{
                    $.session.set('error', '修改失败!')
                }
            })
        })

        //ajax删除
        $('.del').click(function(){
          // alert($);
          // 获取当前ID
          id=$(this).parents("tr").find("td:first").html();
          // alert(id);
          s=$(this).parents('tr');
          if(confirm('你确定删除吗?')){
            $.get('/goodsdel',{id:id},function(data){
              // alert(data);
              if(data){
                  s.remove();
                }else{
                  alert('删除失败!');
              }
            })
           }
        })
    </script>
@endsection