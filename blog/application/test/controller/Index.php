<?php
namespace app\test\controller;

/**
 * 
 */
class Index
{
	use  Oneclass;

	protected  $v;
	protected  $k;
	public function __construct(){
		
		}
		
	public function index(){
		// $a = ;
		// $b =1;
		// if(empty($a ?? $b ?? $c)){
		// 	echo '123';
		// }else{
		// 	echo '456';
		// }
		echo shell_exec('whoami');

	}
	

	/**
	*	单例模式测试
	*/
	public	function  test1(){
		// $fn = new Oneclass;
		$a  = $this->getInstances();
		$b  = $this->getInstances();
		$a->a = "测试1";
		$b->a = "测试2";
		dump($a);
		halt($b);
	}
}