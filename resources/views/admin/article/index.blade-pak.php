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
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
        <input type="text" name="" id="" placeholder=" 资讯名称" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
    </div>
    @include('admin.public.msg')
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-danger radius">
            <i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" href="{{ route('admin.article.create') }}">
                <i class="Hui-iconfont">&#xe600;</i>添加文章</a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>标题</th>
                <th>分类</th>
                <th width="120">更新时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr class="text_c">
                    <td>{{ $item->id }}</td>
                    <td class="text-l">{{ $item->title }}</td>
                    <td>{{ $item->cate->cname }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td class="f-14 td-manage">
                        {!! $item->editBtn('admin.article.edit') !!}
                        {!! $item->delBtn('admin.article.destroy') !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="{{ staticAdminWeb() }}lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script>
    $('.table-sort').dataTable({
        lengthMenu:[10,20,30,50,100],
        columnDefs: [
            {targets:[4],orderable:false}
        ],
        order:[[0,'desc']]
    });
</script>
@endsection