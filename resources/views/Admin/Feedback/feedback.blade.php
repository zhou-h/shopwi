@extends('Admin.Public.public')
@section('content')
@section('title','反馈意见列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>


    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>反馈意见列表</span>
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/admins" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="keywords" value=""></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 213px;">编号</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 280px;">name</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 257px;">内容</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 188px;">图片</th>
          </tr> 
         </thead> 
         
         
         <tbody role="alert" aria-live="polite" aria-relevant="all">
          @foreach($feedback as $v)
          <tr class="odd"> 
           <td class="  sorting_1">{{$v->id}}</td> 
           <td class=" ">{{$v->name}}</td> 
           <td class=" ">{{$v->edit}}</td> 
           <td class=" ">
             <img src="{{$v->img}}">
           </td> 
          
          </tr>
          @endforeach
          </tbody>
        </table>

         <div class="dataTables_paginate paging_full_numbers" id="pages">
         <ul class="pagination">
        
                    <li class="disabled"><span>«</span></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="http://hua.com/admins?page=2">2</a></li>
                    <li><a href="http://hua.com/admins?page=3">3</a></li>
                                                        
        
                    <li><a href="http://hua.com/admins?page=2" rel="next">»</a></li>
            </ul>

        </div>
       </div> 
      </div>
     </div> 
    </div> 
@endsection