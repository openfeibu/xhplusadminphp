@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-shop-edit') !!}
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
                        <h4 class="panel-title">编辑店铺</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.shop.update') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="shop_id" value="{{$shop->shop_id}}" />
                        <div class="panel-body panel-body-nopadding">

							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">店铺名称</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="shop_name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $shop->shop_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">店铺图片</label>
                                <div class="col-sm-6">
                                    <input type="file" name="uploadfile" class="form-control tooltips">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox"></label>
                                <div class="col-sm-6">
                                    <img src="{{ $shop->shop_img }}" width="200"/>
                                    <input type="hidden" name="shop_img" value="{{ $shop->shop_img }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">营业时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="open_time"
                                           data-trigger="hover" class="form-control tooltips" value="{{ $shop->open_time }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">打烊时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="close_time"
                                           data-trigger="hover" class="form-control tooltips" value="{{ $shop->close_time }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">店铺详情</label>
                                <div class="col-sm-6">
                                    <textarea name="description"  data-trigger="hover" class="form-control tooltips">{{ $shop->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">店铺状态</label>
                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="shop_status" id="shop_status">
                                        <option value="1" @if($shop->shop_status == 1) selected @endif>开店</option>
                                        <option value="3" @if($shop->shop_status == 3) selected @endif>暂停营业</option>
                                        <option value="4" @if($shop->shop_status == 4) selected @endif>管理员关闭</option>
                                    </select>
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
