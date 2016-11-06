@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-topic-comment_create') !!}
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
                        <h4 class="panel-title">添加话题</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.topic.comment_store') }}" method="POST">
                        <input type="hidden" name="tcid" value="{{$comments['tcid']}}">
                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="uid" value="{{$comments['uid']}}" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="nickname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{$comments['nickname']}}" readOnly="true" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">话题内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{$comments['content']}}" readOnly="true" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">评论内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="comment_content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{$comments['topic_content']}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">点赞数量 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="favourites_count"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="{{$comments['favourites_count']}}">
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    <a class="btn btn-primary" href="{{ route('admin.topic.comment') }}" >取消</a>
                                </div>
                            </div>
                        </div>
                        <!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection
