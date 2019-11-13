@extends('admin.public.main')
@section('cnt')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form>
    <div class="text-c"> 日期范围：
        <input type="text" name="st" value="{{ request()->get('st') }}" onfocus="WdatePicker({})" class="input-text Wdate" style="width:120px;">
        <input type="text" name="et" value="{{ request()->get('et') }}" onfocus="WdatePicker({})" class="input-text Wdate" style="width:120px;">
        <input type="text" value="{{ request()->get('kw') }}" name="kw" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
        <button type="submit" class="btn btn-success radius" id="" name="">
            <i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    </form>
    @include('admin.public.msg')
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a onclick="deleteAll()" class="btn btn-danger radius">
                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
            </a>
            <a href="{{ route('admin.user.create') }}"  class="btn btn-primary radius">
                <i class="Hui-iconfont">&#xe600;</i> 添加用户
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="40">性别</th>
                <th width="90">手机</th>
                <th width="150">邮箱</th>
                <th width="">地址</th>
                <th width="130">加入时间</th>
                <th width="70">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr class="text-c">
                <td><input type="checkbox" value="{{ $item->id }}" name="ids[]"></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->sex }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email ?? '无' }}</td>
                <td>{{ $item->created_at }}
                <td>
                    @if($item->deleted_at)
                        <a onclick="changeUser(1,{{ $item->id }},this)" class="label label-warning radius">禁用</a>
                        @else
                        <a onclick="changeUser(0,{{ $item->id }},this)" class="label label-success radius">激活</a>
                    @endif
                </td>
                <td class="td-manage">
                    <a href="{{ route('admin.user.edit',['id'=>$item->id]) }}" class="label label-secondary radius">修改</a>
                    <a  data-href="{{ route('admin.user.destroy',['id'=>$item->id]) }}" class="label label-secondary radius deletes">删除</a>
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
    <script>
        const _token="{{csrf_token()}}";
        $('.deletes').click(function(){
            var url=$(this).attr('data-href');
            layer.confirm('您真要删除此用户吗？', {
                btn: ['确认删除', '再想一下']
            },()=>{
                $.ajax({
                    url,
                    type:'delete',
                    data:{_token}
                }).then(ret=>{
                    $(this).parents('tr').remove();
                layer.msg(ret.msg,{icon:1,time:1000});
                });
            });
            return false;
        });
        //软删除批量删除
        function deleteAll() {
            var inputs =$('input[name="ids[]"]:checked');
            var ids=[];
            inputs.map((key,item)=>{
            ids.push($(item).val());
            });
            $.ajax({
                url:'{{ route('admin.user.delall') }}',
                type:'delete',
                data:{
                    _token,
                    ids
                }
            }).then(ret=>{
                inputs.map((key,item)=>{
                    $(item).parents('tr').remove();
            });
            });
        }
        function changeUser(status,id,obj){
        if(status == 0){
            $.ajax({
                url:'{{ route('admin.user.delall') }}',
                type:'delete',
                data:{
                    _token,
                    ids:[id]
                }
            }).then(ret=>{
                $(obj).removeClass('label-success').addClass('label-warning').html('禁用');
            })
        }else{
            $.ajax({
                url: '{{ route('admin.user.restore') }}',
                data: {id}
            }).then(ret=>{
                $(obj).removeClass('label-warning').addClass('label-success').html('激活');
            });
        }
        }
    </script>
@endsection