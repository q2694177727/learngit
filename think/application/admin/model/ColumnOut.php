<?php
namespace app\admin\model;
use think\Model;


class ColumnOut extends Model
{
	protected  $pk = "column_out_id";

	public function column(){
		return  $this->belongsTo('Column');
	}

}