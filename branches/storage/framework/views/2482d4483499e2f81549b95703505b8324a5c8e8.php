<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-permission-index'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">

            <?php echo $__env->make('admin._partials.rbac-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="<?php echo e(route('admin.permission.create')); ?>" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="<?php echo e(route('admin.permission.destroy.all')); ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">权限列表</h5>

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
                                    <th>显示名称</th>
                                    <th>路由</th>
                                    <th>图标</th>
                                    <th>说明</th>
                                    <th>是否菜单</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($permissions as $permission): ?>
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-<?php echo e($permission->id); ?>"
                                                       value="<?php echo e($permission->id); ?>" class="selectall-item"/>
                                                <label for="id-<?php echo e($permission->id); ?>"></label>
                                                <a href="javascript:;" class="show-sub-permissions"
                                                   data-id="<?php echo e($permission['id']); ?>"><span
                                                            class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </td>
                                        <td><p class="text-info"><?php echo e($permission->display_name); ?></p></td>
                                        <td><?php echo e($permission->name); ?></td>
                                        <td><?php echo $permission->icon_html; ?></td>
                                        <td><?php echo e($permission->description); ?></td>
                                        <td><?php echo $permission->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.permission.edit',['id'=>$permission->id])); ?>"
                                               class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-sm permission-delete"
                                               data-href="<?php echo e(route('admin.permission.destroy',['id'=>$permission->id])); ?>"><i
                                                        class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>

                                    <?php if($permission->sub_permission->count()): ?>
                                        <?php foreach($permission->sub_permission as $sub): ?>
                                            <tr class="hide parent-permission-<?php echo e($permission->id); ?>">
                                                <td>
                                                    <div class="ckbox ckbox-default">
                                                        <input type="checkbox" name="id" id="id-<?php echo e($sub->id); ?>"
                                                               value="<?php echo e($sub->id); ?>" class="selectall-item"/>
                                                        <label for="id-<?php echo e($sub->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td>|-- <?php echo e($sub->display_name); ?></td>
                                                <td><?php echo e($sub->name); ?></td>
                                                <td><?php echo $sub->icon_html; ?></td>
                                                <td><?php echo e($sub->description); ?></td>
                                                <td><?php echo $sub->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>'; ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.permission.edit',['id'=>$sub->id])); ?>"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                                    <a class="btn btn-danger btn-sm permission-delete"
                                                       data-href="<?php echo e(route('admin.permission.destroy',['id'=>$sub->id])); ?>"><i
                                                                class="fa fa-trash-o"></i> 删除</a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    @parent
    <script src="<?php echo e(asset('js/ajax.js')); ?>"></script>
    <script>
        $(".show-sub-permissions").toggle(function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            subSelector.removeClass('hide');
        }, function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
            subSelector.addClass('hide');
        });

        $(".permission-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>