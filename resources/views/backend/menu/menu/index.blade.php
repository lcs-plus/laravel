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

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>角色名称</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                @foreach($menu as $v)
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->create_time }}</td>
                                    <td>{{ $v->update_time}}</td>
                                    <td>{{ $v->state }}</td>
                                    <td></td>
                                @endforeach
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
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
        $(document).ready(function () {
            $('.dataTables-example').dataTable();

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable('../example_ajax.php', {
                "callback": function (sValue, y) {
                    var aPos = oTable.fnGetPosition(this);
                    oTable.fnUpdate(sValue, aPos[0], aPos[1]);
                },
                "submitdata": function (value, settings) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition(this)[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            });

        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData([
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row"]);

        }
    </script>
@endsection
