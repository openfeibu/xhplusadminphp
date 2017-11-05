@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-orderInfo-refund') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑退款</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.order_info.refundHandle') }}" method="POST"  target="_blank">

                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">退款笔数</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="WIDbatch_num"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order_info->batch_num }}">
                                </div>

                            </div>
							<div class="text-center">注意：退款笔数(batch_num)，必填(值为您退款的笔数,取值1~1000间的整数)</div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">退款详细数据</label>
                                <div class="col-sm-6">
									<textarea class="form-control" rows="3" name="WIDdetail_data">{{ $order_info->detail_data }}</textarea>

                                </div>

                            </div>
							<div class="text-center">注意：退款详细数据(WIDdetail_data)，必填(支付宝交易号^退款金额^备注)多笔请用#隔开</div>
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">确定</button>
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
