<?php $__env->startSection('content'); ?>
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
        <?php echo Breadcrumbs::render('admin-applyWallet-edit'); ?>

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
                        <h4 class="panel-title">编辑交易记录</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="<?php echo e(route('admin.applyWallet.update',['id'=>$applyWallet->apply_id])); ?>" method="POST">

                        <div class="panel-body panel-body-nopadding">
                            
							
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">提现状态</label>
                                <div class="col-sm-6">
									<?php $applyWalletPresenter = app('App\Presenters\applyWalletPresenter'); ?>

                                    <?php echo $applyWalletPresenter->applyWalletStatusSelect($applyWallet->status); ?>

                                </div>
                            </div>  
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="checkbox">管理员备注</label>
                                <div class="col-sm-6">
									<input type="text"  data-toggle="tooltip" name="description"
                                           data-trigger="hover" class="form-control tooltips"
                                           value="<?php echo e($applyWallet->description); ?>">    
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