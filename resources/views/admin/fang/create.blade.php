@extends('admin.public.main')
@section('css')
    <link rel="stylesheet" href="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.css">
    <style>
        #imglist img{
            width: 150px;
            height: 150px;
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
    <form class="form form-horizontal" id="form-fang-add" method="post" action="{{ route('admin.fang.store') }}">
        @csrf
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="fang_name" value="{{ old('fang_name') }}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源小区名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="fang_xiaoqu" value="{{ old('fang_xiaoqu') }}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 150px;">
				<select name="fang_province" class="select" onchange="changeCity(this,'fang_city')">
					<option value="0"> ==请选择省份==</option>
                    @foreach($pData as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
				</select>
				</span>
                <span class="select-box" style="width: 150px;">
				<select name="fang_city" id="fang_city" class="select" onchange="changeCity(this,'fang_region')">
					<option value="0" > ==请选择市==</option>
				</select>
				</span>
                <span class="select-box" style="width: 150px;">
				<select name="fang_region" id="fang_region" class="select">
					<option value="0"> ==请选择区==</option>
				</select>
				</span>
                <span class="select-box" style="width: 362px;">
					<input type="text" class="select" placholder="房源详细地址" name="fang_addr" value="{{ old('fang_addr') }}">
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源朝向：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 150px;">
				<select name="fang_direction" class="select">
					 @foreach($attrData['fang_direction']['sub'] as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
				</select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源面积：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 362px;">
					<input type="text" class="select" placholder="房源面积" name="fang_build_area" value="{{ old('fang_build_area') }}">
				</span>
                <span class="select-box" style="width: 362px;">
					<input type="text" class="select" placholder="使用面积" name="fang_using_area" value="{{ old('fang_using_area') }}">
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>建筑年代：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 362px;">
					<input type="text" class="select" placholder="建筑年代" name="fang_year" value="{{ old('fang_year') }}">
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源租金：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 362px;">
					<input type="text" class="select" name="fang_rent">
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源楼层：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 80px;">
					<input type="text" class="select" placholder="房源楼层" name="fang_floor">
				</span>
                <span class="select-box" id="fang_region" style="width: 150px;">
				    <select name="fang_shi" class="select">
					    <option value="1">1室</option>
                        <option value="2">2室</option>
				    </select>
				</span>
                <span class="select-box" id="fang_region" style="width: 150px;">
				    <select name="fang_ting" class="select">
					    <option value="1">1厅</option>
                        <option value="2">2厅</option>
				    </select>
				</span>
                <span class="select-box" id="fang_region" style="width: 150px;">
				    <select name="fang_wei" class="select">
					    <option value="1">1卫</option>
				    </select>
				</span>
                <span class="select-box" id="fang_region" style="width: 150px;">
				    <select name="fang_rent_class" class="select">
					    @foreach($attrData['fang_rent_type']['sub'] as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
				    </select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>配套设施：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                @foreach($attrData['fang_config']['sub'] as $item)
                <div class="check-box">
                    <label>
                        <input type="checkbox" value="{{ $item['id'] }}" name="fang_config[]">
                        {{ $item['name'] }}
                    </label>
                </div>
                    @endforeach
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源区域：</label>
            <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 362px;">
                        <select name="fang_area" class="select">
                            @foreach($attrData['fang_area']['sub'] as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>租金范围：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 362px;">
                   <select name="fang_rent_range" class="select">
                       @foreach($attrData['fang_rent_range']['sub'] as $item)
                           <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                       @endforeach
                        </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>租期方式：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box" style="width: 362px;">
                    <select name="fang_rent_type" class="select">
                        @foreach($attrData['fang_rent_type']['sub'] as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <label>
                        <input name="fang_status" type="radio" value="0">
                        待租
                    </label>
                </div>
                <div class="radio-box">
                    <label>
                        <input name="fang_status" type="radio" value="1">
                        已租
                    </label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否推荐：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <label>
                        <input name="is_recommend" type="radio" value="0">
                        不推荐
                    </label>
                </div>
                <div class="radio-box">
                    <label>
                        <input name="is_recommend" type="radio" value="1">
                        推荐
                    </label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源房东：</label>
            <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 362px;">
                        <select name="fang_owner" class="select">
                            @foreach($fData as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源小组：</label>
            <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width: 362px;">
                        <select name="fang_group" class="select">
                            @foreach($attrData['fang_group']['sub'] as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源摘要：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="fang_desn" class="textarea"></textarea>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    <div id="filePicker">选择图片</div>
                    <input type="hidden" name="fang_pic" id="pic">
                    <div id="imglist"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>房源详情：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea id="fang_body" name="fang_body"></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加新房源</button>
            </div>
        </div>
    </form>
</article>
@endsection
@section('js')
    <!-- 引入 ueditor js类库 -->
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <!-- 引入webuploader插件 类库JS-->
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/webuploader/0.1.5/webuploader.min.js"></script>
    <!-- 表单前端验证插件 jquery validate -->
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });
    function changeCity(obj,selecter){
        let value=obj.value;
        $.get("{{ route('admin.fang.city') }}",{pid:value}).then(ret=>{
            ret=[{id : 0, name: '==选择市=='},...ret];
        let html='';
        ret.forEach(item=>{
            html +=`<option value="${item.id}">${item.name}</option>`
        });
        $('#' + selecter).html(html);
        });
    }
    //表单验证
    $("#form-fang-add").validate({
        rules: {
            fang_name: {
                required: true
            },
            fang_xiaoqu: {
                required: true
            },
            fang_desn:{
                required:true
            },
            fang_province:{
                required:true
            },
            fang_addr:{
                required:true
            },
            fang_direction:{
                required:true
            },
            fang_build_area:{
                required:true
            },
            fang_using_area:{
                required:true
            },
            fang_year:{
                required:true
            },
            fang_rent:{
                required:true
            },
            fang_floor:{
                required:true
            },
            fang_shi:{
                required:true
            },
            fang_ting:{
                required:true
            },
            fang_wei:{
                required:true
            },
            fang_pic:{
                required:true
            },
            fang_rent_class:{
                required:true
            },
            fang_config:{
                required:true
            },
            fang_area:{
                required:true
            },
            fang_rent_range:{
                required:true
            },
            fang_rent_type:{
                required:true
            },
            fang_status:{
                required:true
            },
            fang_owner:{
                required:true
            },
            fang_body:{
                required:true
            },
            fang_group:{
                required:true
            },
            is_recommend:{
                required:true
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
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: true,
        formData:{
            _token: "{{ csrf_token() }}",
            node:'fang'
        },
        fileVal:'file'
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,{url}) {
        let val=$('#pic').val();
        $('#pic').val(val + '#' + url);
        let imgobj=$('<img />');
        imgobj.attr('src',url);

        $('#imglist').append(imgobj);
    });
        var ue = UE.getEditor('fang_body',{
           initialFrameHeight:500
        });
</script>
@endsection