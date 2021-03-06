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
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">节点名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $node->name }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">链接</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url" value="{{ $node->url }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sort" value="{{ $node->sort }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">图标</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="icon" value="{{ $node->icon }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="checkbox form-group">
                        <label class="col-sm-2 control-label">所属角色：</label>
                        <div class="col-sm-9">
                            @foreach($menu as $k)
                                @if(in_array($k['id'],$ids))
                                <label class="checkbox" for="closeButton{{$k->id}}">
                                    <input id="closeButton{{$k->id}}" name="menu[]" type="checkbox" value="{{ $k->id }}" class="input-mini" checked="checked">{{ $k->name }}
                                </label>
                                @else
                                    <label class="checkbox" for="closeButton{{$k->id}}">
                                        <input id="closeButton{{$k->id}}" name="menu[]" type="checkbox" value="{{ $k->id }}" class="input-mini">{{ $k->name }}
                                    </label>
                                    @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                @if($node->state==0)
                                    <input type="radio" checked="checked" value="0" id="optionsRadios1" name="state">禁用</label>
                            @else
                                <input type="radio" value="0" id="optionsRadios1" name="state">禁用</label>
                            @endif
                            <label class="radio-inline">
                                @if($node->state == 1)
                                    <input type="radio" value="1" checked="checked" id="optionsRadios2" name="state">启用</label>
                            @else
                                <input type="radio" value="1" id="optionsRadios2" name="state">启用</label>
                            @endif
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
                    url:"{{ URL::asset('menu/node/index/'.$node->id) }}",
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

                    },
                    error:function (date) {
                        console.log(date.responseJSON)
                    }
                });
            })

        });

        $("#back").click(function () {

            window.location.go(-1);

        });

    </script>
@endsection
