
@if($errors->any())
    <div class="Huialert Huialert-danger"><i class="Hui-iconfont">&#xe6a6;</i>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </div>
@endif

@if(session()->has('success'))
<div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>
    {{  session("success") }}
</div>
@endif