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

                            {{--<a href="{{ URL::asset('admin/user/index/create') }}" class="btn btn-outline btn-primary">添加</>--}}
                            {{--<a type="button" class="btn btn-outline btn-success">成功</a>--}}
                            {{--<a type="button" class="btn btn-outline btn-info">信息</a>--}}
                            {{--<a type="button" class="btn btn-outline btn-warning">警告</a>--}}

                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>商品名称</th>
                                <th>商品图片</th>
                                <th>商品正常价格</th>
                                <th>商品券后价格</th>
                                <th>销量</th>
                                <th>优惠券金额</th>
                                <th>优惠券结束时间</th>
                                <th>优惠券剩余数量</th>
                                <th>使用条件</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($shop as $v)
                                <tr class="gradeX">
                                    <td><input type="checkbox" data-id="{{ $v->id }}"></td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->D_title }}</td>
                                    <td><img src="{{ $v->Pic }}" width="50" alt=""></td>
                                    <td>{{ $v->Org_Price }}</td>
                                    <td>{{ $v->Price }}</td>
                                    <td>{{ $v->Sales_num }}</td>
                                    <td>{{ $v->Quan_price}}</td>
                                    <td>{{ $v->Quan_time}}</td>
                                    <td>{{ $v->Quan_surplus}}</td>
                                    <td>{{ $v->Quan_condition}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>商品名称</th>
                                <th>商品图片</th>
                                <th>商品正常价格</th>
                                <th>商品券后价格</th>
                                <th>销量</th>
                                <th>优惠券金额</th>
                                <th>优惠券结束时间</th>
                                <th>优惠券剩余数量</th>
                                <th>使用条件</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $shop->links() }}
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
