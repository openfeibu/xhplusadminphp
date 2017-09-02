@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-shop-create') !!}
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
                        <h4 class="panel-title">添加店铺</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.shop.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="panel-body panel-body-nopadding">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">注册手机号码 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="mobile"
                                           data-trigger="hover" class="form-control tooltips">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">商店名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="shop_name"
                                           data-trigger="hover" class="form-control tooltips">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商店地址 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="address"
                                           data-trigger="hover" class="form-control tooltips">
                                </div>
                            </div>

							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">店铺图片<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="file" name="uploadfile" class="form-control tooltips">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">营业时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="open_time"
                                           data-trigger="hover" class="form-control tooltips" value="00:00:00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">打烊时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="close_time"
                                           data-trigger="hover" class="form-control tooltips"  value="24:00:00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商店详情</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="description"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">商店类型 <span class="asterisk">*</span></label>

                                 <div class="col-sm-2">
                                    <select class="form-control input-sm" name="shop_type" >
                                        <option value="1">学生</option>
										<option value="2">商家</option>
                                        <option value="3">食堂</option>
                                    </select>
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    <a class="btn btn-primary" href="{{ route('admin.topic.index') }}" >取消</a>
                                </div>
                            </div>
                        </div>
                        <!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
