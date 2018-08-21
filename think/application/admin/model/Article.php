<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class Article extends Model
{
	
	protected $pk 	=	'article_id';
	protected $insert = ['add_time'];
	// protected $insert=['card_state'=1];
	// function __construct(argument)
	// {
	// 	# code...
	// }
	protected function setAddTimeAttr(){
		return date('Y-m-d H:i:s',time());
	}
	public function articleDescribe(){
		return $this->hasOne('ArticleDescribe','article_id')->bind('addtime,describe_content,describe_author');
	}
}