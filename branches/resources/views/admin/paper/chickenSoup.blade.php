@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-paper-chickenSoup') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
			@include('admin._partials.chickenSoup-left-menu')
            <div class="col-sm-9 col-lg-10">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                 <a href="{{ route('admin.chickenSoup.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.chickenSoup.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">实名列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$chickenSoups])

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
                                    <th>鸡汤标题</th>
                                    <th>背景图片</th>
									<th>鸡汤内容</th>
                                    <th>审核状态</th>                               
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($chickenSoups as $chickenSoup)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $chickenSoup->csid }}"
                                                       value="{{ $chickenSoup->csid }}" class="selectall-item"/>
                                                <label for="id-{{ $chickenSoup->csid }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $chickenSoup->csid }}</td>
                                        <td>{{ $chickenSoup->uid }}</td>
                                        <td>
                                            @if ($chickenSoup->uid == 0)
                                                系统
                                            @else
                                                {{ $chickenSoup->nickname }}
                                            @endif
                                        </td>
                                        <td>{{ $chickenSoup->title }}</td>
                                        <td>
                                            <img src="{{ $chickenSoup->background_url }}" alt="" style="width:80px;height:80px">
                                        </td>
                                        <td style="width:100px;display: -webkit-box; -webkit-box-orient ;text-overflow: ellipsis;overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{{ $chickenSoup->content }}</td>
                                        <td>
											@if ($chickenSoup->status == 0)
                                                审核中
                                            @elseif ($chickenSoup->status == 1)
                                                审核通过
                                            @elseif ($chickenSoup->status == 2)
                                                审核失败
                                            @else
                                                未知状态
                                            @endif
										</td>
                                        <td>{{ $chickenSoup->created_at }}</td>
                                        <td style="width:300px;text-align:right">
                                            @if ($chickenSoup->status == 0) 
                                            <a href="{{ route('admin.chickenSoup.pass',['id'=>$chickenSoup->csid]) }}" data-target="" data-toggle="modal" class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 通过</a>
                                            <a href="{{ route('admin.chickenSoup.fail',['id'=>$chickenSoup->csid]) }}" class="btn btn-white btn-xs" data-target="" data-toggle="modal" ><i class="fa fa-pencil"></i> 不通过   </a>
                                            @endif
                                            <a href="{{ route('admin.chickenSoup.edit',['id'=>$chickenSoup->csid]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                       
                                            <a class="btn btn-danger btn-xs chickenSoup-delete"
                                               data-href="{{ route('admin.chickenSoup.destroy',['id'=>$chickenSoup->csid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									</div>
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $chickenSoups->render() !!}

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
        $(".chickenSoup-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该鸡汤?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的鸡汤移出鸡汤列表?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

    </script>

@endsection
