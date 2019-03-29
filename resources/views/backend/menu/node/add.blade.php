@extends('backend.layouts.main')

@section('self_css')

@endsection

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>添加</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="get" class="form-horizontal" id="menu_form">
                    <input type="hidden" name="type" value="{{ $id }}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">节点名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">链接</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sort">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" checked="" value="0" id="optionsRadios1" name="state">禁用</label>
                            <label class="radio-inline">
                                <input type="radio" value="1" id="optionsRadios2" name="state">启用</label>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" id="add_button" type="button">保存内容</button>
                            <button class="btn btn-white" id="back">返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('self_js')

    <script src="{{ URL::asset('js/plugins/jeditable/jquery.jeditable.js') }}"></script>

    <!-- Data Tables -->
    <script src="{{ URL::asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>

    <!-- 自定义js -->
    <script src="{{ URL::asset('js/content.js?v=1.0.0') }}"></script>

    <!-- iCheck -->
    <script src="{{ URL::asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


            $("#add_button").click(function () {

                $.ajax({
                    url:"{{ URL::asset('menu/node/index') }}",
                    type:'post',
                    dataType:'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data:$("#menu_form").serializeArray(),
                    success:function (data) {
                        layer.msg(data.message);
                        if (data.code == 1){
                            window.location.href = "{{ URL::asset('menu/node/index') }}";
                        }

                    }
                });
            })

        });

        $("#back").click(function () {

            window.location.go(-1);

        });

    </script>
@endsection
