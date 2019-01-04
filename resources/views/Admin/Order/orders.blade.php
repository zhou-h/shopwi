@extends('Admin.Public.public')
@section('content')
@section('title','订单列表')
<!doctype html>
<script src="/static/jquery-1.8.3.min.js"></script>
    <div class="mws-panel grid_8 mws-collapsible"> 
     <div class="mws-panel-header"> 
      <span><i class="icon-table"></i>订单列表</span> 
      <div class="mws-collapse-button mws-inset">
       <span></span>
      </div>
     <div class="mws-collapse-button mws-inset"><span></span></div><div class="mws-collapse-button mws-inset"><span></span></div></div> 
     <div class="mws-panel-inner-wrap">
      <div class="mws-panel-body no-padding"> 
       <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/order" method="get">
          <div class="dataTables_filter" id="DataTables_Table_0_filter">
             <label>搜索: <input type="text" aria-controls="DataTables_Table_0" name="key" value="{{$request['key'] or ''}}"></label>
             <input type="submit" value="搜索">
          </div>
        </form>
        <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
         <thead> 
          <tr role="row">
           <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" name="id" style="width: 120px;">ID</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 200px;" name="user_id">user_id</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;" name="order_num">订单号</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 200px;" name="pic">商品图片</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 250px;" name="address">地址</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;" name="price">单价</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 141px;" name="num">数量</th>
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 180px;" name="status">状态</th>
           <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 183px;">操作</th>
          </tr> 
         </thead> 
         <tbody role="alert" aria-live="polite" aria-relevant="all">
          @foreach($order as $row)
          <tr class="odd"> 
           <td class="  sorting_1">{{$row->id}}</td> 
           <td class=" ">{{$row->user_id}}</td> 
           <td class=" ">{{$row->order_num}}</td> 
           <td class=" ">{{$row->pic}}</td> 
           <td class=" ">{{$row->address_id}}</td>
           <td class=" ">{{$row->price}}</td> 
           <td class=" ">{{$row->num}}</td>
           <td class=" ">
            @if($row->status==0)
              <a href="/orderstatus/{{$row->id}}/1" class="btn btn-success">点击发货</a>
            @elseif($row->status==1)
              <a href="/orderstatus/{{$row->id}}/2" class="btn btn-success">已发货,待支付</a>
            @elseif($row->status==2)
              <a href="/orderstatus/{{$row->id}}/3" class="btn btn-success">已支付,货物没送达</a>
            @elseif($row->status==3)
              <a href="/orderstatus/{{$row->id}}/4" class="btn btn-success">货物送达,待确认收货</a>
            @else
              <span class="btn btn-success">交易成功</span>
            @endif
              
          </td>
           <td class=" "> <span class="btn-group"> 
            <form action="/order/{{$row->id}}" method="post" style="display:inline;">
              {{csrf_field()}}
              {{method_field("DELETE")}}
                <button type="submit" class="btn btn-danger"><i class="icon-trash">
                </i></button> 
            </form> 
            </span>
          </td> 
          </tr>
          @endforeach        
        </tbody>
        </table>

         <div class="dataTables_paginate paging_full_numbers" id="pages">
          {{$order->appends($request)->render()}}
        </div>
       </div> 
      </div>
     </div> 
    </div> 
@endsection