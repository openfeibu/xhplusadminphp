@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>

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
                        <h4 class="panel-title">饭堂配送费配置</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.setting.canteenShippingConfigUpdate') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$setting->cid}}" />
                        <div class="panel-body panel-body-nopadding">

							<!-- <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">name</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $setting->name }}">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">最低价格</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="min"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $setting->min }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">最高价格</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="max"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $setting->max }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">最高价格</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="shipping_fee"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $setting->shipping_fee }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">出费者<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="payer" id="payer">
                                        <option value="buyer" @if($setting->payer == 'buyer')selected @endif>{{trans('common.payer.buyer')}}</option>
                                        <option value="seller" @if($setting->payer == 'seller')selected @endif>{{trans('common.payer.seller')}}</option>
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
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>


@endsection
