@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-drivingSchool-edit') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑店铺</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.drivingSchool.update') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$driving_school->ds_id}}" />
                        <div class="panel-body panel-body-nopadding">

							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">驾校名称</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $driving_school->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">电话</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="tell"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ $driving_school->tell }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">驾校logo</label>
                                <div class="col-sm-6">
                                    <input type="file" name="uploadfile_logo" class="form-control tooltips">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox"></label>
                                <div class="col-sm-6">
                                    <img src="{{ $driving_school->logo_url }}" width="200"/>
                                    <input type="hidden" name="logo_url" value="{{ $driving_school->logo_url }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">驾校图片</label>
                                <div class="col-sm-6">
                                    <input type="file" name="uploadfile_img" class="form-control tooltips">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox"></label>
                                <div class="col-sm-6">
                                    <img src="{{ $driving_school->img_url }}" width="200"/>
                                    <input type="hidden" name="img_url" value="{{ $driving_school->img_url }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">描述</label>
                                <div class="col-sm-6">
                                    <textarea name="desc"  data-trigger="hover" class="form-control tooltips">{{ $driving_school->desc }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">详情</label>
                                <div class="col-sm-6">
                                    <textarea name="content"  data-trigger="hover" class="form-control tooltips" style="height:500px;">{{ $driving_school->content }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
                                    <a href="{{ route('admin.drivingSchool.createPro',['ds_id'=>$driving_school->ds_id]) }}"
                                       class="btn btn-white btn-xs">添加产品</a>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table mb30">
                        <thead>
                        <tr>
                            <th>标识</th>
                            <th>名称</th>
                            <th>线下价</th>
                            <th>线上价</th>
                            <th>描述</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->original_price }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.drivingSchool.editPro',['id'=>$product->product_id]) }}"
                                       class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                    <a class="btn btn-danger btn-xs delete"
                                       data-href="{{ route('admin.drivingSchool.destroyPro',['id'=>$product->product_id]) }}">
                                        <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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

    </script>

@endsection
