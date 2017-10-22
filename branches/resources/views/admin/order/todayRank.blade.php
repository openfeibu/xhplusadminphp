@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-order-todayRank') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="subtitle mb5">列表</h5>
                        <form action="{{route('admin.order.todayRank')}}">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="date" id="date" value="{{$date}}">

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
                                    <th>标识</th>
                                    <th>用户名</th>
                                    <th>真实姓名</th>
                                    <th>手机号码</th>
									<th>接单总数</th>

                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($users as $user)
                                    <tr>
                                         <td>{{ $user->uid }}</td>
										 <td>{{ $user->nickname }}</td>
                                         <td>{{ $user->realname }}</td>
                                         <td>{{ $user->mobile_no }}</td>
										 <td>{{ $user->count }}</td>
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
    <script type="text/javascript">
        rome(date, {
          "inputFormat": "YYYY-MM-DD",
        });
    </script>

@endsection
