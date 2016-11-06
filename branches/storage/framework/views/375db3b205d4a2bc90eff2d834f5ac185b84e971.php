<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-association_info-create'); ?>

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
                        <h4 class="panel-title">加入社团资讯</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.association_info.store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<input type="text" name="iid" value="<?php echo e(isset($association_info['iid']) ? $association_info['iid'] : ''); ?>" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="aid" id="aid">
                                        <?php foreach($associations as $association): ?>
                                            <option value="<?php echo e($association->aid); ?>"><?php echo e($association->aname); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发资讯者用户uid<span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="uid"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_info['uid']) ? $association_info['uid'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">资讯标题 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="title"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_info['title']) ? $association_info['title'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">资讯内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_info['content']) ? $association_info['content'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">资讯图片 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="img_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_info['img_url']) ? $association_info['img_url'] : ''); ?>">
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