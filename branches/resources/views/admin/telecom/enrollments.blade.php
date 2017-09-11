@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-telecomEnroll-enrollments') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">

                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">预约列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>

                                    <th>标识</th>
                                    <th>姓名</th>
                                    <th>预约日期</th>
                                    <th>预约开始时间</th>
									<th>预约结束时间</th>
                                    <!-- <th>操作</th> -->
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($enrollments as $enrollment)
                                    <tr>

                                         <td>{{ $enrollment->enroll_id }}</td>
                                         <td>{{ $enrollment->name }}</td>
                                         <td>{{ $enrollment->date }}</td>
										 <td>{{ $enrollment->time_start }}</td>
										 <td>{{ $enrollment->time_end }}</td>

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
    

@endsection
