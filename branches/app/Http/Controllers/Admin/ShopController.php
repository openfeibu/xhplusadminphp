<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Shop as Shop ;
use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\Repositories\ShopRepositoryEloquent;
use App\Services\AdminRecordService;

class ShopController extends BaseController
{
	protected $shopRepositoryEloquent ;
    protected $adminRecordService;
	
    public function __construct(ShopRepositoryEloquent $shopRepositoryEloquent,
                                AdminRecordService $adminRecordService){
	    
		parent::__construct();
		$this->shopRepositoryEloquent = $shopRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-shop',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('���̹���', route('admin.shop.index'));
		});
	}
	public function index()
    {
	    
		Breadcrumbs::register('admin-shop-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('�����б�', route('admin.shop.index'));
		});

		$shops = DB::table('shop')
            ->leftJoin('user', 'user.uid', '=', 'shop.uid')
            ->paginate(10);

        return view('admin.shop.index', compact('shops'));
    }
    public function create()
    {

    	 Breadcrumbs::register('admin-shop-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-shop');
            $breadcrumbs->push('��ӵ���', route('admin.shop.create'));
        });

        return view('admin.shop.create');
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-shop-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-shop');
            $breadcrumbs->push('�༭����', route('admin.shop.edit', ['id' => $id]));
        });

        $shop = $this->shopRepositoryEloquent->find($id);
       // $hasRoles = $user->roles()->lists('name')->toArray();
        $phone = Shop::find(1)->user;

        return view('admin.shop.edit', compact('shop','phone'));
    }
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->shop->update($request->all(), $id);
        if(!$result['status']) {
            Toastr::error($result['msg']);
        } else {
            Toastr::success('���̸��³ɹ�');
        }
        return redirect(route('admin.shop.edit', ['id' => $id]));
    }
}
