@inject('appPresenter','App\Presenters\AppPresenter')

<div class="col-sm-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="{{ $appPresenter->activeMenuByRoute('admin_user') }}">
            <a href="{{ route('admin.accusation.index',['act' => ''] )}}">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 全部审核列表
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.accusation.index',['act' => 'review']) }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 审核中
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.accusation.index',['act' => 'pass'] )}}">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 已通过审核
            </a>
        </li>
		<li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.accusation.index',['act' => 'fail']) }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i>审核失败
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->