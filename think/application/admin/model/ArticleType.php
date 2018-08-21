<?php
namespace app\admin\model;

use think\Model;

class ArticleType extends Model
{
	protected $pk="type_id";
	protected $insert = ['add_time'];
	protected function setAddTimeAttr(){
		return date('Y-m-d H:i:s',time());
	}


}

