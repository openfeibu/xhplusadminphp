@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-integral_history-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.integral_history.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">积分类型列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$integral_history])
                        <br>
                        <form action="{{route('admin.integral_history.index')}}" class="bs-example bs-example-form" method="get">
                            <div class="input-group">
                                <div class="col-sm-7 col-md-7">
                                   <input type="text" class="form-control" placeholder="用户ID或者用户昵称" name="uid"> 
                                </div>
                                <div class="col-sm-3 col-md-3">
                                   <span class="input-group-btn"> 
                                    <input type="submit" class="btn btn-primary" value="搜索">
                                    </span> 
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>
                                    </th>
                                    <th>标识</th>
                                    <th>用户id</th>
                                    <th>用户昵称</th>
                                    <th>积分类型id</th>
                                    <th>积分类型名称</th>                              
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($integral_history as $history)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $history->id }}"
                                                       value="{{ $history->id }}" class="selectall-item"/>
                                                <label for="id-{{ $history->id }}"></label>
                                            </div>
                                        </td>
										<td>{{ $history->id }}</td>
                                        <td>{{ $history->uid }}</td>
                                        <td>{{ $history->nickname }}</td>
                                        <td>{{ $history->integral_id }}</td>
                                        <td>{{ $history->obtain_type }}</td>
                                        <td>{{ $history->created_at }}</td>
										<td>
                                        <td style="width:150px">                                     
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="{{ route('admin.integral_history.destroy',['id'=>$history->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
								
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $integral_history->render() !!}

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
        $(".realname-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该用户在实名列表中?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的用户移除出实名列表?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

@endsection
