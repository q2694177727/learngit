<?php
namespace  app\admin\controller;

use think\Controller;
/**
 * 
 */
class Jump extends Controller
{
	
	// function __construct($model)
	// {
	// 	$this->model=$model;
	// }
	//添加后判断跳转
	public function insert(){
		// halt(input());
		$booler = Insert(cookie("model"),input("post."));
		//判断是否成功
		if($booler){
			$this->redirect("index/".cookie("model"));

		}else{
			$this->redirect("index/".cookie("model"));
		}
	}
	// public function jump(){
 //    if(empty($url2)){
 //        $url2=$url1;
 //    }
 //    if($data){
 //        $this->redirect($url1);
 //    }else{
 //        $this->redirect($url2);
 //    }
	// }

	//修改单条数据
	public function update(){
		//post中需要附带ID值 支持单条修改
		$booler = Update(cookie("model"),input("post."));
		//判断是否成功
		// halt($booler);
		if($booler){
			$this->redirect("index/".cookie("model"));

		}else{
			$this->redirect("index/".cookie("model"));
		}
	}

	//删除单条数据
	public  function  delete(){
		$id = cookie('id');
		$booler = Delete(cookie("model"),$id);
		cookie('id',null);
		cookie('model',null);
		//判断是否成功
		if($booler){
			return $booler;
		}else{
			return $booler;
		}

	}

	

}


?>