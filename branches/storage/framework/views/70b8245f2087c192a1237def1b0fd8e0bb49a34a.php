<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-user-create'); ?>

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
                        <h4 class="panel-title">编辑用户</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.user.store')); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
							<div class="form-group">
									<input type="text"  data-toggle="tooltip" name="uid"
										   data-trigger="hover" class="form-control tooltips"
										   data-original-title="不可编辑" value="<?php echo e(isset($user['uid']) ? $user['uid'] : ''); ?>" style="display:none">
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="nickname"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="" value="<?php echo e(isset($user['nickname']) ? $user['nickname'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机号码<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="mobile_no"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['mobile_no']) ? $user['mobile_no'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">密码<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="password"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['password']) ? $user['password'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">头像<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="avatar_url"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['avatar_url']) ? $user['avatar_url'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">创建用户IP<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="created_ip"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['created_ip']) ? $user['created_ip'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">最后登录IP<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="last_ip"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['last_ip']) ? $user['last_ip'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否封号<span class="asterisk"></span></label>
                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="ban_flag" >
                                        <option value="0">正常</option>
										<option value="1">封号</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">总积分<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="integral"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['integral']) ? $user['integral'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">今日积分<span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="today_integral"
                                           data-trigger="hover" class="form-control tooltips" value="<?php echo e(isset($user['today_integral']) ? $user['today_integral'] : ''); ?>">
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