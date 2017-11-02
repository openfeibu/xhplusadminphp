@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-order-orderBonusSetting') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">奖励金配置</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>标识</th>
                                    <th>接单数</th>
                                    <th>奖金</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($order_bonus_settings as $order_bonus_setting)
                                    <tr>
                                        <td>{{ $order_bonus_setting->id }}</td>
                                        <td>{{ $order_bonus_setting->number }}</td>
                                        <td>{{ $order_bonus_setting->bonus }}</td>
                                        <td>
                                            <a href="{{ route('admin.order.orderBonusSettingEdit',['id'=>$order_bonus_setting->id]) }}"
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
