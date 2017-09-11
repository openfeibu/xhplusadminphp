@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-telecomEnroll-time') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">

                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">时间列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>

                                    <th>标识</th>
                                    <th>预约开始时间</th>
									<th>预约结束时间</th>
                                    <th>人数</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($times as $time)
                                    <tr>

                                         <td>{{ $time->time_id }}</td>
										 <td>{{ $time->time_start }}</td>
										 <td>{{ $time->time_end }}</td>
										 <td>{{ $time->count }}</td>
										 <td>{{ $time->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.telecomEnroll.editTime',['id'=>$time->time_id]) }}"
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
    <script type="text/javascript">
        $(".package-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除套餐?',
                href: $(this).data('href'),
                successTitle: '套餐删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的套餐?',
                href: $(this).data('href'),
                successTitle: '套餐删除成功'
            });
        });
    </script>

@endsection
