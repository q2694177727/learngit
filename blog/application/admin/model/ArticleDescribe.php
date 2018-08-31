<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class ArticleDescribe extends Model
{
	protected $pk = "describe_id";

	public function article(){
		
		return $this->belongsTo('Article');
	}
	public function article_pic(){
		return $this->hasMany('ArticlePic','describe_id');
	}
}