@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-topic-comment') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.topic.comment_destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">话题管理</h5>


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
                                    <th>话题id</th>
                                    <th>话题内容</th>
                                    <th>话题类型</th>
                                    <th>评论内容</th>
                                    <th>点赞数量</th>                            
                                    <th>评论时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $comment->tcid }}"
                                                       value="{{ $comment->tcid }}" class="selectall-item"/>
                                                <label for="id-{{ $comment->tcid }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $comment->tcid }}</td>
										<td>{{ $comment->uid }}</td>
                                        <td>{{ $comment->nickname }}</td>
                                        <td>{{ $comment->tid }}</td>
                                        <td  style="width:150px;height: 70px;display: -webkit-box; -webkit-box-orient ;text-overflow: ellipsis;overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">{{ base64_decode($comment->topic_content) }}</td>
                                        <td>{{ $comment->type }}</td>
                                        <td style="width:150px;height: 70px;display: -webkit-box; -webkit-box-orient ;text-overflow: ellipsis;overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">{{ base64_decode($comment->content) }}</td>
                                        <td>{{ $comment->favourites_count}}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td style="width:150px">
                                            <a href="{{ route('admin.topic.comment_edit',['id'=>$comment->tcid]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs topic-delete"
                                               data-href="{{ route('admin.topic.comment_destroy',['id'=>$comment->tcid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
							
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $comments->render() !!}

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
        $(".topic-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该评论?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的评论移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

@endsection
