@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-loss_cate-create') !!}
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
                        <h4 class="panel-title">添加分类</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.loss_cate.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">

							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">分类名称</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="cat_name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">排序</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="sort"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="">
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
