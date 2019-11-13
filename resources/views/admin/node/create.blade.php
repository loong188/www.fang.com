@extends('admin.public.main')
@section('cnt')
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 用户中心
    <span class="c-gray en">&gt;</span> 添加用户
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>

<article class="page-container">
    @include('admin.public.msg')
    <form action="{{ route('admin.node.store') }}" method="post" class="form form-horizontal" id="form-node-add">
        @csrf
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级菜单：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select name="pid" class="select">
                        @foreach($data as $id=>$name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ old('name') }}" name="name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由别名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('route_name') }}" class="input-text" name="route_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>菜单：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <label>
                        <input type="radio" name="is_menu" value="0" checked>
                        否
                    </label>
                </div>
                <div class="radio-box">
                    <label>
                        <input type="radio" name="is_menu" value="1">
                        是
                    </label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="添加新权限">
            </div>
        </div>
    </form>
</article>

@endsection
@section('js')
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
    $("#form-node-add").validate({
        rules: {
            name: {
                required:true
            }
        },
        messages: {
            name: {
                required:"权限名称不能为空"
            }
        },
        onkeyup:false,
        success:"valid",
        submitHandler:function (form) {
            form.submit();
        }

    });
</script>
@endsection