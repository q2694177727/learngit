<?php
namespace app\admin\controller;

use  think\Controller;

/**
 * 
 */
class Redis extends Controller
{
	private  static $_server;

	public function __construct(){
		
		self::$_server = new \Redis;

		self::$_server->connect('localhost');
	}
	public function redis_push($name,$value){
		$res = self::$_server->lPush($name,$value);
		return $res;
	}
	public function redis_pop($name){
		$res = self::$_server->rPop($name);
		return $res;
	}
	public function test(){
		
		// halt($_server);
		// $a = cookie('testname','老王');
		
		// $_server->set('testname','老刘');
		//入栈,在队列的末尾
		// $_server->rPush('name2','呦呦呦');
		//入栈,在队列的开头
		// $_server->lPush('name2','耶耶耶');

		/**一些redis的秒杀功能,就是将ID传入队列,通过lPush传入,然后由rPop获得,这样就会出现先入先出的情况,而秒杀功能就能实现。
		简单的想法，就是加购物车或者提交订单的话，将ID传入redis的队列，通过先入先出的原理，出来一个，商品数量-1，通过if语句判断商品数量是否为0，如果不为0则走消费出来，如果为0则走失败。将结果回调出来，秒杀功能实现

		**/

		//返回最后一个入栈的数据,并将redis中的数据出栈
		// $a = $_server->rPop('name2');
		// dump($a); 
	}
	// public function set()
}