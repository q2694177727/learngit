<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class MemberCard extends  Model
{
	protected $pk 	=	'card_id';
	protected $update=['card_addtime'];

	protected function setCardAddtime(){
		return date('Y-m-d H:i:s',time());
	}
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
	public function member(){
		return $this->belongsTo('Member');
	}

}