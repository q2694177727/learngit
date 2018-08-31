<?php
namespace   app\admin\controller;
use  think\Controller,Db;

/**
 * 
 */
class System extends Controller
{
	public function up_sys(){
		$post = input('post.');
		// $arr = ['system_key'=>'测试','system_val'=>'测试','system_id'=>1];
		Db::startTrans();
		try {
			// Db::name('system')->delete(30,123213);
		    foreach ($post as $key => $value) {
				Db::name('system')->where('system_key',$key)->update(['system_val' => $value]);

			}
			// Db::name('system')->insert($arr);
			/*
				经过测试,当数据添加时发生错误会回滚,但是当使用delete时却不会回滚。需注意使用静态方法进行操作数据库才会有事物机制(Db::),反之则不会(db()->);
			*/
		    // 提交事务
		    Db::commit();
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();

		}
			$this->redirect('index/system');
		}
}
	