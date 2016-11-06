@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-association-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.association.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">社团列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$associations])

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
									<th>社团名称</th>
                                    <th>社团图片</th>>
                                    <th>社团人数</th>
                                    <th>社团简介</th>
									<th>社团管理人</th>                          
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($associations as $association)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $association->aid }}"
                                                       value="{{ $association->aid }}" class="selectall-item"/>
                                                <label for="id-{{ $association->aid }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $association->aid }}</td>
										<td>{{ $association->aname }}</td>
                                        <td>
                                            <img src="{{ $association->avatar_url }}" alt="" style="width:50px;height:50px;">
                                        </td>
                                        <td>{{ $association->member_number }}</td>
                                        <td>{{ $association->introduction }}</td>
                                        <td>{{ $association->superior }}</td>
                                        <td>{{ $association->created_at }}</td>
                                        <td style="width:150px">
                                            <a href="{{ route('admin.association.edit',['id'=>$association->aid]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="{{ route('admin.association.destroy',['id'=>$association->aid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $associations->render() !!}

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
                confirmTitle: '确定删除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的社团移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

@endsection
