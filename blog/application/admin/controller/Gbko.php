<?php
namespace app\admin\controller;
use  think\Controller;

class Gbko extends Controller{
	public function gbko_desc(){
		$data  = db('message_content')->where('content_id',input('id'))->find();
		$this->assign('desc',$data);
		return  view();
	}
	public function gbko_desc_up(){
		// halt(input());
		$mod = model('message_content')->get(input('content_id'));
		$mod->content_describe=input('content_describe');
		$mod->save();
		$this->redirect('index/gbko');

	}
}