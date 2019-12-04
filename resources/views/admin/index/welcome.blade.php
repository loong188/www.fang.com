@extends('admin.public.main')
@section('cnt')
<div class="page-container">
    <p class="f-20 text-success">{{ session('success') }} <span class="f-14">v3.1</span>后台模版！</p>
    <p>登录次数：18 </p>
    <p>登录IP：{{ $datas['REMOTE_ADDR'] }}  登录时间：{{ date('Y-m-d H:i:s',$datas['REQUEST_TIME']) }} 账户：{{ $user }}</p>
    <div id="main" style="width: 600px;height:300px;"></div>
</div>
@endsection
@section('js')
    <script src="/js/echarts.min.js"></script>
    <script>
        // 先发起ajax在ajax回调中调用options,初始化echarts
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            title: {
                text: '已租和待租比例'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'right',
                data: [{!! $legend !!}]
            },
            series: [
                {
                    name: '租房比例',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '60%'],
                    data:{!! $data !!}
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection