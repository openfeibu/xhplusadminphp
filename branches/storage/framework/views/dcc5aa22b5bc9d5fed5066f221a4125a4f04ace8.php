<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-integral_history-create'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-12 col-lg-12">
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑用户积分历史</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.integral_history.store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="id" style="display:none" value="<?php echo e(isset($integral_history['id']) ? $integral_history['id'] : ''); ?>" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户id<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="uid"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($integral_history['uid']) ? $integral_history['uid'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">积分类型<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="integral_id" >
                                    <?php foreach($integrals as $integral): ?>
                                        <option value="<?php echo e($integral->id); ?>"><?php echo e($integral->obtain_type); ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <?php echo e(csrf_field()); ?>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                     <a class="btn btn-primary" href="<?php echo e(route('admin.integral_history.index')); ?>" >取消</a>
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