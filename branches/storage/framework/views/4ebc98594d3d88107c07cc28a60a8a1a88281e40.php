<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-association-create'); ?>

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
                        <h4 class="panel-title">编辑社团</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.association.store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="aid" value="<?php echo e(isset($association['aid']) ? $association['aid'] : ''); ?>" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="aname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可重复" value="<?php echo e(isset($association['aname']) ? $association['aname'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团图片 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="avatar_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['avatar_url']) ? $association['avatar_url'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团人数 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="member_number"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['member_number']) ? $association['member_number'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团简介 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="introduction"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['introduction']) ? $association['introduction'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团管理人 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="superior"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['superior']) ? $association['superior'] : ''); ?>">
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