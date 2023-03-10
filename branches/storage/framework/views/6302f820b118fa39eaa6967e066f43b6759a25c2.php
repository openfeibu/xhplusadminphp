<?php $appPresenter = app('App\Presenters\AppPresenter'); ?>

<div class="col-sm-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="<?php echo e($appPresenter->activeMenuByRoute('admin_user')); ?>">
            <a href="<?php echo e(route('admin.admin_user.index')); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-user"></i> 用户管理
            </a>
        </li>
        <li class="<?php echo e($appPresenter->activeMenuByRoute('role')); ?>">
            <a href="<?php echo e(route('admin.role.index')); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 角色管理
            </a>
        </li>
        <li class="<?php echo e($appPresenter->activeMenuByRoute('permission')); ?>">
            <a href="<?php echo e(route('admin.permission.index')); ?>">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 权限管理
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->