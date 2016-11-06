<?php $appPresenter = app('App\Presenters\AppPresenter'); ?>

<div class="col-sm-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="<?php echo e($appPresenter->activeMenuByRoute('admin_user')); ?>">
            <a href="<?php echo e(route('admin.paper.chickenSoup')); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 全部鸡汤列表
            </a>
        </li>
        <li class="<?php echo e($appPresenter->activeMenuByRoute('permission')); ?>">
            <a href="<?php echo e(route('admin.paper.chickenSoup',['act' => 1] )); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 已审核
            </a>
        </li>
		<li class="<?php echo e($appPresenter->activeMenuByRoute('permission')); ?>">
            <a href="<?php echo e(route('admin.paper.chickenSoup',['act' => 2])); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 未审核
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->