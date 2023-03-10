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

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.association.store')); ?>" method="POST"  enctype="multipart/form-data" >

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
                                <label class="col-sm-3 control-label">社长名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="leader"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['leader']) ? $association['leader'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社长手机号码 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="leader_mobile"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="手机号码为社长注册账号填写的号码" placeholder="手机号码为社长注册账号填写的号码" value="<?php echo e(isset($association['leader_mobile']) ? $association['leader_mobile'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团头像 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="avatar_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['avatar_url']) ? $association['avatar_url'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团背景图片 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="background_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($association['background_url']) ? $association['background_url'] : ''); ?>">
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
                                <label class="col-sm-3 control-label">社团标签<span class="asterisk"></span></label>

                                <div class="col-sm-6">
                                    <select class="form-control input-sm" name="label" id="label">
                                        <option value="">请选择</option>
                                        <option value="体育竞技">体育竞技</option>
                                        <option value="文化艺术">文化艺术</option>
                                        <option value="爱心公益">爱心公益</option>
                                        <option value="社会实践">社会实践</option>
                                        <option value="学术科研">学术科研</option>
                                        <option value="兴趣爱好">兴趣爱好</option>
                                        <option value="舞蹈">舞蹈</option>
                                        <option value="其他">其他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">社团上级部门</label>

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