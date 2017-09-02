@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-recommend-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.recommend.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.recommend.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">推荐列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$recommends])

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
                                    <th>名称</th>
                                    <th>图片</th>
                                    <th>链接</th>
                                    <th>类型</th>
                                    <th>排序</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($recommends as $recommend)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $recommend->id }}"
                                                       value="{{ $recommend->id }}" class="selectall-item"/>
                                                <label for="id-{{ $recommend->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $recommend->id }}</td>
                                        <td>{{ $recommend->name }}</td>
                                        <td><img src="{{ $recommend->img }}" width="100px"/></td>
                                        <td>{{ $recommend->url }}</td>
                                        <td>{!! trans('common.recommend_type.'.$recommend->type) !!}</td>
                                        <td>{{ $recommend->sort }}</td>
                                        <td>{{ $recommend->created_at }}</td>        
                                        <td>
                                            <a href="{{ route('admin.recommend.edit',['id'=>$recommend->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>

                                            <a class="btn btn-danger btn-xs recommend-delete"
                                               data-href="{{ route('admin.recommend.destroy',['id'=>$recommend->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $recommends->render() !!}

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
