<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-telecomPackage-edit'); ?>

    </div>

    <div class="contentpanel panel-email">

        <div class="row">
            <div class="col-sm-9 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">编辑套餐</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.telecomPackage.update',['id'=>$package->package_id])); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">套餐名称</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="package_name"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="<?php echo e($package->package_name); ?>">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">套餐价格</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="package_price"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="<?php echo e($package->package_price); ?>">
                                </div>
                            </div>   
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">套餐详情</label>
                                <div class="col-sm-6">
                                   <input type="text"  data-toggle="tooltip" name="package_detail"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="<?php echo e($package->package_detail); ?>">
                                </div>
                            </div>
                                
							
							
						
                            <input type="hidden" name="_method" value="PUT">
                            <?php echo e(csrf_field()); ?>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                    &nbsp;
                                    <button class="btn btn-default">取消</button>
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