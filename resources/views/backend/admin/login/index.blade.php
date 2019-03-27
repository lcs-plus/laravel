<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>H+ 后台主题UI框架 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('layui/css/layui.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">
            <form method="post">
                <h4 class="no-margins">登录：</h4>
                <input type="email" class="form-control uname" placeholder="Email"/>
                <input type="password" class="form-control pword m-b" placeholder="密码"/>
                <a href="">忘记密码了？</a>
                <button class="btn btn-success btn-block">登录</button>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2015 All Rights Reserved. H+
        </div>
    </div>
</div>
</body>
<script src="{{ URL::asset('layui/layui.js') }}"></script>
<script>

    $(".btn-block").click(function () {

        $.ajax({
            url: "{{ URL::asset('admin/login/index') }}",
            type: 'post',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                email: $("input[type=email]").val(),
                password: $("input[type=password]").val(),
            },
            success: function (date) {
                layui.use('layer', function () {

                    var layer = layui.layer;

                    layer.msg(date.message);
                    if (date.code == 1) {

                        setTimeout(function () {
                            location.href = "{{ Url('admin/index/index') }}"
                        }, 500)

                    }

                })
            }
        });


        return false;
    })

</script>
</html>
