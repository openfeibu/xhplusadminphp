@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">

                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">{{$user->nickname}} 钱包明细</h5>
                        @include('admin._partials.show-page-status',['result'=>$accounts])

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>标识</th>
                                    <th>类型</th>
                                    <th>订单号</th>
                                    <th>交易金额(元)</th>
                                    <th>服务费(元)</th>
                                    <th>钱包余额(元)</th>                             
                                    <th>日期</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($accounts as $account)
                                    <tr>
										<td>{{ $account->id }}</td>
                                        <td>{{ $account->trade_type }}</td>
                                        <td>{{ $account->out_trade_no }}</td>
                                        <td>{{ $account->fee }}</td>
                                        <td>{{ $account->service_fee }}</td>
                                        <td>{{ $account->wallet }}</td>
                                        <td>{{ $account->created_at }}</td>
                                    </tr>
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $accounts->render() !!}

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>


@endsection
