@extends('layouts.admin-app')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/rome.css') }}" type="" media=""/>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-telecomOrder-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <!--<a href="{{ route('admin.telecomOrder.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>-->
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.telecomOrder.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
								<a  data-target="#export" data-toggle="modal" class="btn btn-white tooltips" data-original-title="导出"  ><i class="glyphicon glyphicon-save"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">套餐列表</h5>
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
                                    <th>ID</th>
									<th>用户id</th>
									<th>用户昵称</th>
									<th>姓名</th>
									<th>套餐</th>
									<!--<th>身份证</th>									
									<th>（院系）专业</th>
									<th>宿舍号</th>-->
									<th>学号</th>                                  
                                    <th>金额</th>
									<th>电信手机号码</th>
									<th>ICCID</th>		
									<th>常用电话</th>																
									<th>支付状态</th>
									<th>实名状态</th>
									<th>交易订单号</th>
                                    <th>支付交易号</th>
                                    <th>办理人手机号码</th>
                                    <th>办理人编号</th>
                                    <th>创建时间</th>								
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $order->id }}"
                                                       value="{{ $order->id }}" class="selectall-item"/>
                                                <label for="id-{{ $order->id }}"></label>
                                            </div>
                                        </td>
										 <td>{{ $order->id }}</td>
										 <td>{{ $order->uid }}</td>
										 <td>{{ $order->nickname }}</td>
										 <td>{{ $order->name }}</td>
										 
										 <td>{{ $order->package_name }}</td>
										 <!--<td>{{ $order->idcard }}</td>										 
										 <td>{{ $order->major }}</td>
										 <td>{{ $order->dormitory_no }}</td>-->
										 <td>{{ $order->student_id }}</td>
										 <td>{{ $order->fee }}</td>
										 <td>{{ $order->telecom_phone }}</td>
										 <td>{{ $order->telecom_iccid }}</td>
										 <td>{{ $order->telecom_outOrderNumber }}</td>										
										 <td>{{ trans("common.pay_status.$order->pay_status") }}</td>
										 <td>{{ trans("common.telecom_real_name_status.$order->telecom_real_name_status") }}</td>
										 <td>{{ $order->telecom_trade_no }}</td>
										 <td>{{ $order->trade_no }}</td>
										 <td>{{ $order->mobile_no }}</td>
										 <td>{{ $order->transactor }}</td>
										 <td>{{ $order->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.telecomOrder.edit',['id'=>$order->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <!--<a class="btn btn-danger btn-xs order-delete"
                                               data-href="{{ route('admin.telecomOrder.destroy',['id'=>$order->id]) }}">
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
    <form action="{{ route('admin.telecomOrder.save') }}" method="get">
	    <div class="modal fade bs-modal-lg" id="export" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
			    <div class="modal-header">
				    <div class="form-group">
					    <label for="startTime" class="col-sm-2 control-label">开始时间</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control"  name="startTime" id="startTime" >
					    </div>
					</div>
					<div class="form-group">
					    <label for="endTime" class="col-sm-2 control-label">结束时间</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="endTime" id="endTime" >
					    </div>
					</div>
					<div class="form-group">
					    <label for="real" class="col-sm-2 control-label">实名状态</label>
					    <div class="col-sm-10">
						    <select class="form-control" name="real">
							  <option value='1'>已实名</option>
							  <option value='0'>未实名</option>
							  <option value='2'>实名认证中</option>
							  <option value='3'>全部</option>
							</select>
						</div>
					</div>
				</div>
		      	<div class="modal-footer">
	                <input type="submit" value="确定" class="btn btn-default" id="submit" >
	                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
	                </button>
	            </div>
		    </div>
		  </div>
		</div>
	</form>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/rome.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        $(".order-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除订单?',
                href: $(this).data('href'),
                successTitle: '订单删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的订单?',
                href: $(this).data('href'),
                successTitle: '订单删除成功',
            });
        });

        rome(startTime, {
		  dateValidator: rome.val.beforeEq(endTime)
		});

		rome(endTime, {
		  dateValidator: rome.val.afterEq(startTime)
		});
    </script>

@endsection
