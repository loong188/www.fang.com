<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link href="{{ staticAdminWeb() }}static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ staticAdminWeb() }}static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="{{ staticAdminWeb() }}static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="{{ staticAdminWeb() }}lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ staticAdminWeb() }}lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <title>后台登录 admin v3.1</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        @include('admin.public.msg')
        <form class="form form-horizontal" action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">

                    <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">

                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright 你的公司名称 房房网</div>
<script type="text/javascript" src="{{staticAdminWeb()}}lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{staticAdminWeb()}}static/h-ui/js/H-ui.min.js"></script>
<!--此乃百度统计代码，请自行删除-->
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
