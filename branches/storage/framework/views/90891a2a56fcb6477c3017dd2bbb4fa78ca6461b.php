<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-permission-create'); ?>

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
                        <h4 class="panel-title">添加权限</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.permission.store')); ?>" method="POST">

                    <div class="panel-body panel-body-nopadding">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属权限组</label>

                            <div class="col-sm-6">
                                <?php $permissionPresenter = app('App\Presenters\PermissionPresenter'); ?>

                                <?php echo $permissionPresenter->topPermissionSelect(); ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">权限路由 <span class="asterisk">*</span></label>

                            <div class="col-sm-6">
                                <input type="text"  data-toggle="tooltip" name="name"
                                       data-trigger="hover" class="form-control tooltips"
                                       data-original-title="不可重复,不可点击路由输入`#`" value="<?php echo e(old('name')); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">显示名称</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="display_name" value="<?php echo e(old('display_name')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">说明</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="description" value="<?php echo e(old('description')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">图标<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><i class="fa fa-info-circle"></i></a></label>

                            <div class="col-sm-6">
                                <input type="text"  data-toggle="tooltip" name="icon"
                                       data-trigger="hover" class="form-control tooltips"
                                       data-original-title="图标名称,去fa-前缀" value="<?php echo e(old('icon')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否菜单</label>

                            <div class="col-sm-1">
                                <select class="form-control input-sm" name="is_menu">
                                    <option value="1" <?php echo e(old('is_menu') ? 'selected':''); ?>>是</option>
                                    <option value="0" <?php echo e(old('is_menu') ? '':'selected'); ?>>否</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>

                            <div class="col-sm-1">
                                <input type="text" class="form-control" name="sort"
                                       value="<?php echo e(old('sort')); ?>">
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