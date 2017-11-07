@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-setting-shippingConfigs') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">商家配送费配置</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>标识</th>
                                    <th>价格区间</th>
                                    <th>最高重量</th>
                                    <th>超出重量kg/元</th>
                                    <th>配送费</th>
                                    <th>出费者</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->cid }}</td>
                                        <td>{{ $setting->min }} ～ {{ $setting->max }}</td>
                                        <td>{{ $setting->weight }}</td>
                                        <td>{{ $setting->outweight }}</td>
                                        <td>{{ $setting->shipping_fee }}</td>
                                        <td>{{ trans('common.payer.'.$setting->payer )}}</td>
                                        <td>
                                            <a href="{{ route('admin.setting.shippingConfig',['id'=>$setting->cid]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    @section('javascript')
        @parent


    @endsection

@endsection
