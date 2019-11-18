@extends('admin.public.main')
@section('css')
    <link rel="stylesheet" href="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.css">
   <style>
       .imgbox{
           width:200px;
           height: 150px;
           margin-left: 100px;
           position: relative;
       }
       .imgbox img{
           height: 100%;
           width: 100%;
           border-radius: 5px;
       }
       .imgbox p{
           position: absolute;
           right: 5px;
           top: 1px;
           font-weight: 500;
           color: red;
           font-size: 20px;
           cursor: pointer;
       }
   </style>
    @endsection
@section('cnt')
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 用户中心
        <span class="c-gray en">&gt;</span> 添加文章
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
<article class="page-container">
    @include('admin.public.msg')
    <form class="form form-horizontal" id="form-article-add" method="post" action="{{ route('admin.article.update',['id'=>$article->id,'url'=>$url_query]) }}">
        @csrf
        @method('PUT')
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $article->title }}" placeholder="" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="cid" class="select">
                    @foreach($cateData as $item)
					<option value="{{ $item['id'] }}" @if($item['id']==$article->cid) seleted @endif>{{ $item['html']}}{{$item['cname'] }}</option>
					@endforeach
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="desc" cols="" rows="" class="textarea">{{ $article->desc }}</textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">封面图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="filePicker">选择图片</div>
                    <input type="hidden" name="pic" value="{{ $article->pic }}" id="pic">
                    <div class="imgbox">
                    <img src="{{ $article->pic }}" id="showpic">
                    <p onclick="delpic({{ $article->id }},'{{ $article->pic }}')">x</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
            <textarea id="body" name="body">{{ $article->body }}</textarea>
                </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 修改新文章</button>
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
        function delpic(id,src) {
            $.get('{{ route('admin.article.delfile') }}',{id,src}).then(ret=>{
               $('#pic').val('');
            $('#showpic').attr('src','');
            $('.imgbox').slideUp('slow');
            });
        }
        //表单验证
        $("#form-article-add").validate({
                    rules: {
                        title: {
                            required: true,
                        },
                        desc: {
                            required: true,
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
            server: '{{ route('admin.article.upfile')}}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
           formData:{ _token: "{{ csrf_token() }}" },
            fileVal:'file'
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,{url}) {
            $('#pic').val(url);
            $('#showpic').attr('src',url);
            $('.imgbox').slideDown('slow');
        });

        var ue = UE.getEditor('body',{
           initialFrameHeight:500
        });



</script>
@endsection