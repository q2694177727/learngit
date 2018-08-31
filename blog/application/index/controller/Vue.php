<?php


namespace app\index\controller;

use  think\Controller;
/**
* 	测试Vue
*/
class Vue extends Controller
{
	//首页，做成使用VUE异步调用同一类下的其他接口 调取数据
	public function index(){
		return view();
	}
	//测试
	public function test(){
		
	}
	//测试Vue中的 v-for标签
	public function test_for(){
		return ['data'=>['1'=>['name'=>'张三'],'2'=>['name'=>'李四'],'3'=>['name'=>'王五']]];
	}
	public function test_fors(){
		return ['data'=>['1'=>['name'=>'张三2'],'2'=>['name'=>'李四2'],'3'=>['name'=>'王五2']]];
	}
}