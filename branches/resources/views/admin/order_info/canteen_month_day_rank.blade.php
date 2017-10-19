@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-orderInfo-getMonthDayRank') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">饭堂每天销量列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>订单量</th>
                                    <th>订单总商品额</th>
                                    <th>商家出总运费</th>
                                    <th>买家出总运费</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($ranks as $rank)
                                    <tr>
                                        <td>{{ $rank->datemd }}</td>
                                        <td>{{ $rank->count }}</td>
                                        <td>{{ $rank->goods_amount }}</td>
                                        <td>{{ $rank->seller_shipping_fee }}</td>
                                        <td>{{ $rank->shipping_fee }}</td>
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
    <script type="text/javascript">

    </script>

@endsection
