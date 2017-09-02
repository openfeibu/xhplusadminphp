<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Input;
use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Repositories\RecommendRepositoryEloquent;

class RecommendController extends BaseController
{
    public function __construct(RecommendRepositoryEloquent $recommendRepositoryEloquent,
                                ImageService $imageService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-recommend', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('推荐管理', route('admin.recommend.index'));
        });
        $this->imageService = $imageService;
        $this->recommendRepositoryEloquent = $recommendRepositoryEloquent;
    }
    public function index()
    {
        Breadcrumbs::register('admin-recommend-index',function($breadcrumbs){
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('推荐列表', route('admin.recommend.index'));
        });
        $recommends = $this->recommendRepositoryEloquent->orderBy('type','asc')->orderBy('sort','asc')->orderBy('id','asc')->paginate(config('admin_config.page'), $columns = ['*']);

        return view('admin.recommend.index', compact('recommends'));
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-recommend-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-recommend');
            $breadcrumbs->push('编辑驾校', route('admin.recommend.edit', ['id' => $id]));
        });

        $recommend = $this->recommendRepositoryEloquent->find($id);

        return view('admin.recommend.edit', compact('recommend'));
    }
    public function update(Request $request)
    {
        if(Input::file('uploadfile')){
			$img = $this->imageService->uploadImages(Input::all(), 'system');
			if(!$img){
				return redirect(route('admin.shop.edit', ['id' => $request->shop_id]));
			}
			$img = $img['image_url'];
		}else{
			$img = $request->img;
		}

        $result = $this->recommendRepositoryEloquent->update([
														'name' => $request->name,
														'url' => $request->url,
														'img' => $img,
													], $request->id);
		if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.recommend.edit', ['id' => $request->id]));
    }
}
