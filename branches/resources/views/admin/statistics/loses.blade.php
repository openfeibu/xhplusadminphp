@extends('layouts.admin-app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/rome.css') }}" type="" media=""/>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>统计</span></h2>
        {!! Breadcrumbs::render('admin-statistics-loseOrderInfoUser') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="subtitle mb5">升价后未下单用户（{{$count}}人）</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>用户id</th>
                                    <th>用户昵称</th>
                                    <th>用户手机号码</th>
                                    <th>上次访问时间</th>
                                    <th>注册时间</th>
                                    <th>上次登录时间</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->uid }}</td>
                                        <td>{{ $user->nickname }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->last_visit }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->last_login }}</td>
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
    <script src="{{ asset('js/rome.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        rome(datemy, {
          "inputFormat": "YYYY-MM",
        });
    </script>

@endsection
