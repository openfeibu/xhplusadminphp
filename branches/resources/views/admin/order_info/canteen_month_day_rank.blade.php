@extends('layouts.admin-app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/rome.css') }}" type="" media=""/>
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

                        <form action="{{route('admin.order_info.getMonthDayRank')}}">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="dateym" id="dateym" value="{{$dateym}}">

                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary" name="submit" value="搜索" style="height:40px">
                            </div>
                            <div class="pull-right">
                                <div class="btn-group mr10">
    								<a  class="btn btn-white tooltips" data-original-title="导出" id="download"><i class="glyphicon glyphicon-save"></i></a>
                                </div>
                            </div><!-- pull-right -->
                        </form>
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
                                        <td>{{ $rank->dateym }}</td>
                                        <td>{{ $rank->count }}</td>
                                        <td>{{ $rank->goods_amount }}</td>
                                        <td>{{ $rank->seller_shipping_fee }}</td>
                                        <td>{{ $rank->shipping_fee }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <p>月总订单量：{{$count_sum}}；月总订单商品额：{{$goods_amount_sum}}元；月总商家出运费：{{$seller_shipping_fee_sum}}元；月总买家出运费：{{$shipping_fee_sum}}元；</p>
                            </div>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/rome.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        rome(dateym, {
          "inputFormat": "YYYY-MM",
        });
        $("#download").click(function(){
            var dateym = $("#dateym").val();
            window.location.href = "{{route('admin.order_info.monthDayRankDownload')}}"+"?dateym="+dateym;
            return false;
        });
    </script>

@endsection
