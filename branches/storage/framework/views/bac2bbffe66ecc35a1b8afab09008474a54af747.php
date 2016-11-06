<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-user-real_create'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">

		<?php echo $__env->make('admin._partials.real-left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-sm-9 col-lg-10">
			
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">添加实名用户</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.user.real_store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
									<input type="text"  data-toggle="tooltip" name="uid"
										    value="<?php echo e($form_data['uid']); ?>" style="display:none">
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户名 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="username"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="<?php echo e($form_data['username']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">身份证正面 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="pic1"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="例子：./upload/" value="<?php echo e($form_data['pros_img']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">身份证反面 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="pic2"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="例子：./upload/" value="<?php echo e($form_data['cons_img']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">审核状态<span class="asterisk"></span></label>

                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="real_state" id="real_state">
                                        <option value="0">已审核</option>
										<option value="1">审核失败</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">备注 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="reason"
                                           data-trigger="hover" class="form-control tooltips"
                                           placeholder="如果审核不通过请备注原因" data-original-title="该原因会呈现给用户">
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