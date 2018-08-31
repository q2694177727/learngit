<?php
namespace  app\admin\controller;
use think\Controller;
/**
 * 
 */
class Column extends Controller
{

	public function index(){
		
	}
	
	public function addcolumn(){
		return view();
	}

	public function add_column(){
		cookie('model',"column");
		//分辨表

		action("Jump/insert");
		//调用jump表中的方法
	}
	public function upcolumn($id){
		//显示数据
		$data = db('column')->where('column_id',$id)->select();
		$this->assign('column',$data);
		return view();
	}
	public function up_column(){
		cookie('model',"column");
		//分辨表

		action("Jump/update");
		//调用jump表中的方法
	}
	public function delcolumn($id){
		cookie('model',"column");
		//分辨表
		cookie('id',$id,10);
		action("Jump/delete");
		$this->redirect("index/column");
		//调用jump表中的方法
	}
	public function addcolumnOut(){
		$data = db('column')->where('column_disp','1')->select();
		$this->assign('column',$data);
		return view();
	}

	public function add_columnOut(){
		cookie('model',"column_out");
		//分辨表

		action("Jump/insert");
		//调用jump表中的方法
	}
	public function upcolumn_out(){
		$column = db('column')->where('column_disp','1')->select();
		$this->assign('column',$column);
		$column_out = db('column_out')->where('column_out_id',input('id'))->find();
		$this->assign('column_out',$column_out);
		// halt($column_out);
		return view();
	}
	public function up_columnOut(){
		cookie('model',"column_out");
		//分辨表
		action("Jump/update");
	}
	public function delcolumnOut($id){
		cookie('model',"column_out");
		//分辨表
		cookie('id',$id,10);
		action("Jump/delete");
		$this->redirect("index/column_out");
	}


	//更改栏目是否显示二级栏目
	public function column_disp($id,$stats){
		$col = model('column')->get($id);
		$col->column_disp=$stats;
		if($col->save()){
			$this->redirect('index/column');  //成功
		}else{
			$this->redirect('index/column');	//失败
		}

	}

}
