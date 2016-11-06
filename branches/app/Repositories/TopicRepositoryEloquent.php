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
class TopicRepositoryEloquent extends BaseRepository implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }
	
	/**
	 * 获取任务列表
	 */
	public function getTopicList()
	{
        $topics = Topic::leftJoin('user', 'user.uid', '=', 'topic.uid')
						->select('topic.*','user.uid','user.nickname')
						->orderBy('tid','desc')
						->paginate(config('admin_config.page'));
		return $topics;
	}

	public function getTopicOne($id)
	{
        $topic = Topic::where('tid',$id)
        				->leftJoin('user', 'user.uid', '=', 'topic.uid')
						->select('topic.*','user.uid','user.nickname')
						->first();
		return $topic;
	}

	public function getTopicType(){
		$topic_type = TopicType::get();
		return $topic_type;
	}
	
	public function getIsHasTopic($uid,$type,$content){
		$topic = Topic::where('uid',$uid)
					->where('type',$type)
					->where('content',$content)
					->first();
		return $topic;
	}

}
