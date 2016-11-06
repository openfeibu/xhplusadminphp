@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        {!! Breadcrumbs::render('admin-user-index') !!}
    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.user.destroy_all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">用户列表</h5>
                        @include('admin._partials.show-page-status',['result'=>$users])

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
                                    <th>用户昵称</th>
                                    <th>手机号码</th>
                                    <th>密码</th>
                                    <th>头像</th>
                                    <th>创建ip</th>
                                    <th>最近登录ip</th>
                                    <th>是否封号</th>
                                    <th>总积分</th>  
                                    <th>今日积分</th>                                 
                                    <th>提交时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                               	@foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $user->uid }}"
                                                       value="{{ $user->uid }}" class="selectall-item"/>
                                                <label for="id-{{ $user->uid }}"></label>
                                            </div>
                                        </td>
										<td>{{ $user->uid }}</td>
                                        <td>{{ $user->nickname }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->password }}</td>
										<td>
                                            <img src="{{ $user->avatar_url }}" alt="" style="width:50px;height:50px;">
										</td>
                                        <td>{{ $user->created_ip }}</td>
                                        <td>{{ $user->last_ip }}</td>
                                        <td>
                                            <?php
                                                if($user->ban_flag == 0){
                                                    echo "正常";
                                                }elseif($user->ban_flag == 1){
                                                    echo "已封号";  
                                                }
                                            ?>
                                        </td>
                                        <td>{{ $user->integral }}</td>
                                        <td>{{ $user->today_integral }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td style="width:150px">
                                            <a href="{{ route('admin.user.edit',['id'=>$user->uid]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="{{ route('admin.user.destroy',['id'=>$user->uid]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
								
                                @endforeach
			

                                </tbody>
                            </table>
                        </div>

                        {!! $users->render() !!}

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
                confirmTitle: '确定移除该用户?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定将选中的用户移除?',
                href: $(this).data('href'),
                successTitle: '移除成功'
            });
        });
    </script>

@endsection
