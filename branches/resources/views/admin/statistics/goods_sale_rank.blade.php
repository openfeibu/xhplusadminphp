@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-statistics-goodsSaleRank') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">商品销量前20</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>商品名称</th>
                                    <th>店铺名称</th>
                                    <th>分类名称</th>
                                    <th>总销量</th>
                                    <th>价格</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($goodses as $good)
                                    <tr>
                                        <td>{{ $good->goods_name }}</td>
                                        <td>{{ $good->shop_name }}</td>
                                        <td>{{ $good->cat_name }}</td>
                                        <td>{{ $good->goods_sale_count }}</td>
                                        <td>{{ $good->goods_price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    @section('javascript')
        @parent


    @endsection

@endsection
