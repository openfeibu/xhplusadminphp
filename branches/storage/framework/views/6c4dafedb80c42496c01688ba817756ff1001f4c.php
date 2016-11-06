<?php $__env->startSection('content'); ?>
    <style>
        .sub-permissions-ul li {
            float: left;

        }
    </style>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-role-permission'); ?>

    </div>

    <div class="contentpanel">

        <div class="row">

            <?php echo $__env->make('admin._partials.rbac-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑[<?php echo e($role->display_name); ?>]权限</h4>
                    </div>

                    <form action="<?php echo e(route('admin.role.permissions',['id'=>$role->id])); ?>" method="post"
                          id="role-permissions-form">
                        <div class="panel-body panel-body-nopadding">
                            <?php foreach($permissions as $permission): ?>
                                <div class="top-permission col-md-12">
                                    <a href="javascript:;" class="display-sub-permission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    <?php if(in_array($permission['id'],array_keys($rolePermissions))): ?>
                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission['id']); ?>"
                                               class="top-permission-checkbox" checked/>
                                    <?php else: ?>
                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission['id']); ?>"
                                               class="top-permission-checkbox"/>
                                    <?php endif; ?>
                                    <label><h5>&nbsp;&nbsp;<?php echo e($permission['display_name']); ?></h5></label>
                                </div>
                                <?php if(count($permission['subPermission'])): ?>
                                    <div class="sub-permissions col-md-11 col-md-offset-1">
                                        <?php foreach($permission['subPermission'] as $sub): ?>
                                            <div class="col-sm-3">
                                                <?php if($sub['is_menu']): ?>
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="<?php echo e($sub['id']); ?>"
                                                                  class="sub-permission-checkbox" <?php echo e(in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':''); ?>/>&nbsp;&nbsp;<span
                                                                class="fa fa-bars"></span><?php echo e($sub['display_name']); ?>

                                                    </label>
                                                <?php else: ?>
                                                    <label><input type="checkbox" name="permissions[]"
                                                                  value="<?php echo e($sub['id']); ?>"
                                                                  class="sub-permission-checkbox" <?php echo e(in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':''); ?>/>&nbsp;&nbsp;<?php echo e($sub['display_name']); ?>

                                                    </label>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary" id="save-role-permissions">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>

                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    @parent
    <script src="<?php echo e(asset('js/ajax.js')); ?>"></script>
    <script>
        $(".display-sub-permission-toggle").toggle(function () {
            $(this).children('span').removeClass('glyphicon-minus').addClass('glyphicon-plus')
                    .parents('.top-permission').next('.sub-permissions').hide();
        }, function () {
            $(this).children('span').removeClass('glyphicon-plus').addClass('glyphicon-minus')
                    .parents('.top-permission').next('.sub-permissions').show();
        });

        $(".top-permission-checkbox").change(function () {
            $(this).parents('.top-permission').next('.sub-permissions').find('input').prop('checked', $(this).prop('checked'));
        });

        $(".sub-permission-checkbox").change(function () {
            if ($(this).prop('checked')) {
                $(this).parents('.sub-permissions').prev('.top-permission').find('.top-permission-checkbox').prop('checked', true);
            }
        });
    </script>
    <script type="text/javascript">
        $("#save-role-permissions").click(function (e) {
            e.preventDefault();
            Rbac.ajax.request({
                href: $("#role-permissions-form").attr('action'),
                data: $("#role-permissions-form").serialize(),
                successTitle: '角色权限保存成功'
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>