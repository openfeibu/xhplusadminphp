@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-association-create') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑社团</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.association.store') }}" method="POST"  enctype="multipart/form-data" >

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="aid" value="{{ isset($association['aid']) ? $association['aid'] : '' }}" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="aname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="{{ isset($association['aname']) ? $association['aname'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社长手机号码 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="leader_mobile"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="手机号码为社长注册账号填写的号码" placeholder="手机号码为社长注册账号填写的号码" value="{{ isset($association['leader_mobile']) ? $association['leader_mobile'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团头像 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="avatar_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($association['avatar_url']) ? $association['avatar_url'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团背景图片 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="background_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($association['background_url']) ? $association['background_url'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团简介 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="introduction"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($association['introduction']) ? $association['introduction'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团标签<span class="asterisk"></span></label>

                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="label" id="label">
                                        <option value="">请选择</option>
                                        @foreach($labels as $label)
                                        <option value="{{ $label->label }}">{{ $label->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团上级部门</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="superior"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($association['superior']) ? $association['superior'] : '' }}">
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary" id="create_association">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->
    </div>
@endsection
