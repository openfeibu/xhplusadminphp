@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-user-create') !!}
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
                        <h4 class="panel-title">编辑用户</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.user.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
									<input type="text"  data-toggle="tooltip" name="uid"
										   data-trigger="hover" class="form-control tooltips"
										   data-original-title="不可编辑" value="{{ isset($user['uid']) ? $user['uid'] : '' }}" style="display:none">
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="nickname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{ isset($user['nickname']) ? $user['nickname'] : '' }}">
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">手机号码<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="mobile_no"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['mobile_no']) ? $user['mobile_no'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">密码<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="password"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['password']) ? $user['password'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">头像<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="avatar_url"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['avatar_url']) ? $user['avatar_url'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">创建用户IP<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="created_ip"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['created_ip']) ? $user['created_ip'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">最后登录IP<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="last_ip"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['last_ip']) ? $user['last_ip'] : '' }}">
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否封号<span class="asterisk"></span></label>
                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="ban_flag" >
                                        <option value="10">请选择</option>
                                        <option value="0">正常</option>
										<option value="1">封号</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否设置为小编<span class="asterisk"></span></label>
                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="is_author" >
                                        <option value="10">请选择</option>
                                        @if($user['is_author'] != 0)
                                            <option value="0">贬为庶民</option>
                                        @endif
                                        <option value="1">小编</option>
                                        <option value="2">管理员</option>
                                    </select>
                                </div>
                                <span class="asterisk">当前为：
                                @if($user['is_author'] == 0)
                                    平民
                                @elseif($user['is_author'] == 1)
                                    小编
                                @elseif($user['is_author'] == 2)
                                    管理员
                                @else
                                    未知
                                @endif
                                </span>
                            </div>
                            <input type="hidden" name="old_author" value="{{$user['is_author']}}">
                            <input type="hidden" name="old_ban_flag" value="{{$user['ban_flag']}}">
                             <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">总积分<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="integral"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['integral']) ? $user['integral'] : '' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">今日积分<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="today_integral"
                                           data-trigger="hover" class="form-control tooltips" value="{{ isset($user['today_integral']) ? $user['today_integral'] : '' }}">
                                </div>
                            </div> -->

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
