<?php
namespace app\admin\model;
use think\Model;

/**
 * 
 */
class Member extends Model
{
	
	protected $pk 	=	'member_id';
	protected $insert = ['member_addtime'];
	// protected $insert=['card_state'=1];
	// function __construct(argument)
	// {
	// 	# code...
	// }
	protected function setMemberAddtimeAttr(){
		return date('Y-m-d H:i:s',time());
	}
	public function memberCard(){
		return $this->hasOne('MemberCard','member_id')->bind('card_turename,card_birth_ress,card_addtime');
	}
}