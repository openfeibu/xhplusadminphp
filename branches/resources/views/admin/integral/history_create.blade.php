@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-integral_history-create') !!}
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
                        <h4 class="panel-title">编辑用户积分历史</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.integral_history.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="id" style="display:none" value="{{ isset($integral_history['id']) ? $integral_history['id'] : '' }}" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户id<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="uid"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($integral_history['uid']) ? $integral_history['uid'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">积分类型<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="integral_id" >
                                    @foreach($integrals as $integral)
                                        <option value="{{$integral->id}}">{{$integral->obtain_type}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                     <a class="btn btn-primary" href="{{ route('admin.integral_history.index') }}" >取消</a>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
