@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-order-refundIndex') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                               <!-- <a href="{{ route('admin.order.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>-->
								<a class="btn btn-white tooltips refundall"
                                   data-toggle="tooltip" data-original-title="退款" data-href="{{ route('admin.order.refundAll',['ids'=>0]) }}"><i
                                            class="fa fa-cny"></i></a>
                                <!--<a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.order.destroyRefund.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>-->
                            </div>
                        </div>
						<!-- pull-right -->

                        <h5 class="subtitle mb5">退款任务列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$orders])

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>
                                    </th>
                                    <th>标识</th>
									<th>订单号</th>
									<th>支付交易号</th>
                                    <th>发单人</th>
									<th>任务费用</th>
									<th>任务状态</th>
                                    <th>退款时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $order->oid }}"
                                                       value="{{ $order->oid }}" class="selectall-item"/>
                                                <label for="id-{{ $order->oid }}"></label>
                                            </div>
                                        </td>
                                         <td>{{ $order->oid }}</td>
										 <td>{{ $order->order_sn }}</td>
										 <td>{{ $order->trade_no }}</td>
										 <td>{{ $order->nickname }}</td>
										 <td>{{ $order->fee }}</td>
										 <td>{{ trans("common.task_status.$order->status") }}</td>
										 <td>{{ $order->updated_at }}</td>
                                        <td>
											<a href="{{route('admin.order.refund',['id'=>$order->oid])}}"  class="btn btn-white btn-xs"><i class="fa fa-cny"></i>退款</a>
                                            <!--<a class="btn btn-danger btn-xs order-delete"
                                               data-href="{{ route('admin.order.destroyRefund',['id'=>$order->oid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>-->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $orders->render() !!}

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
        $(".order-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除任务?',
                href: $(this).data('href'),
                successTitle: '任务删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的任务?',
                href: $(this).data('href'),
                successTitle: '任务删除成功'
            });
        });
		$(".refundall").click(function(){
			 var ids = [];
			 var href = $(this).data('href');
			 $(".selectall-item").each(function (e) {
                if ($(this).prop('checked')) {
                    ids.push($(this).val());
                }
            });

            if (ids.length == 0) {
                swal('请选择需要退款的任务', '', 'warning');
                return false;
            }
			href = href.substring(0,href.length-1);
			window.location.href =href+ids;
			return false;
		});
    </script>

@endsection
