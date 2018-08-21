<?php
namespace app\admin\controller;
use think\Controller;

/**
 * 
 */
class Picture extends Controller
{
	public function picture_type_add(){
		return view();
	}
	public function add_picture_type(){
		db('pic_type')->insert(input('post.'));
		$this->redirect('index/picture');
	}

	public function picture_show(){
		
		$typeid = input('type_id');
		$data = db('pic_type')->alias('t')->join('pic_dir d','d.pic_type_id=t.pic_type_id')->where('t.pic_type_id',$typeid)->select();
		$this->assign('data',$data);
		return view();
	}
	public function picture_show_add(){
		$tokey = tokey_get();
		session('tokey',$tokey);
		$this->assign('tokey',$tokey);
		return view();
	}
	public function add_picture_show(){

		$tokey = input('post.tokey');
		//判断是否有图片上传
		if(!empty(session('file'))){
			$file = session('file');
			$pic = [];
			// dump($file);
			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic['article_pic_path'] = $value['dir'];
					$pic['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);
			// halt($pic);
			$data =  input('post.');
			$data['pic_dirname']=$pic['article_pic_dir'];
			// halt($data);
			$mod = model('pic_dir');
			$mod->data($data);
			$mod->allowField(true)->save();
			$this->redirect('picture/picture_show',['type_id'=>input('pic_type_id')]);
		}else{
			return ['error'=>'没有添加图片'];
	}
		
		

		
	}
	public function del_picture_show(){
		$unpic = db('pic_dir')->where('pic_dir_id',input('id'))->value('pic_dirname');
		// echo "<img src=../../file/upload/".$unpic.">";exit;
		$unpic = "../public/file/upload/".$unpic;
		unlink($unpic);
		db('pic_dir')->where('pic_dir_id',input('id'))->delete();
		$this->redirect('picture/picture_show',['type_id'=>input('type_id')]);
	}
	public function picture_show_up(){
		$tokey = tokey_get();
		session('tokey',$tokey);
		$pic = db('pic_dir')->where('pic_dir_id',input('id'))->find();
		$pic['type_id']=input('type_id');
		$pic['tokey'] = $tokey;
		$this->assign('pic',$pic);
		return view();	
	}
	public function up_picture_show(){
		$tokey = input('post.tokey');
		//判断是否有图片上传
		if(!empty(session('file'))){
			$file = session('file');
			$pic = [];
			// dump($file);
			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic['article_pic_path'] = $value['dir'];
					$pic['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);
		}
		// halt($pic);
		$data = input('post.');
		$test = [];
		// $test['pic_type_id'] = $data['type_id'];
		$test['pic_dir_name']= $data['pic_dir_name'];
		$test['pic_dir_id']  = $data['pic_dir_id'];
		$test['article_id']  = $data['article_id'];
		if(!empty($pic)){
			echo '123';
			$unpic = db('pic_dir')->where('pic_dir_id',$data['pic_dir_id'])->value('pic_dirname');
			$unpic = "../public/file/upload/".$unpic;
			$test['pic_dirname']=$pic['article_pic_dir'];
			db('pic_dir')->update($test);
			unlink($unpic);
		}else{
			// echo '123';
			db('pic_dir')->update($test);
		}
		$this->redirect('picture/picture_show',['type_id'=>$data['type_id']]);
	}
}