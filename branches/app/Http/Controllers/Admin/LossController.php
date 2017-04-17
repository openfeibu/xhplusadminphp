<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Repositories\LossRepositoryEloquent;
use App\Repositories\LossCategoryRepositoryEloquent;

class LossController extends BaseController
{
    protected $lossRepositoryEloquent;
    protected $lossCategoryRepositoryEloquent;

    public function __construct(LossRepositoryEloquent $lossRepositoryEloquent,
                                LossCategoryRepositoryEloquent $lossCategoryRepositoryEloquent)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-loss', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('失物招领', route('admin.loss_cate.index'));
        });

        $this->lossRepositoryEloquent = $lossRepositoryEloquent;
        $this->lossCategoryRepositoryEloquent = $lossCategoryRepositoryEloquent;
    }
    public function index(Request $request)
    {
        Breadcrumbs::register('admin-loss-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('失物招领列表', route('admin.loss.index'));
		});

        $losses = $this->lossRepositoryEloquent->getLosses();
        return view('admin.loss.index', compact('losses'));
    }

    public function destroy(Request $request)
	{
		$result = $this->lossRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
            $result = $this->lossRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
}
