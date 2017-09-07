@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-education-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.education.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.education.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">店铺列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$educations])

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
                                    <th>描述</th>
                                    <th>logo</th>
                                    <th>图片</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($educations as $education)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $education->education_id }}"
                                                       value="{{ $education->edu_id }}" class="selectall-item"/>
                                                <label for="id-{{ $education->edu_id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $education->edu_id }}</td>
                                        <td>{{ $education->name }}</td>
                                        <td>{{ $education->desc }}</td>
                                        <td><img src="{{ $education->logo_url }}" width="100px"/></td>
                                        <td><img src="{{ $education->img_url }}" width="100px"/></td>
                                        <td>{{ $education->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.education.createPro',['edu_id'=>$education->edu_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 添加产品</a>
                                            <a href="{{ route('admin.education.edit',['id'=>$education->edu_id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>

                                            <a class="btn btn-danger btn-xs delete"
                                               data-href="{{ route('admin.education.destroy',['id'=>$education->edu_id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $educations->render() !!}

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
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

        </script>

    @endsection

@endsection
