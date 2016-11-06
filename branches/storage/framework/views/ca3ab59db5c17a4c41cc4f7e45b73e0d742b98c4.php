<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-accusation-create'); ?>

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
                        <h4 class="panel-title">编辑举报</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.accusation.store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="id" value="<?php echo e(isset($accusation['id']) ? $accusation['id'] : ''); ?>" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">投诉备注</label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可编辑" value="<?php echo e(isset($accusation['content']) ? $accusation['content'] : ''); ?>" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">投诉审核状态<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="state" id="state">
                                        <option value="审核中">审核中</option>
                                        <option value="审核通过">审核通过</option>
                                        <option value="审核失败">审核失败</option>
                                    </select>
                                </div>
                            </div>

                            <?php echo e(csrf_field()); ?>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    <a class="btn btn-primary" href="<?php echo e(route('admin.accusation.index')); ?>" >取消</a>
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