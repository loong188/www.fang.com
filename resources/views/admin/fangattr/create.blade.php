@extends('admin.public.main')
@section('css')
    <link rel="stylesheet" href="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.css">
    @endsection
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 添加房源属性
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
<article class="page-container">
    @include('admin.public.msg')
    <form class="form form-horizontal" id="form-node-add" method="post" action="{{ route('admin.fangattr.store') }}">
        @csrf
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>顶级属性：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="pid" id="pid" class="select">
                    @foreach($data as $id=>$name)
                        <option value="{{ $id }}">{{$name }}</option>
                    @endforeach
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>属性名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('name') }}" name="name" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>字段名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('field_name') }}" name="field_name" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">图标：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="filePicker">选择图片</div>
                    <input type="hidden" name="icon" id="pic">
                    <img src="" style="width: 100px;" id="showpic">
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加房源属性</button>
            </div>
        </div>
    </form>
</article>
@endsection
@section('js')
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">

    //表单验证
    $("#form-node-add").validate({
        rules: {
            name: {
                required: true,
            },
            field_name: {
                fieldName: true,
            },
        },
        onkeyup: false,
        success: 'valid',
        submitHandle: function () {
            form.sumbit();
        }
    });

    var uploader = WebUploader.create({
        auto: true,
        swf: '{{ staticAdminWeb() }}lib/webuploader/0.1.5/Uploader.swf',

        // 文件接收服务端。
        server: '{{ route('admin.base.upfile')}}',

        // 选择文件的按钮。可选。
        pick:{
            id:'#filePicker',
            //只允许单图片上传
            multiple:false
        },

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        //表单额外值
        formData:{
            _token: "{{ csrf_token() }}",
            node:'fangattr'
        },
        //上传表单名字
        fileVal:'file'
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,{url}) {
        $('#pic').val(url);
        $('#showpic').attr('src',url);
    });
    jQuery.validator.addMethod("fieldName",function(value,element){
        var bool=$('#pid').val() == 0 ? false : true;
        var reg = /[a-zA-Z_]+/;
        return bool || (reg.test(value));
    },"选择顶级属性请一定要填写对应的字段名称");

</script>
@endsection