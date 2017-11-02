@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-order-userOrderBonuses') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">奖励金记录</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>标识</th>
                                    <th>用户id</th>
                                    <th>用户昵称/姓名</th>
                                    <th>接单数</th>
                                    <th>奖金</th>
                                    <th>日期</th>
                                    <th>结算情况</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($user_order_bonuses as $user_order_bonus)
                                    <tr>
                                        <td>{{ $user_order_bonus->id }}</td>
                                        <td>{{ $user_order_bonus->uid }}</td>
                                        <td>{{ $user_order_bonus->nickname }}({{$user_order_bonus->realname}})</td>
                                        <td>{{ $user_order_bonus->number }}</td>
                                        <td>{{ $user_order_bonus->bonus }}</td>
                                        <td>{{ $user_order_bonus->date }}</td>
                                        <td>{!! trans('common.bonus_status.'.$user_order_bonus->status) !!}</td>
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
