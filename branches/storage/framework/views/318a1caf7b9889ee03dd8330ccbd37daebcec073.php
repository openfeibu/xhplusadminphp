<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-topic-create'); ?>

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
                        <h4 class="panel-title">添加话题</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.topic.store')); ?>" method="POST">
                        <input type="hidden" name="tid" value="<?php echo e($topics['tid']); ?>">
                        <div class="panel-body panel-body-nopadding">
							<input type="text"  name="uid" value="<?php echo e($topics['uid']); ?>" style="display:none" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="nickname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可编辑" value="<?php echo e($topics['nickname']); ?>" readOnly="true" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">话题类型 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="type"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可编辑" value="<?php echo e($topics['type']); ?>" readOnly="true" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">话题内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="content"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="不可编辑" value="<?php echo e($topics['content']); ?>" readOnly="true" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">阅读数量 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="view_num"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e($topics['view_num']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">评论数量 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="comment_num"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e($topics['comment_num']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">点赞数量 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="favourites_count"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e($topics['favourites_count']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否置顶<span class="asterisk"></span></label>

                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="is_top" >
                                        <option value="0">不置顶</option>
										<option value="1">置顶</option>
                                    </select>
                                </div>
                            </div>

                            <?php echo e(csrf_field()); ?>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    <a class="btn btn-primary" href="<?php echo e(route('admin.topic.index')); ?>" >取消</a>
                                </div>
                            </div>
                        </div>
                        <!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>