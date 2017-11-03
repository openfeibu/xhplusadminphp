<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use Redirect;
use App\Http\Requests;
use App\Services\HelpService;
use App\Http\Controllers\Controller;
use App\Repositories\SettingRepositoryEloquent;
use App\Repositories\ShippingAdjustRepositoryEloquent;
use App\Repositories\ShippingConfigRepositoryEloquent;
use App\Repositories\CanteenShippingConfigRepositoryEloquent;

class SettingController extends BaseController
{
	protected $helpService;

	public function __construct(HelpService $helpService,
                                SettingRepositoryEloquent $settingRepositoryEloquent,
                                ShippingAdjustRepositoryEloquent $shippingAdjustRepositoryEloquent,
                                ShippingConfigRepositoryEloquent $shippingConfigRepositoryEloquent,
                                CanteenShippingConfigRepositoryEloquent $canteenShippingConfigRepositoryEloquent)
	{
		parent::__construct();
		$this->helpService = $helpService;
        $this->settingRepositoryEloquent = $settingRepositoryEloquent;
        $this->shippingConfigRepositoryEloquent = $shippingConfigRepositoryEloquent;
        $this->shippingAdjustRepositoryEloquent = $shippingAdjustRepositoryEloquent;
        $this->canteenShippingConfigRepositoryEloquent = $canteenShippingConfigRepositoryEloquent;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-setting',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('设置', route('admin.setting.settings'));
		});
	}
    public function settings()
    {
        Breadcrumbs::register('admin-setting-settings',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('设置', route('admin.setting.settings'));
		});
		$settings = $this->settingRepositoryEloquent->orderBy('id','asc')->all();
        return view('admin.setting.settings', compact('settings'));
    }
    public function setting($id)
    {
        Breadcrumbs::register('admin-setting-setting',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('设置', route('admin.setting.setting'));
		});
        $setting = $this->settingRepositoryEloquent->find($id);
        return view('admin.setting.setting', compact('setting'));
    }
    public function settingUpdate(Request $request)
    {
        $result = $this->settingRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.setting.settings'));
    }
    public function canteenShippingConfigs(Request $request)
    {
        Breadcrumbs::register('admin-setting-canteenShippingConfigs',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('饭堂配送费设置', route('admin.setting.canteenShippingConfigs'));
		});
		$settings = $this->canteenShippingConfigRepositoryEloquent->orderBy('cid','asc')->all();
        return view('admin.setting.canteen_shipping_configs', compact('settings'));
    }
    public function canteenShippingConfig($id)
    {
        Breadcrumbs::register('admin-setting-canteenShippingConfig',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('饭堂配送费设置', route('admin.setting.canteenShippingConfig'));
		});
        $setting = $this->canteenShippingConfigRepositoryEloquent->find($id);
        return view('admin.setting.canteen_shipping_config', compact('setting'));
    }
    public function canteenShippingConfigUpdate(Request $request)
    {
        $result = $this->canteenShippingConfigRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.setting.canteenShippingConfigs'));
    }

    public function shippingConfigs(Request $request)
    {
        Breadcrumbs::register('admin-setting-shippingConfigs',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('饭堂配送费设置', route('admin.setting.shippingConfigs'));
		});
		$settings = $this->shippingConfigRepositoryEloquent->orderBy('cid','asc')->all();
        return view('admin.setting.shipping_configs', compact('settings'));
    }
    public function shippingConfig($id)
    {
        Breadcrumbs::register('admin-setting-shippingConfig',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('饭堂配送费设置', route('admin.setting.shippingConfig'));
		});
        $setting = $this->shippingConfigRepositoryEloquent->find($id);
        return view('admin.setting.shipping_config', compact('setting'));
    }
    public function shippingConfigUpdate(Request $request)
    {
        $result = $this->shippingConfigRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.setting.shippingConfigs'));
    }

    public function shippingAdjusts(Request $request)
    {
        Breadcrumbs::register('admin-setting-shippingAdjusts',function($breadcrumbs){
            $breadcrumbs->parent('admin-setting');
            $breadcrumbs->push('调价设置', route('admin.setting.shippingAdjusts'));
        });
        $settings = $this->shippingAdjustRepositoryEloquent->orderBy('id','asc')->all();
        return view('admin.setting.shipping_adjusts', compact('settings'));
    }
    public function shippingAdjust($id)
    {
        Breadcrumbs::register('admin-setting-shippingAdjust',function($breadcrumbs){
			$breadcrumbs->parent('admin-setting');
			$breadcrumbs->push('调价设置', route('admin.setting.shippingAdjust'));
		});
        $setting = $this->shippingAdjustRepositoryEloquent->find($id);
        return view('admin.setting.shipping_adjust', compact('setting'));
    }
    public function shippingAdjustUpdate(Request $request)
    {
        $result = $this->shippingAdjustRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.setting.shippingAdjusts'));
    }
}
