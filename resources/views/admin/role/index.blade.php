@extends('admin.public.main')
@section('cnt')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form>
    <div class="text-c">
        <input type="text" value="{{ request()->get('kw') }}" name="kw" class="input-text" style="width:250px" placeholder="角色" id="" name="">
        <button type="submit" class="btn btn-success radius" id="" name="">
            <i class="Hui-iconfont">&#xe665;</i> 搜角色</button>
    </div>
    </form>
    @include('admin.public.msg')
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="{{ route('admin.role.create') }}"  class="btn btn-primary radius">
                <i class="Hui-iconfont">&#xe600;</i> 添加角色
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">角色名称</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr class="text-c">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>

                <td class="td-manage">
                    <a href="{{ route('admin.role.edit',$item) }}" class="label label-secondary radius">修改</a>
                    <a  data-href="#" class="label label-secondary radius deletes">删除</a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $data->appends(request()->except('page'))->links() }}
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/laypage/1.2/laypage.js"></script>
@endsection