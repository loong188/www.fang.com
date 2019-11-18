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
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="{{ staticAdminWeb() }}lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script>
    const datatable=$('.table-sort').dataTable({
        lengthMenu:[10,20,30,50,100],
        columnDefs: [
            {targets:[4],orderable:false}
        ],
        //初始化排序
        order:[[{{ request()->get('field') ?? 0 }},'{{ request()->get("order") ?? "desc"}}']],
        //从第几条数据开启显示
        displayStart:{{ request()->get('start') ?? 0 }},
        searching:false,
        serverSide:true,
        ajax:{
            url:'{{ route('admin.article.index') }}',
            type:'GET',
            data:function (ret) {
                ret.kw=$.trim($('#kw').val())
            }
        },
        columns: [
            {data:'id',className:'text-c'},
            {data:'title'},
            {data:'cate.cname'},
            {data:'updated_at'},
            {data:'actionBtn',className:'text-c'}
//            {data:'aa',defaultContent:'操作',className:'text-c'}
        ],
        createdRow:function (row,data) {
//            var td =$(row).find('td:last-child');
//            var html='<a href="###" class="label label-secondary radius" >修改</a>';
//            td.html(html);
        }

    });
    //搜索
    function searchBtn(){
        datatable.api().ajax.reload();
    }
    $('.table-sort').on('click','.deluser',function(){
        let url = $(this).attr('href');
        fetch(url,{
            method:'delete',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'content-type':'application/json'
            },
            body:JSON.stringify({name:1})
        }).then(res => {
            return res.json();
        }).then(ret => {
            layer.msg('删除成功',{icon:1,time:1000},() => {
                $(this).parents('tr').remove();
        });
        });
        return false;
    })
</script>
@endsection