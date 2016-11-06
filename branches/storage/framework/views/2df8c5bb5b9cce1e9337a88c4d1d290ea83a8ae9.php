<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-role-create'); ?>

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
                        <h4 class="panel-title">添加角色</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.role.store')); ?>" method="POST">

                    <div class="panel-body panel-body-nopadding">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">角色标识 <span class="asterisk">*</span></label>

                            <div class="col-sm-6">
                                <input type="text" data-toggle="tooltip" name="name"
                                       data-trigger="hover" class="form-control tooltips"
                                       data-original-title="不可重复" value="<?php echo e(old('name')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">显示名称</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="display_name"
                                       value="<?php echo e(old('display_name')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">说明</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="description"
                                       value="<?php echo e(old('description')); ?>">
                            </div>
                        </div>

                        <?php echo e(csrf_field()); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>