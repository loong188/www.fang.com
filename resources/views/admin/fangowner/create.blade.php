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
    <form class="form form-horizontal" id="form-node-add" method="post" action="{{ route('admin.fangowner.store') }}">
        @csrf
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房东姓名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('name') }}" name="name" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">* </span>性别：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <label>
                        <input name="sex" type="radio" value="男" checked>男
                    </label>
                </div>
                <div class="radio-box">
                    <label>
                        <input name="sex" type="radio" value="女">女
                    </label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房东年龄：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('age') }}" name="age" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>手机号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('phone') }}" name="phone" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>身份证号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('card') }}" name="card" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('address') }}" name="address" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系邮箱：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" value="{{ old('email') }}" name="email" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">身份证照片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="filePicker">选择图片</div>
                    <input type="hidden" name="pic" id="pic">
                    <div id="imgbox"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加房东信息</button>
            </div>
        </div>
    </form>
</article>
@endsection
@section('js')
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
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
            multiple:true
        },

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        //表单额外值
        formData:{
            _token: "{{ csrf_token() }}",
            node:'fangowner'
        },
        //上传表单名字
        fileVal:'file'
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,{url}) {
        let val = $('#pic').val();
        $('#pic').val(val+'#'+url);
        var imgObj=$('<img style="width: 100px;height: 100px;" />');
        imgObj.attr('src',url);
        $('#imgbox').append(imgObj);
    });
    //表单验证
    $("#form-node-add").validate({
        rules: {
            name: {
                required: true
            },
            age: {
                required:true,
                digits:true,
                min:1,
                max:120
            },
            phone:{
                required:true,
                checkPhone:true
            },
            card:{
                required:true,
                checkCard:true
            },
            address:{
                required:true
            },
            email:{
                required:true,
                email:true
            }
        },
        //回车取消
        onkeyup: false,
        success: 'valid',
        submitHandle: function (form) {
            form.sumbit();
        }
    });
    jQuery.validator.addMethod("checkPhone",function(value,element){
        var reg = /^1[3456789]\d{9}$/;
        return this.optional(element) || (reg.test(value));
    },"您输入的不是正常的国内手机号码");
    jQuery.validator.addMethod("checkCard",function(value,element){
        var reg = /^[1-9][0-9]{5}([1][9][0-9]{2}|[2][0][0|1][0-9])([0][1-9]|[1][0|1|2])([0][1-9]|[1|2][0-9]|[3][0|1])[0-9]{3}([0-9]|[X])$/;
        return this.optional(element) || (reg.test(value));
    },"身份证号码输入错误");
</script>
@endsection