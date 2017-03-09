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
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->shop->update($request->all(), $id);
        if(!$result['status']) {
            Toastr::error($result['msg']);
        } else {
            Toastr::success('店铺更新成功');
        }
        return redirect(route('admin.shop.edit', ['id' => $id]));
    }
    public function store (Request $request)
    {
	    $url = $this->imagesService->upload(Input::file("shop_img"),$request);
    	$shop = $this->shopRepositoryEloquent->create($request->all());
        if(!$result) {
            Toastr::error('创建失败');
        } else {
            Toastr::success('店铺创建成功');
        }
        return redirect(route('admin.shop.edit', ['id' => $id]));
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
		    	Goods::create([
					'shop_id' => Input::get('shop_id'),
					'cat_id' => Input::get('cat_id'),
					'goods_name' => $goods['1'],
					'goods_price' => $goods['2'],
					'goods_img' => 'http://xhplus.feibu.info/uploads/goods/'.Input::get('shop_id').'/'.$goods['3'],
					'goods_thumb' => 'http://xhplus.feibu.info/uploads/goods/'.Input::get('shop_id').'/thumb/'.$goods['3'],
					'goods_desc' => $goods['4'] ? $goods['4'] : '',
					'goods_number' => $goods['5'],
		    	]);
		    }
	    });  
	    
	    return redirect(route('admin.shop.goods_batch', ['shop_id' => Input::get('shop_id')]));
    }
}
