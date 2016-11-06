@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-integral-create') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑积分列表</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.integral.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
								<label class="col-sm-3 control-label">id <span class="asterisk">*</span></label>
								<div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="id"
										   data-trigger="hover" class="form-control tooltips"
										   data-original-title="不可编辑" value="{{ isset($integral['id']) ? $integral['id'] : '' }}" readonly="true">
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">积分方式<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="obtain_type"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($integral['obtain_type']) ? $integral['obtain_type'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">积分奖罚<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="score"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($integral['score']) ? $integral['score'] : '' }}">
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                     <a class="btn btn-primary" href="{{ route('admin.integral.index') }}" >取消</a>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
