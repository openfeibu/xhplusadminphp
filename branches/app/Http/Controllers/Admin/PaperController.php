<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Breadcrumbs, Toastr;
use App\Repositories\PaperRepositoryEloquent;
use App\Services\AdminRecordService;

class PaperController extends BaseController
{

	protected $paperRepositoryEloquent;
    protected $adminRecordService;
		
    public function __construct(PaperRepositoryEloquent $paperRepositoryEloquent,
                                AdminRecordService $adminRecordService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-paper', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('文章管理', route('admin.paper.faq'));
        });

        $this->paperRepositoryEloquent = $paperRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
    }
    
	public function faq(Request $request)
    {
		$id = "1";
        $route = "admin.paper.faq";
		$paper = $this->paperRepositoryEloquent->getPaperOne($id);
        return view('admin.paper.faq',compact('paper','route'));
    }

    public function faq_store(Request $request)
    {
        $paper = $this->paperRepositoryEloquent->find($request->id);
        $record = "文章管理，修改文章,文章名称为：".$paper->type;
        $this->adminRecordService->record($record);
    	DB::table('papers')
				->where('id',$request->id)
				->update([
                    'type' => $request->type,
                    'url' => $request->url,
					'papers' => stripslashes($request->editor)
				]);
        header("Location:".route($request->route));
    }

    public function school_mission(Request $request)
    {
		$id = "2";
        $route = "admin.paper.school_mission";
		$paper = $this->paperRepositoryEloquent->getPaperOne($id);
        return view('admin.paper.faq',compact('paper','route'));
    }

    public function xh(Request $request)
    {
        $id = "3";
        $route = "admin.paper.xh";
        $paper = $this->paperRepositoryEloquent->getPaperOne($id);
        return view('admin.paper.faq',compact('paper','route'));
    }

    public function integral(Request $request)
    {
        $id = "4";
        $route = "admin.paper.integral";
        $paper = $this->paperRepositoryEloquent->getPaperOne($id);
        return view('admin.paper.faq',compact('paper','route'));
    }

    public function wallet(Request $request)
    {
        $id = "5";
        $route = "admin.paper.wallet";
        $paper = $this->paperRepositoryEloquent->getPaperOne($id);
        return view('admin.paper.faq',compact('paper','route'));
    }	

    public function chickenSoup(Request $request){
        return view('admin.paper.chickenSoup');
    }

}
