@extends('admin.public.main')
@section('cnt')
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 资讯管理
    <span class="c-gray en">&gt;</span> 资讯列表
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
		</span> 日期范围：
        <input value="{{ request()->get('st') }}" type="text" onfocus="WdatePicker({})" name="st" class="input-text Wdate" style="width:120px;">
        -
        <input value="{{ request()->get('et') }}" type="text" onfocus="WdatePicker({})" name="et" class="input-text Wdate" style="width:120px;">
        <input type="text" value="{{ request()->get('kw') }}" id="kw" placeholder="输入搜索的账号" style="width:250px" class="input-text">
        <button type="button" onclick="searchBtn()" class="btn btn-success radius"><i class="Hui-iconfont">&#xe665;</i> 搜索一下</button>
    </div>
    @include('admin.public.msg')
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-danger radius">
            <i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" href="{{ route('admin.notice.create') }}">
                <i class="Hui-iconfont">&#xe600;</i>添加预约表</a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">房东</th>
                <th width="100">租客</th>
                <th width="100">预约时间</th>
                <th width="100">内容</th>
                <th width="120">状态</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->fangowner->name }}</td>
                <td>{{ $item->renting->truename }}</td>
                <td>{{ $item->dtime }}</td>
                <td>{{ $item->cnt }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    {!! $item->editBtn('admin.notice.edit') !!}
                    {!! $item->delBtn('admin.notice.destroy') !!}
                </td>
            </tr>
                @endforeach
        </table>
    </div>
    {{ $data->links() }}
</div>
@endsection
@section('js')
@endsection