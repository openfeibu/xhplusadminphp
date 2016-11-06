<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-association_activity-create'); ?>

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
                        <h4 class="panel-title">增加社团活动</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.association_activity.store')); ?>" method="POST"  enctype="multipart/form-data">

                        <div class="panel-body panel-body-nopadding">
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
                                           data-original-title="" value="<?php echo e(isset($association_activity['uid']) ? $association_activity['uid'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动标题 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="title"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_activity['title']) ? $association_activity['title'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_activity['content']) ? $association_activity['content'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动开始时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="start_time"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(date('Y-m-d H:i:s')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动结束时间 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="end_time"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(date('Y-m-d H:i:s')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动地点 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="place"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_activity['place']) ? $association_activity['place'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">活动图片 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="activity_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association_activity['img_url']) ? $association_activity['img_url'] : ''); ?>">
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