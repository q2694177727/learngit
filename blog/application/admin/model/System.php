<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class System extends Model
{
	protected $pk="system_id";
	protected $update=['update'];
	
	protected function setUpdateAttr(){
		return date("Y-m-d H:i:s",time());
	}
}