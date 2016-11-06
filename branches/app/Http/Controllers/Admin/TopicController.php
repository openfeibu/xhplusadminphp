<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Topic;
use DB;
use App\Http\Requests\Admin\AdminUser\CreateRequest;
use App\Http\Requests\Admin\AdminUser\UpdateRequest;
use Breadcrumbs, Toastr;
use App\Repositories\TopicRepositoryEloquent;
use App\Repositories\TopicCommentRepositoryEloquent;
use App\Services\AdminRecordService;

class TopicController extends BaseController
{
		
	protected $topicRepositoryEloquent;

	protected $topicCommentRepositoryEloquent;

	protected $adminRecordService;

    public function __construct(TopicRepositoryEloquent $topicRepositoryEloquent
    							,TopicCommentRepositoryEloquent $topicCommentRepositoryEloquent,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-topic', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('话题管理', route('admin.topic.index'));
        });
		
		$this->topicRepositoryEloquent = $topicRepositoryEloquent;

		$this->topicCommentRepositoryEloquent = $topicCommentRepositoryEloquent;

		$this->adminRecordService = $adminRecordService;
    }
    
	public function index(Request $request)
    {
    	Breadcrumbs::register('admin-topic-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('话题管理', route('admin.topic.index'));
		});
		$topics = $this->topicRepositoryEloquent->getTopicList();
        return view('admin.topic.index',compact('topics'));
    }
	
	public function create(Request $request){
        Breadcrumbs::register('admin-topic-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-topic');
            $breadcrumbs->push('编辑话题', route('admin.topic.create'));
        });
        $topics = $request->session()->get('topic');
        return view('admin.topic.create',compact('topics'));
	}

	public function edit(Request $request){
        $topic = $this->topicRepositoryEloquent->getTopicOne($request->id);
        $request->session()->put('topic',$topic);
		return $this->create($request);
	}

	public function destroy(Request $request)
	{
		$topic = $this->topicRepositoryEloquent->find($request->id);
        $record = "话题管理，话题删除,话题内容为：".$topic->content."发话题的用户id为：".$topic->uid;
        $this->adminRecordService->record($record);
		$result = $this->topicRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$topic = $this->topicRepositoryEloquent->find($id);
	        $record = "话题管理，话题删除,话题内容为：".$topic->content."发话题的用户id为：".$topic->uid;
	        $this->adminRecordService->record($record);
            $result = $this->topicRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		DB::table('topic')
				->where('tid',$request->tid)
				->update([
					'uid' => $request->uid,
					'type' => $request->type,
					'content' => $request->content,
					'view_num' => $request->view_num,
					'comment_num' => $request->comment_num,
					'favourites_count' => $request->favourites_count,
					'is_top' => $request->is_top
				]);
		$topic = $this->topicRepositoryEloquent->find($request->tid);
        $record = "话题管理，话题更新,话题内容：".$topic->content;
        $this->adminRecordService->record($record);
		header("Location:/admin/topic");
	}

	public function comment(){
		Breadcrumbs::register('admin-topic-comment',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('评论管理', route('admin.topic.comment'));
		});
		$comments = $this->topicCommentRepositoryEloquent->getCommentList();
        return view('admin.topic.comment',compact('comments'));
	}

	public function comment_create($request){
        Breadcrumbs::register('admin-topic-comment_create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-topic');
            $breadcrumbs->push('修改评论', route('admin.topic.comment_create'));
        });
        $comments = $request->session()->get('comments');
        return view('admin.topic.comment_create',compact('comments'));
	}


	public function comment_edit(Request $request){
        $comments = $this->topicCommentRepositoryEloquent->getCommentOne($request->id);
        $request->session()->put('comments',$comments);
		return $this->comment_create($request);
	}

	public function comment_destroy($id){
		$topicComment = $this->topicCommentRepositoryEloquent->find($id);
        $record = "话题评论管理，话题评论删除,评论内容为：".$topicComment->content."评论的用户id为：".$topicComment->uid;
        $this->adminRecordService->record($record);
		$result = $this->topicCommentRepositoryEloquent->delete($id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function comment_destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$topicComment = $this->topicCommentRepositoryEloquent->find($id);
	        $record = "话题评论管理，话题评论删除,评论内容为：".$topicComment->content."，评论的用户id为：".$topicComment->uid;
	        $this->adminRecordService->record($record);
            $result = $this->topicCommentRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function comment_store(Request $request){
		DB::table('topic_comment')
				->where('tcid',$request->tcid)
				->update([
					'content' => $request->comment_content,
					'favourites_count' => $request->favourites_count,
				]);
		$topicComment = $this->topicCommentRepositoryEloquent->find($request->tcid);
        $record = "话题评论管理，话题评论更新,评论内容：".$topicComment->content;
        $this->adminRecordService->record($record);
		header("Location:/admin/topic/comment");
	}
}
