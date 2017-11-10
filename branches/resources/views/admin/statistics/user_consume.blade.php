@extends('layouts.admin-app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/rome.css') }}" type="" media=""/>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>统计</span></h2>
        {!! Breadcrumbs::render('admin-statistics-userConsume') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">店铺用户消费留存</h5>
                        <div>
                            <h4>说明：</h4>
                            <p>消费用户总数包括退款用户；</p>
                            <p>次日留存 = 前一天(t-1)消费今天(t)依然消费的用户量；3日留存 = 前两天(t-1)(t-2)均有消费今天依然消费的用户量；</p>
                            <p>次日留存率 = 次日留存／前一天(t-1)消费用户；3日留存率 = 3日留存／(t-2)总消费用户；</p>
                        </div>
                        <form action="{{route('admin.statistics.userConsume')}}">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="datemy" id="datemy" value="{{$datemy}}">

                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary" name="submit" value="搜索" style="height:40px">
                            </div>
                            <div class="pull-right">
                                <div class="btn-group mr10">
    								<a  class="btn btn-white tooltips" data-original-title="导出" id="download"><i class="glyphicon glyphicon-save"></i></a>
                                </div>
                            </div><!-- pull-right -->
                        </form>
                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>消费用户总数</th>
                                    <th>次日留存</th>
                                    <th>次日留存率</th>
                                    <th>3日留存</th>
                                    <th>3日留存率</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($keep_datas as $keep_data)
                                    <tr>
                                        <td>{{ $keep_data['date'] }}</td>
                                        <td>{{ $keep_data['count'] }}</td>
                                        <td>{{ $keep_data['keep_1_count'] }}</td>
                                        <td>{{ $keep_data['keep_1_rate'] }}</td>
                                        <td>{{ $keep_data['keep_3_count'] }}</td>
                                        <td>{{ $keep_data['keep_3_rate'] }}</td>
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
