@extends('backend.layouts.main')

@section('self_css')

@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>角色列表</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="ibox-content">

                                <a href="{{ URL::asset('menu/menu/index/create') }}" class="btn btn-outline btn-primary">添加</>
                                <a type="button" class="btn btn-outline btn-success">成功</a>
                                <a type="button" class="btn btn-outline btn-info">信息</a>
                                <a type="button" class="btn btn-outline btn-warning">警告</a>

                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>角色名称</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($menu as $v)
                                    <tr class="gradeX">
                                    <td><input type="checkbox"></td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->create_time }}</td>
                                    <td>{{ $v->update_time}}</td>
                                    <td>{{ $v->state }}</td>
                                    <td>
                                        <a type="button" href="{{ URL::asset('menu/menu/index/'.$v->id) }}" class="btn btn-outline btn-success">编辑</a>
                                        <a type="button" data-id="{{ $v->id }}" class="btn btn-outline btn-info remove_this">删除</a>
                                    </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>角色名称</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $menu->links() }}
                    </div>
                </div>
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

    <!-- Page-Level Scripts -->
    <script>

        $(".remove_this").click(function () {

            var id = $(this).attr('data-id');
            $.ajax({
                url:"{{ URL::asset('menu/menu/index') }}" + '/' + id,
                type:'post',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{
                    _method:'DELETE'
                },
                success:function (data) {
                    layer.msg(data.message);
                    location.reload();
                }
                
            })

        })

    </script>
@endsection
