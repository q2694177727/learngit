<?php
namespace   app\index\controller;

use think\Controller;

/**
 * 
 */
class Jump extends Controller
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }



    //页面栏目跳转
	public function index($tags,$column_id=""){
		// halt(input());
		if(empty($column_id)){

			$url = 'index/'.$tags;
			$this->redirect($url);
		}else{

			$url="index/".$tags;
			$this->redirect($url,["column_id"=>$column_id]);
		}
		
	}
	//空页面跳转
	public function __empty(){
		$this->redirect('index');
	}

}