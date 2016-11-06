@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-telecomOrder-edit') !!}
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
                        <h4 class="panel-title">编辑订单</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.telecomOrder.update',['id'=>$order->id]) }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">姓名</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">身份证</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="idcard"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->idcard }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">（院系）专业</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="major"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->major }}">
                                </div>
                            </div>       
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">宿舍号</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="dormitory_no"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->dormitory_no }}">
                                </div>
                            </div>  
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">学号</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="student_id"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->student_id }}">
                                </div>
                            </div>  
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">常用电话</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="telecom_outOrderNumber"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="{{ $order->telecom_outOrderNumber }}">    
                                </div>
                            </div>  
						
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
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
