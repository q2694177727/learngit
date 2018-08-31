<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class ArticlePic extends Model
{
	protected $pk = "article_pic_id";

	public function article(){
		
		return $this->belongsTo('Article');
	}
	public function article_describe(){
		return $this->belongsTo('ArticleDescribe');
	}
}