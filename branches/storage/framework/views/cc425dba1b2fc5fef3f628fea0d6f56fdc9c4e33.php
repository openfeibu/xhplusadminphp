<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-user-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
				
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.user.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.user.destroy_all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">用户列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$users], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                               	<?php foreach($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($user->uid); ?>"
                                                       value="<?php echo e($user->uid); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($user->uid); ?>"></label>
                                            </div>
                                        </td>
										<td><?php echo e($user->uid); ?></td>
                                        <td><?php echo e($user->nickname); ?></td>
                                        <td><?php echo e($user->mobile_no); ?></td>
                                        <td><?php echo e($user->password); ?></td>
										<td>
                                            <img src="<?php echo e($user->avatar_url); ?>" alt="" style="width:50px;height:50px;">
										</td>
                                        <td><?php echo e($user->created_ip); ?></td>
                                        <td><?php echo e($user->last_ip); ?></td>
                                        <td>
                                            <?php
                                                if($user->ban_flag == 0){
                                                    echo "正常";
                                                }elseif($user->ban_flag == 1){
                                                    echo "已封号";  
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo e($user->integral); ?></td>
                                        <td><?php echo e($user->today_integral); ?></td>
                                        <td><?php echo e($user->created_at); ?></td>
                                        <td style="width:150px">
                                            <a href="<?php echo e(route('admin.user.edit',['id'=>$user->uid])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>                                        
                                            <a class="btn btn-danger btn-xs realname-delete"
                                               data-href="<?php echo e(route('admin.user.destroy',['id'=>$user->uid])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
									
								
                                <?php endforeach; ?>
			

                                </tbody>
                            </table>
                        </div>

                        <?php echo $users->render(); ?>


                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    @parent
    <script src="<?php echo e(asset('js/ajax.js')); ?>"></script>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>