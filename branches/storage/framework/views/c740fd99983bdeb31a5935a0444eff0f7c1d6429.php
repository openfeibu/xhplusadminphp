<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-role-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.role.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.role.destroy.all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">游戏列表</h5>
                        <?php echo $__env->make('admin._partials.show-page-status',['result'=>$roles], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                                    <th>角色名</th>
                                    <th>说明</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($roles as $role): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($role->id); ?>"
                                                       value="<?php echo e($role->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($role->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo e($role->name); ?></td>
                                        <td><?php echo e($role->display_name); ?></td>
                                        <td><?php echo e($role->description); ?></td>
                                        <td><?php echo e($role->created_at); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.role.edit',['id'=>$role->id])); ?>"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a href="<?php echo e(route('admin.role.permissions',['id'=>$role->id])); ?>"
                                            class="btn btn-info btn-xs role-permissions"><i class="fa fa-wrench"></i> 权限</a>
                                            <a class="btn btn-danger btn-xs role-delete"
                                               data-href="<?php echo e(route('admin.role.destroy',['id'=>$role->id])); ?>">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php echo $roles->render(); ?>


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
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>