<?php
namespace app\admin\controller;
use think\Controller,Request,Session;

use app\admin\controller\Login;
/**
 * 
 */
class Index  extends Controller
{
	public function __construct(){
		if (!session('admin')) {
			//判断是否登录

			// echo '123';exit;
			$this->redirect('login/');
		}
		$time = time()-session('time');
		//判断是否登录未动作超时
		$overtime = 9999999;//单位秒,未行动时间
		if( $time > $overtime ){
			$this->redirect('login/');
		}else{
			session('time',time());
			//如果行动则刷新time值

		}
		if(session('file'))
		{
			session('file',null);
		}

		parent::__construct();

	}

	// private $param;
	public function index(){

		return view();
	}
	public function indexWelcome(){
		
		return view();
	}

	// public function test(Login $param){
	// 	$this->param=$param;
	// 	dump($this->param);
	// }	
	public function test2(){
		echo 'test2';
	}
	public function header(){
		return  view();
	}
	public function footer(){
		return view();
	}
	public function column(){
		$data = db('column')->select();
		$this->assign('column', $data);
		return view();
	}
	public function column_out(){
		$data = db('column_out')->select();
		$test = db('column')->select();

		foreach ($data as $key => $value) {
			for ($i=0; $i < count($test); $i++) { 
				if($value['column_id']==$test[$i]['column_id']){
					$data[$key]['column_id']=$test[$i]['column_name'];
				}
			}
			
		}

		$this->assign('column', $data);
		return view();
	}
	public function system(){
		$data = db('system')->select();
		$test = [];
		foreach ($data as $key => $value) {
			$test[$value['system_key']]= empty($value['system_val'])?($value['system_val']===0 ? $value['system_val']:$value['system_default']):$value['system_val'];
		}
		$this->assign('data',$test);
		return view();
	}
	//文章管理
	public function article(){
		$model1 = new \app\admin\model\Article;
		$data = $model1->all();
		// halt($data);
		


		//关联两个表的数据
		foreach ($data as $key => $value) {
			$arr = model("ArticleDescribe")->where('article_id',$value['article_id'])->find();
			
			// $arr2 = model('')
			if(!empty($arr)){
				// dump($arr);
				$data[$key]['describe_author']  = $arr['describe_author'];
				$arr2 = model("ArticlePic")->where('describe_id',$arr['describe_id'])->select();
				$i=0;
				$data[$key]['pic_dir'] = [];
				$pic_dir = [];
				foreach ($arr2 as $k => $v) {
					$i = $i+1;
					// echo $i;
					$pic_dir[] = $v['article_pic_dir'];
					// $data[$key]['pic_dir'][] = $v['article_pic_path'];
				}
				$data[$key]['pic_count'] = $i;
				$data[$key]['pic_dir'] = $pic_dir;

				// $data[$key]['article_name'] = $arr['article_name'];
				// $data[$key]['message_ status']=$arr['message_ status'];
				// $data[$key]['article_sort'] = $arr['article_sort'];
				// $data[$key]['article_stats'] =	$arr['article_stats'];
			}
		}
		// halt($column);

		// halt($data);
		// halt($data);
		// $a = $data->articleDescribe;
		// dump($a);
		// halt($data);

		$this->assign('data',$data);


		$column = db('column')->field('column_id,column_name')->select();
		$column2 = db('column_out')->field('column_out_id,column_out_name,column_id')->select();
		$arr = [];
		//转换二级栏目的数据,合并数据
		foreach ($column2 as $key => $value) {
			$column[] = ['column_id'=>($value['column_id'].'.'.$value['column_out_id']),'column_name'=>$value['column_out_name']];
		}
		// halt($column);
		$this->assign('column',$column);
		return view();
	}

	//文章标签页
	public function article_type(){
		$tags = db('article_type')->select();
		$this->assign('tags',$tags);
		return view();
	}

	//特别推荐栏目
	public function  article_push(){
		$model1 = new \app\admin\model\Article;
		$data = $model1->all();
		// halt($data);
		


		//关联两个表的数据
		foreach ($data as $key => $value) {
			$arr = model("ArticleDescribe")->where('article_id',$value['article_id'])->find();
			
			// $arr2 = model('')
			if(!empty($arr)){
				// dump($arr);
				$data[$key]['describe_author']  = $arr['describe_author'];
				$arr2 = model("ArticlePic")->where('describe_id',$arr['describe_id'])->select();
				$i=0;
				$data[$key]['pic_dir'] = [];
				$pic_dir = [];
				foreach ($arr2 as $k => $v) {
					$i = $i+1;
					// echo $i;
					$pic_dir[] = $v['article_pic_dir'];
					// $data[$key]['pic_dir'][] = $v['article_pic_path'];
				}
				$data[$key]['pic_count'] = $i;
				$data[$key]['pic_dir'] = $pic_dir;

				

				// $data[$key]['article_name'] = $arr['article_name'];
				// $data[$key]['message_ status']=$arr['message_ status'];
				// $data[$key]['article_sort'] = $arr['article_sort'];
				// $data[$key]['article_stats'] =	$arr['article_stats'];
					}


			//查看特别推荐表是否推荐
			$push = db('article_push')->where('article_id',$value['article_id'])->find();

			if(!empty($push)){
				$data[$key]['push_stats'] = $push['push_stats'];
				$data[$key]['push_name']  = $push['push_name'];
				if($push['pic_id']){
					$pics = db('article_pic')->where('article_pic_id',$push['pic_id'])->find();
					$push_dir = $pics['article_pic_dir'];
					$pic_life = 1;
				}
			}else{
				$pic_life = 0;
				$data[$key]['push_stats'] = 0;
			}
			$data[$key]['pic_life'] = $pic_life; 
			if($pic_life==1){
				$data[$key]['push_dir'] = $push_dir;
			}
			
			}
				// halt($column);

				// halt($data);
				// halt($data);
				// $a = $data->articleDescribe;
				// dump($a);
				// halt($data);
				



				


				$this->assign('data',$data);


				$column = db('column')->field('column_id,column_name')->select();
				$column2 = db('column_out')->field('column_out_id,column_out_name,column_id')->select();
				$arr = [];
				//转换二级栏目的数据,合并数据
				foreach ($column2 as $key => $value) {
					$column[] = ['column_id'=>($value['column_id'].'.'.$value['column_out_id']),'column_name'=>$value['column_out_name']];
				}
				// halt($column);
				$this->assign('column',$column);
				return view();
	}
	//轮播图
	public function picture(){
		$pictype = db('pic_type')->select();
		$this->assign('pic',$pictype);
		return view();
	}

	//屏蔽词
	public function shield(){
		$shield = db('shield')->find();
		$this->assign('shield',$shield);
		return  view();
	}
	public function upshield(){
		// halt(input(''));
		$shield = db('shield')->find();
		$map['shield_con']=input('shield');
		$res = db('shield')->where(['shield_id'=>$shield['shield_id']])->update($map);
		// if($res){
		// 	return ['data'=>"修改成功"];
		// }else{
		// 	return ['data'=>"修改失败"];
		// }
		$this->redirect('index/shield');
	}
	//评论列表
	public function gbko(){
		$message = db('message_content')->order('article_id asc')->order('floor_id asc')->select();
		$this->assign('message',$message);
		return  view();

	}
	public function upcontent($state,$id){
		$mod = model('message_content')->get($id);
		$mod->content_state=$state;
		$res = $mod->save();
		// halt($res);
		return $this->redirect('index/gbko');
	}
		
	//留言板
	public function message(){
		$data = db('message')->select();
		$this->assign('data',$data);
		return view();
	}

}