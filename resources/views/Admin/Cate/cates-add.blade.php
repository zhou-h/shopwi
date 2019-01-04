@extends('Admin.Public.public')
@section('content')
@section('title','分类添加')
<!doctype html>
<html>
    <head></head>
    <body>
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
            <span>类别添加</span></div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="/cate" method="post">
                    @if (count($errors) > 0)
                    <div class="mws-form-message error">
                        <div class="alert alert-danger">
                            <ul>@foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="mws-form-inline">
                        <div class="mws-form-row">
                            <label class="mws-form-label">分类名</label>
                            <div class="mws-form-item">
                            <input type="text" class="large" name="name" value="{{old('name')}}" /></div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">父类</label>
                            <div class="mws-form-item">
                                <select class="large" name="pid">
                                  <option value="0">--请选择--</option>
                                  @foreach($cate as $row)
                                      <option value="{{$row->id}}">{{$row->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">是否显示</label>
                            <div class="mws-form-item">
                                <select class="large" name="display">
                                  <option value="0">显示</option>
                                      <option value="1">隐藏</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mws-button-row">
                    {{csrf_field()}}
                        <input type="submit" value="Submit" class="btn btn-danger" />
                        <input type="reset" value="Reset" class="btn " />
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>
@endsection