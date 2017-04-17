<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Repositories\LossRepositoryEloquent;
use App\Repositories\LossCategoryRepositoryEloquent;

class LossCategoryController extends BaseController
{
    protected $lossRepositoryEloquent;
    protected $lossCategoryRepositoryEloquent;

    public function __construct(LossRepositoryEloquent $lossRepositoryEloquent,
                                LossCategoryRepositoryEloquent $lossCategoryRepositoryEloquent)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-loss_cate', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('失物招领分类', route('admin.loss_cate.index'));
        });

        $this->lossRepositoryEloquent = $lossRepositoryEloquent;
        $this->lossCategoryRepositoryEloquent = $lossCategoryRepositoryEloquent;
    }
    public function index(Request $request)
    {
        Breadcrumbs::register('admin-loss_cate-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('失物招领分类列表', route('admin.loss_cate.index'));
		});

        $cates = $this->lossCategoryRepositoryEloquent->orderBy('sort','asc')->orderBy('cat_id','asc')->paginate(config('admin_config.page'), $columns = ['*']);
        return view('admin.loss.cates', compact('cates'));
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-loss_cate-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-loss_cate');
            $breadcrumbs->push('编辑分类', route('admin.loss_cate.edit', ['id' => $id]));
        });

        $cate = $this->lossCategoryRepositoryEloquent->find($id);

        return view('admin.loss.cate', compact('cate'));
    }
    public function update(Request $request)
    {
        $result = $this->lossCategoryRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.loss_cate.edit', ['id' => $request->id]));
    }
    public function create()
    {

    	 Breadcrumbs::register('admin-loss_cate-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-loss_cate');
            $breadcrumbs->push('添加分类', route('admin.loss_cate.create'));
        });

        return view('admin.loss.create_cate');
    }
    public function store (Request $request)
    {
    	$cate = $this->lossCategoryRepositoryEloquent->create($request->all());
        if(!$cate) {
            Toastr::error('创建失败');
        } else {
            Toastr::success('创建成功');
        }
        return redirect(route('admin.loss_cate.edit', ['id' => $cate->cat_id]));
    }
    public function destroy(Request $request)
	{
		$result = $this->lossCategoryRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
            $result = $this->lossCategoryRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
}
