<?php
namespace app\test\controller;


/**
 * 测试继承类后的成员方法与成员属性的调用
 *	
 *	关键词 :final   static  const  
 *  判断一个对象是否为另一个的继承:instanceof
 *  简单的单例模式
 */
trait Oneclass
{
	private  static $instances = [];
	public $a;
 	final public function getInstances(){
		if( !self::$instances instanceof self){
			self::$instances = new self;
		}
		return self::$instances;
	}
	final protected function getClass(){
		$classname = explode('\\',get_called_class());
		return  end($classname);
	}
	public function __construct(){

		
	}

}