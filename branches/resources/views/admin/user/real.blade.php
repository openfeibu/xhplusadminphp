@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-user-real') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
			@include('admin._partials.real-left-menu')
            <div class="col-sm-9 col-lg-10">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.user.real_destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">实名列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$realnames])

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
                                    <th>用户名字</th>
									<th>用户填写的名字</th>
									<th>用户填写的身份证号</th>
                                    <th>正面图片</th>
									<th>反面图片</th>
                                    <th>实名状态</th>                               
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($realnames as $realname)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $realname->id }}"
                                                       value="{{ $realname->id }}" class="selectall-item"/>
                                                <label for="id-{{ $realname->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $realname->id }}</td>
										<td>{{ $realname->uid }}</td>
                                        <td>{{ $realname->realname }}</td>
										<td>{{ $realname->name }}</td>
										<td>{{ $realname->ID_Number }}</td>
                                        <td>
											
											<img id="img_pic" style="width:80px;height:50px;" src="{{ $realname->pic1 }}" data-toggle="modal" data-target="#myModal{{ $realname->id }}"/>
										</td>
										<td>
											<a  ><img style="width:80px;height:50px;" src="{{ $realname->pic2 }}"  data-toggle="modal" data-target="#myModal2{{ $realname->id }}"/></a>
										</td>
                                        <td>
											<?php
												if(empty($realname->realname)){
													echo "未审核";
												}else{
													echo "已审核";
												}
											?>
										</td>
                                        <td>{{ $realname->created_at }}</td>
                                        <td style="width:250px;text-align:right">
                                            @if (empty($realname->realname))
                                            <a data-target="#myModal_pass{{ $realname->id }}" data-toggle="modal" class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 通过</a>
                                            <a href="" class="btn btn-white btn-xs" data-target="#myModal_fail{{ $realname->id }}" data-toggle="modal" ><i class="fa fa-pencil"></i> 不通过   </a>
                                            @endif                                     
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="{{ route('admin.user.real_destroy',['id'=>$realname->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                    <!-- 模态框（Modal） -->
                                    <form action="{{ route('admin.user.real_pass') }}" method="post">
                                        <div class="modal fade" id="myModal_pass{{ $realname->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="height:400px;width:500px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &times;
                                                        </button>
                                                        填写实名姓名
                                                    </div>
                                                    <div class="modal-header">
                                                        <input type="text"  data-toggle="tooltip" name="username" class="form-control tooltips" id="username" data-original-title="不可为空">
                                                        <input type="text" type="hidden" name="uid" value="{{ $realname->uid }}" style="display:none">
                                                    </div>
                                            
                                                    <div class="modal-footer">
                                                        <input type="submit" value="确定" class="btn btn-default" id="submit" >
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal -->
                                        </div>
                                    </form>
                                    <!-- 模态框（Modal） -->
                                    <form  action="{{ route('admin.user.real_fail') }}" method="post">
                                        <div class="modal fade" id="myModal_fail{{ $realname->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="height:400px;width:700px;">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &times;
                                                        </button>
                                                        填写备注
                                                    </div>
                                                    <div class="modal-header">
                                                        <input type="text"  data-toggle="tooltip" name="beizhu" class="form-control tooltips" data-original-title="不可为空">
                                                        <input type="text" type="hidden" name="uid" value="{{ $realname->uid }}" style="display:none">
                                                    </div>
                                            
                                                    <div class="modal-footer">
                                                        <input type="submit" value="确定" class="btn btn-default">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal -->
                                        </div>
                                    </form>
									
									<!-- 模态框（Modal） -->
									<div class="modal fade" id="myModal{{ $realname->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" style="height:500px;width:700px;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													{{$realname->realname}}身份证正面
												</div>
												
												<a href="{{ $realname->pic1 }}"><img id="img_pic" style="width:600px;height:400px;margin-left:50px;" src="{{ $realname->pic1 }}" /></a> 
										
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">关闭
													</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal -->
									</div>
									<!-- 模态框（Modal） -->
									<div class="modal fade" id="myModal2{{ $realname->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" style="height:500px;width:700px;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													{{$realname->realname}}身份证反面
												</div>
												
												<a href="{{ $realname->pic2 }}"><img id="img_pic" style="width:600px;height:400px;margin-left:50px;" src="{{ $realname->pic2 }}" /></a> 
										
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">关闭
													</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal -->
									</div>
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $realnames->render() !!}

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
        $(".realname-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定移除该用户在实名列表中?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的用户移除出实名列表?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

    </script>

@endsection
