<?php $appPresenter = app('App\Presenters\AppPresenter'); ?>

<div class="col-sm-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="<?php echo e($appPresenter->activeMenuByRoute('admin_user')); ?>">
            <a href="<?php echo e(route('admin.user.real',['act' => 'all'] )); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 全部实名列表
            </a>
        </li>
        <li class="<?php echo e($appPresenter->activeMenuByRoute('permission')); ?>">
            <a href="<?php echo e(route('admin.user.real',['act' => 'pass'] )); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 已通过审核
            </a>
        </li>
		<li class="<?php echo e($appPresenter->activeMenuByRoute('permission')); ?>">
            <a href="<?php echo e(route('admin.user.real',['act' => 'fail'])); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 未通过审核
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->