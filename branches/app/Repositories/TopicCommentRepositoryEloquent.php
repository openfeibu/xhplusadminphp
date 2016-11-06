<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TopicRepository;
use App\Topic;
use App\TopicComment;
use App\TopicType;
use DB;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TopicCommentRepositoryEloquent extends BaseRepository implements TopicCommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TopicComment::class;
    }
	

	public function getCommentList(){
		$comments = TopicComment::leftJoin('user', 'user.uid', '=', 'topic_comment.uid')
						->leftJoin('topic', 'topic.tid', '=', 'topic_comment.tid')
						->select('topic_comment.*','user.uid','user.nickname','topic.content as topic_content','topic.type')
						->orderBy('tcid', 'desc')
						->paginate(config('admin_config.page'));
		return $comments;
	}
	public function getCommentOne($id){
		$comment = TopicComment::where('tcid',$id)
						->leftJoin('user', 'user.uid', '=', 'topic_comment.uid')
						->leftJoin('topic', 'topic.tid', '=', 'topic_comment.tid')
						->select('topic_comment.*','user.uid','user.nickname','topic.content as topic_content','topic.type')
						->orderBy('tcid', 'desc')
						->first();
		return $comment;
	}
}
