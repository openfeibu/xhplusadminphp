@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-orderInfo-refundIndex') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">退款任务列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$order_infos])

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>订单标识</th>
									<th>订单号</th>
									<th>支付交易号</th>
                                    <th>支付类型</th>
                                    <th>用户</th>
									<th>费用</th>
									<th>任务状态</th>
                                    <th>退款时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($order_infos as $order_info)
                                    <tr>
                                         <td>{{ $order_info->order_id }}</td>
										 <td>{{ $order_info->order_sn }}</td>
										 <td>{{ $order_info->trade_no }}</td>
                                         <td>{{ $order_info->pay_name }}</td>
										 <td>{{ $order_info->nickname }}</td>
										 <td>{{ $order_info->fee }}</td>
										 <td>{{ trans("common.order_status.buyer.$order_info->order_status") }}</td>
										 <td>{{ $order_info->cancelling_time }}</td>
                                        <td>
											<a href="{{route('admin.order_info.refund',['id'=>$order_info->order_id])}}"  class="btn btn-white btn-xs"><i class="fa fa-cny"></i>退款</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $order_infos->render() !!}

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
