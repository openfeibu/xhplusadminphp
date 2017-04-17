@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-loss-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.loss.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">分类列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$losses])

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
                                    <th>发布者</th>
                                    <th>分类名称</th>
                                    <th>内容</th>
                                    <th>联系方式</th>
                                    <th>图片</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($losses as $loss)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $loss->loss_id }}"
                                                       value="{{ $loss->loss_id }}" class="selectall-item"/>
                                                <label for="id-{{ $loss->loss_id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loss->loss_id }}</td>
                                        <td>{{ $loss->nickname}}</td>
                                        <td>{{ $loss->cat_name }}</td>
                                        <td>{{ $loss->content }}</td>
                                        <td>{{ $loss->mobile }}</td>
                                        <td>@if($loss->thumb)<img src="{{ $loss->thumb }}" width='100px';/>@else 无 @endif</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs delete"
                                               data-href="{{ route('admin.loss.destroy',['id'=>$loss->loss_id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $losses->render() !!}

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
        $(".delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除?',
                href: $(this).data('href'),
                successTitle: '删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '删除选中的列表?',
                href: $(this).data('href'),
                successTitle: '删除成功'
            });
        });
    </script>

@endsection
