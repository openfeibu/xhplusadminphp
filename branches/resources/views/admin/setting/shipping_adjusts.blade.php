@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-setting-shippingAdjusts') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">调价配置</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>标识</th>
                                    <th>描述</th>
                                    <th>状态</th>
                                    <th>价格</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->id }}</td>
                                        <td>{{ $setting->name}}</td>
                                        <td>{{ trans('common.shipping_adjust_status.'.$setting->status )}}</td>
                                        <td>{{ $setting->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.setting.shippingAdjust',['id'=>$setting->id]) }}"
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
