<?php
namespace app\admin\model;
use think\Model;


class Column extends Model
{
	protected  $pk = "column_id";

	public function cloumn_out(){
		return $this->hasOne('ColumnOut','cloumn_id');
	}

}