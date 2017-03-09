@inject('appPresenter','App\Presenters\AppPresenter')

<div class="col-sm-2 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="{{ $appPresenter->activeMenuByRoute('admin_user') }}">
            <a href="{{ route('admin.paper.faq')}}">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 常见问题文案
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.paper.school_mission')}}">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 校园任务协议
            </a>
        </li>
		<li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.paper.xh') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 校汇服务协议
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.paper.shop') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 小店铺协议
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.paper.integral') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 积分说明
            </a>
        </li>
        <li class="{{ $appPresenter->activeMenuByRoute('permission') }}">
            <a href="{{ route('admin.paper.wallet') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 钱包说明
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->