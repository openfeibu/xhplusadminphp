<?php

namespace App\Http\Controllers\Admin;

use DB;
use Excel;
use Input;
use App\Shop as Shop;
use App\Goods as Goods;
use App\GoodsCategory as GoodsCategory;
use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\Repositories\ShopRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\AdminRecordService;
use App\Services\ImageService;

class ShopController extends BaseController
{
	protected $shopRepositoryEloquent ;
    protected $adminRecordService;

    public function __construct(UserRepositoryEloquent $userRepositoryEloquent,
								ShopRepositoryEloquent $shopRepositoryEloquent,
                                AdminRecordService $adminRecordService,
								ImageService $imageService){

		parent::__construct();
		$this->shopRepositoryEloquent = $shopRepositoryEloquent;
		$this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
		$this->imageService = $imageService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-shop',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺管理', route('admin.shop.index'));
		});
	}
	public function index()
    {

		Breadcrumbs::register('admin-shop-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});

		$shops = DB::table('shop')
            ->leftJoin('user', 'user.uid', '=', 'shop.uid')
            ->orderBy('shop.shop_id','desc')
            ->paginate(10);

        return view('admin.shop.index', compact('shops'));
    }
    public function create()
    {

    	 Breadcrumbs::register('admin-shop-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-shop');
            $breadcrumbs->push('添加店铺', route('admin.shop.create'));
        });

        return view('admin.shop.create');
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-shop-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-shop');
            $breadcrumbs->push('编辑店铺', route('admin.shop.edit', ['id' => $id]));
        });

        $shop = $this->shopRepositoryEloquent->find($id);
       // $hasRoles = $user->roles()->lists('name')->toArray();
        $phone = Shop::find($shop->shop_id)->user;

        return view('admin.shop.edit', compact('shop','phone'));
    }
    public function update(Request $request)
    {
		if(Input::file('uploadfile')){
			$shop_img = $this->imageService->uploadImages(Input::all(), 'shop');
			if(!$shop_img){
				return redirect(route('admin.shop.edit', ['id' => $request->shop_id]));
			}
			$shop_img = $shop_img['thumb_img_url'];
		}else{
			$shop_img = $request->shop_img;
		}
		$result = Shop::where('shop_id',$request->shop_id)->update([
														'address' => $request->address,
														'description' => $request->description,
														'open_time' => $request->open_time,
														'close_time' => $request->close_time,
														'shop_img' => $shop_img,
														'shop_status' => $request->shop_status
													]);
													/*
        $result = $this->shopRepositoryEloquent->update([
														'address' => $request->address,
														'description' => $request->description,
														'open_time' => $request->open_time,
														'close_time' => $request->close_time,
														'shop_img' => $shop_img,
														'shop_status' => $request->shop_status
													], $request->shop_id);*/
		// if(!$result['status']) {
        //     Toastr::error($result['msg']);
        // } else {
        //     Toastr::success('店铺更新成功');
        // }
        return redirect(route('admin.shop.edit', ['id' => $request->shop_id]));
    }
    public function store (Request $request)
    {
		$mobile = $request->mobile;
		$user = $this->userRepositoryEloquent->getUser(['mobile_no' => $mobile],['uid']);
		if(!$user) {
            Toastr::error('用户不存在');
			return redirect(route('admin.shop.create'));
        }
	    $shop_img = $this->imageService->uploadImages(Input::all(), 'shop');
		if(!$shop_img){
			return redirect(route('admin.shop.create'));
		}
    	$shop = $this->shopRepositoryEloquent->create([
			'uid' => $user->uid,
			'shop_name' => $request->shop_name,
			'address' => $request->address,
			'description' => $request->description,
			'open_time' => $request->open_time,
			'close_time' => $request->close_time,
			'shop_type' => $request->shop_type,
			'shop_img' => $shop_img['thumb_img_url'],
			'shop_status' => 1,
		]);
        if(!$shop) {
            Toastr::error('创建失败');
			return redirect(route('admin.shop.create'));
        } else {
            Toastr::success('店铺创建成功');
        }
        return redirect(route('admin.shop.edit', ['id' => $shop->shop_id]));
    }
    public function goodsBatch (Request $request)
    {
    	Breadcrumbs::register('admin-shop-goodsBatch',function($breadcrumbs){
			$breadcrumbs->parent('admin-shop');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});
		$shops = Shop::orderBy('shop.shop_id','desc')->get();
		$cats = [];
		$shop_id = isset($request->shop_id) ? $request->shop_id : 0;
		if($shop_id){
			$shop = Shop::find($shop_id);
			$cats = GoodsCategory::where('shop_id',$shop_id)->get();
		}
		return view('admin.shop.goods_batch')->with('shops',$shops)->with('shop_id',$shop_id)->with('cats',$cats);
    }
    public function goodsBatchUpload (Request $request)
    {
	    $file = Input::file('excel');
    	Excel::load($file, function($reader) use( &$res ) {
	        $reader = $reader->getSheet(0);
	        $goodses = $reader->toArray();
	        unset($goodses[0]);
	        foreach( $goodses as $key => $goods )
		    {
				$goods_img = config('app.img_url').'/goods/'.Input::get('shop_id').'/'.$goods['3'].'.jpg';
				if($goods['1']){
					$data = [
						'shop_id' => Input::get('shop_id'),
						'cat_id' => Input::get('cat_id'),
						'goods_name' => $goods['1'],
						'goods_price' => $goods['2'],
						'goods_img' => $goods_img,
						'goods_thumb' => $goods_img.'?imageMogr2/thumbnail/400x',
						'goods_desc' => $goods['4'] ? $goods['4'] : '',
						'goods_number' => $goods['5'] ? $goods['5'] : 99999999,
					];
					Goods::create($data);
				}
		    }
	    });
		Toastr::success('操作成功');
	    return redirect(route('admin.shop.goods_batch', ['shop_id' => Input::get('shop_id')]));
    }

}
