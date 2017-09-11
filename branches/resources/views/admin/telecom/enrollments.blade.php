@extends('layouts.admin-app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/rome.css') }}" type="" media=""/>
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
                            <div class="btn-group mr10">

								<a  data-target="#export" data-toggle="modal" class="btn btn-white tooltips" data-original-title="导出"  ><i class="glyphicon glyphicon-save"></i></a>
                            </div>
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
    <form action="{{ route('admin.telecomEnroll.saveEnroll') }}" method="get">
	    <div class="modal fade bs-modal-lg" id="export" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
			    <div class="modal-header">
				    <div class="form-group">
					    <label for="date" class="col-sm-2 control-label">开始时间</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control"  name="date" id="date" value="{{$date}}">
					    </div>
					</div>
				</div>
		      	<div class="modal-footer">
	                <input type="submit" value="确定" class="btn btn-default" id="submit" >
	                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
	                </button>
	            </div>
		    </div>
		  </div>
		</div>
	</form>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/rome.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript">
        rome(date, { time: false });
    </script>

@endsection
