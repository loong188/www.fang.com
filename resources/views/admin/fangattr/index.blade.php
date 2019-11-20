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
            <a class="btn btn-primary radius" href="{{ route('admin.fangattr.create') }}">
                <i class="Hui-iconfont">&#xe600;</i>房源列表</a>
        </span>
    </div>
    <div class="mt-20" id="app">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>属性名称</th>
                <th>图标</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items">
                <td v-text="item.id"></td>
                <td :style="'padding-left:'+(item.level*10)+'px'">@{{ item.name }}@{{ item.level }}</td>
                <td>
                    <img :src="item.icon" style="width:100px;">
                </td>
                <td v-html="item.actionBtn"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/laypage/1.2/laypage.js"></script>
    <script src="/js/vue.js"></script>
<script>
    const _token="{{ csrf_token() }}";
    const app=new Vue({
        el:'#app',
        data:{
            items:[]
        },
        mounted(){
            $.get("{{ route('admin.fangattr.index') }}").then(ret=>{
                this.items=ret;
            })
        }
    });
    $('.table-sort').on('click','.deluser',function () {
        console.log(11);
        return false;
    })

</script>
@endsection