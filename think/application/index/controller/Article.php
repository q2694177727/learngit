<?php

namespace app\index\controller;
use  think\Db;
use  think\Controller;
class Article extends Controller
{

	/*id    int  article表中的ID
	
	将文章取出单条或者所有,通过操作将两个表的数据进行交互。
	
	*/
	public function article_list($id=null)
	{
		if(empty($id)){
			$model1 = new \app\admin\model\Article;
			$data = $model1->all();
			// halt($data);
		


			//关联两个表的数据
			foreach ($data as $key => $value) {
				$mod = new \app\admin\model\ArticleDescribe;
				$arr = $mod->where('article_id',$value['article_id'])->select();
				if(!empty($arr)){
					$data[$key]['describe_author']  = $arr[0]['describe_author'];
					$data[$key]['describe_content'] = $arr[0]['describe_content'];
					$data[$key]['describe_as_con']  = $arr[0]['describe_as_con'];
					// $data[$key]['article_name'] = $arr['article_name'];
					// $data[$key]['message_ status']=$arr['message_ status'];
					// $data[$key]['article_sort'] = $arr['article_sort'];
					// $data[$key]['article_stats'] =	$arr['article_stats'];
				}
			}
		
			return $data;
		}else{
			$data2 = db('article_describe')->where('article_id',$id)->find();
			$data = db('article')->where('article_id',$id)->find();
			$data['describe_content'] = $data2['describe_content'];
			$data['describe_author']  = $data2['describe_author'];
			$data['describe_as_con']  = $data2['describe_as_con'];
			return  $data;
		}
		
	}
}