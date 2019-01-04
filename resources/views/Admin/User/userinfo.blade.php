@extends('Admin.Public.public')
@section('content')
@section('title','用户详情')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
<style>
  .odd{
    border: 1px solid #ccc;
  }
</style>

    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>用户详情</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value=""></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">头像</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">姓名</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">性别</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">电话</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">邮箱</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">创建时间</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;">修改时间</th>
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
         <tbody role="alert" aria-live="polite" aria-relevant="all">
            <tr class="odd" align="center"> 
               <td class="  sorting_1" style="border:1px solid #eee">{{$userinfo->id}}</td> 
               <td class=" "><img src="{{$userinfo->pic}}" alt="" width="100px"></td> 
               <td class=" ">{{$userinfo->name}}</td> 
               <td class=" ">{{$userinfo->sex}}</td> 
               <td class=" ">{{$userinfo->phone}}</td> 
               <td class=" ">{{$userinfo->email}}</td> 
               <td class=" ">{{$userinfo->addtime}}</td> 
               <td class=" ">{{$userinfo->uptime}}</td> 
               
               <td class=" "> <span class="btn-group"> 
               <a href="/user/" class="btn btn-small del">返回</a>
              <!-- <a href="/admins/10/edit" class="btn btn-small"><i class="icon-map-marker"></i></a>  -->
                </span> </td> 
          </tr>
            </tbody>
        </table>
  <div class="dataTables_info" id="DataTables_Table_0_info"></div>
         <div class="dataTables_paginate paging_full_numbers" id="pages">
         <ul class="pagination">
            </ul>
            

        </div>
       </div> 
      </div>
     </div> 
    </div> 
@endsection