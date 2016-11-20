<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Breadcrumbs, Toastr;
use App\Repositories\ChickenSoupRepositoryEloquent;
use App\Services\AdminRecordService;
use App\ChickenSoup;
use App\User;
use App\UserInfo;
use App\Services\ImagesService;
use Input;
use App\AdminRecord;
use Session;

class ChickenSoupController extends Controller
{

	protected $chickenSoupRepositoryEloquent;
    protected $adminRecordService;
		
    public function __construct(ChickenSoupRepositoryEloquent $chickenSoupRepositoryEloquent,
                                AdminRecordService $adminRecordService,
                                ImagesService $imagesService)
    {
        $this->middleware('auth.admin', ['except' => ['store', 'authorLogin', 'authorPostLogin', 'sendChickenSoup','chickenSoupVerifyList','chickenSoupPreview','passVerifyList','failVerifyList','deleteVerifyList','myChickenSoupList']]);
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-paper', function ($breadcrumbs) {
            $breadcrumbs->push('文章管理', route('admin.paper.chickenSoup'));
        });

        $this->chickenSoupRepositoryEloquent = $chickenSoupRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
        $this->imagesService = $imagesService;
    }
    
    public function chickenSoup(Request $request){
        Breadcrumbs::register('admin-paper-chickenSoup',function($breadcrumbs){
            $breadcrumbs->push('鸡汤列表', route('admin.paper.chickenSoup'));
        });
        $chickenSoups = $this->chickenSoupRepositoryEloquent->getChickenSoupList($request);
        return view('admin.paper.chickenSoup',compact('chickenSoups'));
    }

    public function create(Request $request){
        if(empty($request->id)){
            $chickenSoup = "";
        }else{
            $chickenSoup = $request->session()->get('chickenSoup');
        }
        return view('admin.paper.chickenSoup_create',compact('chickenSoup'));
    }

    public function edit(Request $request){
        $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->id);
        $request->session()->put('chickenSoup',$chickenSoup);
        return $this->create($request);
    }

    public function destroy(Request $request)
    {   
        $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->id);
        $record = "删除鸡汤，鸡汤id为：".$chickenSoup->csid."，鸡汤内容为：".$chickenSoup->content;
        $this->adminRecordService->record($record);
        //$result = $this->chickenSoupRepositoryEloquent->delete($request->id);
        $result = DB::table('chicken_soup')
                    ->where('csid',$request->id)
                    ->update([
                        'deleted_at' => date('Y-m-d H:i:s'),
                ]);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    public function destroy_all(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
            $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($id);
            $record = "删除鸡汤，鸡汤id为：".$chickenSoup->csid."，鸡汤内容为：".$chickenSoup->content;
            $this->adminRecordService->record($record);
            $result = DB::table('chicken_soup')
                        ->where('csid',$id)
                        ->update([
                            'deleted_at' => date('Y-m-d H:i:s'),
                      ]);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
    
    public function pass(Request $request){
        $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->id);
        DB::table('chicken_soup')
            ->where('csid',$request->id)
            ->update([
                'status' => 1,
            ]);
        Toastr::success('审核成功');
        return redirect(route('admin.paper.chickenSoup'));
    }

    public function fail(Request $request){
        $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->id);
        DB::table('chicken_soup')
            ->where('csid',$request->id)
            ->update([
                'status' => 2,
            ]);
        Toastr::error('审核失败');
        return redirect(route('admin.paper.chickenSoup'));
    }

    public function store(Request $request){
        if(isset($request->uid)){
            $uid = $request->uid;
        }else{
            $uid = 0;
        }
        if(Input::file("background_url")){
	        $url = $this->imagesService->upload(Input::file("background_url"),$request);
        }
        else{
		    $url = Input::get("old_background_url") ? Input::get("old_background_url") : '';
        }
        if(!empty($request->id)){
            $chickenSoup = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->id);

            DB::table('chicken_soup')
                    ->where('csid',$request->id)
                    ->update([
                        'uid' => $uid,
                        'title' => $request->title,
                        'background_url' => $url,
                        'content' => stripslashes($request->editor)
                    ]);
            Toastr::success('更新成功');
        }else{
            $chickenSoup = new ChickenSoup;
            $chickenSoup->uid = $uid;
            $chickenSoup->background_url = $url;
            $chickenSoup->title = $request->title;
            $chickenSoup->status = 0;
            $chickenSoup->content = stripslashes($request->editor);
            if($chickenSoup->save()){
                Toastr::success('新增成功');
            }else{
                Toastr::error('新增失败');
            }

        }
        $id = !empty($request->id) ? $request->id : $chickenSoup->id;

        echo "<script>alert('发表成功');history.go(-1);</script>";
    }

    public function authorLogin(){
        return view('admin.paper.authorLogin');
    } 

    public function authorPostLogin(Request $request){
        $mobile_no = $request->mobile_no;
        $password = $request->password;

        $user = User::select(DB::raw("mobile_no,password,uid,nickname"))
                   ->where('mobile_no',$mobile_no)
                   ->where('password',md5($password))
                   ->first();
        
        if($user){
            $userInfo = UserInfo::select(DB::raw("is_author"))
                                ->where('uid',$user->uid)
                                ->first();
            $request->session()->put('uid', $user->uid);
            $request->session()->put('nickname', $user->nickname);
            $request->session()->put('is_author', $userInfo->is_author);

            if($userInfo->is_author == 1 || $userInfo->is_author == 2){
                return redirect(route('admin.chickenSoup.sendChickenSoup'));
            }else{
                echo "<script>alert('无权限访问');history.go(-1);</script>";
            }
            
        }else{
            echo "<script>alert('用户或者密码错误');history.go(-1);</script>";
        }
    }

    public function sendChickenSoup(){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && !empty(Session::get('is_author'))){
            return view('admin.paper.send_chickenSoup')
                        ->with('uid',Session::get('uid'))
                        ->with('nickname',Session::get('nickname'))
                        ->with('is_author',Session::get('is_author'));
        }else{
            echo "<script>history.go(-1);</script>";
        }
        
    }

    public function chickenSoupVerifyList($page){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && !empty(Session::get('is_author'))){
            $getVerifyList = $this->chickenSoupRepositoryEloquent->getVerifyList($page);
            return view('admin.paper.chickenSoupVerifyList')
                    ->with('verifyList',$getVerifyList['verifyList'])
                    ->with('nickname',Session::get('nickname'))
                    ->with('is_author',Session::get('is_author'))
                    ->with('countList',$getVerifyList['countList'] );
        }else{
            echo "<script>history.go(-1);</script>";
        }
    }

    public function chickenSoupPreview(Request $request){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && !empty(Session::get('is_author'))){
            $getChickenSoupOne = $this->chickenSoupRepositoryEloquent->getChickenSoupOne($request->csid);
            return $getChickenSoupOne;
        }else{
            echo "<script>history.go(-1);</script>";
        }      
    }

    public function passVerifyList(Request $request){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && Session::get('is_author') == 2){
            DB::table('chicken_soup')
            ->where('csid',$request->id)
            ->update([
                'status' => 3,
            ]);
            echo "<script>alert('操作成功');self.location=document.referrer;</script>";
        }else{
            echo "<script>history.go(-1);</script>";
        }  
    }

    public function failVerifyList(Request $request){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && Session::get('is_author') == 2){
            DB::table('chicken_soup')
            ->where('csid',$request->id)
            ->update([
                'status' => 2,
            ]);
            echo "<script>alert('操作成功');self.location=document.referrer;</script>";
        }else{
            echo "<script>history.go(-1);</script>";
        }  
    }

    public function deleteVerifyList(Request $request){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && Session::get('is_author') == 2){
            DB::table('chicken_soup')
            ->where('csid',$request->id)
            ->update([
                'deleted_at' => date("Y-m-d H:i:s"),
            ]);
            echo "<script>alert('操作成功');self.location=document.referrer;</script>";
        }else{
            echo "<script>history.go(-1);</script>";
        } 
    }

    public function myChickenSoupList($page){
        if(!empty(Session::get('uid')) && !empty(Session::get('nickname')) && !empty(Session::get('is_author'))){
            $myChickenSoupList = $this->chickenSoupRepositoryEloquent->getMyChickenSoupList(Session::get('uid'),$page);
            return view('admin.paper.myChickenSoupList')
                    ->with('myList',$myChickenSoupList['myList'])
                    ->with('nickname',Session::get('nickname'))
                    ->with('is_author',Session::get('is_author'))
                    ->with('countList',$myChickenSoupList['countList'] );
        }else{
            echo "<script>history.go(-1);</script>";
        }
    }

}
