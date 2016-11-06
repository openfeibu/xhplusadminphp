@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-topic-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.topic.destroy_all') }}"><i
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
                                    <th>话题类型</th>
                                    <th>话题内容</th>
									<th>阅读数量</th>
                                    <th>评论数量</th>
                                    <th>点赞数量</th>
                                    <th>是否置顶</th>                               
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($topics as $topic)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $topic->tid }}"
                                                       value="{{ $topic->tid }}" class="selectall-item"/>
                                                <label for="id-{{ $topic->tid }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $topic->tid }}</td>
										<td>{{ $topic->uid }}</td>
                                        <td>{{ $topic->nickname }}</td>
                                        <td>{{ $topic->type }}</td>
                                        <td>{{ $topic->content }}</td>
                                        <td>{{ $topic->view_num }}</td>
                                        <td>{{ $topic->comment_num }}</td>
                                        <td>{{ $topic->favourites_count}}</td>
                                        <td>
                                            <?php
                                                if($topic->is_top == 0){
                                                    echo "未置顶";
                                                }elseif($topic->is_top == 1){
                                                    echo "已置顶";
                                                }
                                            ?>
                                        </td>
                                        <td>{{ $topic->created_at }}</td>
                                        <td style="width:150px">
                                            <a href="{{ route('admin.topic.edit',['id'=>$topic->tid])}}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs topic-delete"
                                               data-href="{{ route('admin.topic.destroy',['id'=>$topic->tid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
							
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $topics->render() !!}

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
                confirmTitle: '确定移除该话题?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的话题移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

@endsection
