<?php

namespace app\admin\controller;
use  think\Controller,Db,Session;
/**
 * 
 */
class Article extends Controller
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
	
		
	//修改文章是否冻结
	/*
		$stats  int  0或者1 代表是否冻结
		$article_id  int   文章id
	*/
	public function article_stats(int $stats,int $article_id){
		// halt($article_id);
		// $model1 = new \app\admin\model\Article;
		// $data = $model1::get($article_id);
		// $data->article_static =  $static;
		// $a = $data->save();
		// halt($a);

		if(db('article')->where('article_id',$article_id)->update(['article_stats'=>$stats])){
			$this->redirect('index/article');
		}else{
			$this->redirect('index/article');
		}
	}

	//修改文章推荐
	/*
		$push  int  0或者1 代表是否推荐
		$id  int   文章id
	*/
	public function up_article_push($push,$id){
		db('article')->where('article_id',$id)->update(['article_push'=>$push]);
		$this->redirect('index/article');

	}


	public function article_add(){
		$tokey = tokey_get();
		$this->assign('tokey',$tokey);
		//使用session进行传tokey值
		session('tokey',$tokey); 

		$column 	= 	db('column')->where('column_disp',1)->select();
		$column2	=	db('column_out')->select();
		$this->assign('column',$column);
		$this->assign('column2',$column2);

		//标签
		$tags = db('article_type')->select();
		$this->assign('tags',$tags);

		return view();
	}
	
	//添加
	public function article_addd(){
		// halt(input());

		$tokey = input('post.tokey');

		//判断是否有图片上传
		if(!empty(session('file'))){
			$file = session('file');
			// session('file',null);  使用tokey判断,故不清空
			//清空file 防止二次操作出错
			/*
				如果因为特殊情况在上传图片之后一不小心关了网页,不仅会占用内存 还会干扰session的提交。
				1、在server类中返回session 中添加一个时间。当第二次添加时 会有一定的差值。可以设置3秒。这样既保证了同一批的添加，又去除了上一批的添加，且可以进行删除上一批没有添加成功的图片。
				bug ： 如果一个人点开两个网页，同时进行上传，但是提交了其中一个。
				测试：所有图片上传，但是第二个保存，图片消失。
				2、在上传的时候，进行判断是否有session('tokey'),没有的话进行添加一个tokey,进行识别,添加的同时刷新session('time'),第二次则,判断session('time')与当前之间有没有超过3s,如果超过了则删除或者重新提交tokey,如果没有超过3s,则重新赋time值并保存下来tokey。正常情况下，没问题。但如果遇到同时开页面的时候会报错。
				3、多重判断
				   时间、图片数量不得超过3张、
				4、使用ajax与js 配合前端的提交按钮,点击ajax调用一个封装好的删除session的东西。-》进行封装 并在下面使用
				在进入增加文章与更新文章的页面的地方添加删除session 与对应文件的函数。

				总结
				只要到达页面，则使用GET地址栏或者session等方法 传个tokey唯一值,获取的时候同时把tokey值获取到,上传图片前,先对照两个tokey是否相同,不同则删除之前的tokey.



				现在使用的是  将tokey 通过 添加修改页面映射到页面上hidden中, 然后通过session传给图片上传页面,唯一坏处 如果两个页面都是先点开 则还是会出现bug.但如果先上传一个 ,在点开另一个 则没问题,甚至实现n+的同时上传
			*/



			// $i=0;
			//判断几张图片
			$pic = [];
			// halt($file);
			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic[$key]['article_pic_path'] = $value['dir'];
					$pic[$key]['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);
		}

		
		
		//单条上传
		// if(!empty($file)){
		// 	foreach ($file as $key => $value) {
		// 	 $files = $value['file'];
		// 	}
		// 	$server = new \app\admin\controller\Server;
		// 	$res = $server->movefile($files);
		// 	dump($res);
		// }
		
		$desc['member_id'] 	=	session('admin')[0]['super_id'] ? 0:session('admin')[0]['member_id'];
		$desc['describe_content'] 	= 	input('post.describe_content');
		$desc['describe_author'] 	=	input('post.describe_author');
		$desc['describe_as_con']	=	input('post.describe_as_con');
		// $desc['describe_id'] 		= 	23;//测试事物成功



		$model1 = new \app\admin\model\Article;
		$model2 = new \app\admin\model\ArticleDescribe;
		$model3 = new \app\admin\model\ArticlePic;
		$model4 = new \app\admin\model\ArticleTypeTags;
		//使用事物 ,暂时废用模型
		Db::startTrans();

		try{
			
			$model1->data(input("post."));
			$model1->allowField(true)->save();


			$desc['article_id'] = $model1->article_id;
			$model2->data($desc);
			$model2->allowField(true)->save();
			
			//取出describe表中的id ,与pic进行关联
			if(!empty($pic)){
				foreach ($pic as $key => $value) {
				$pic[$key]['describe_id'] = $model2->describe_id;
				}
				// halt($dsbeid);
				// dump($pic);
				$model3->allowField(true)->saveAll($pic);

			}

			


			//标签表添加内容
			$tags = input('post.');
			// dump($tags);
			if(!empty($tags['tags_type'])){
				$tags_arr = [];
				foreach ($tags['tags_type'] as $key => $value) {
					// dump($value);
					$tags_arr[$key]['type_id']=$value;
					$tags_arr[$key]['article_id']=$desc['article_id'];
				}

					
				$model4->allowField(true)->saveAll($tags_arr);
			}
			
			// halt($res);



			
			
			//进行上传

			// $a = Db::name('article')->insert(input("post."));
			// $desc['article_id']  = Db::name('article')->getLastInsID();

			 
			// $b = Db::name('article_describe')->insert($desc);
			// $pic['describe_id'] = Db::name('article_describe')->getLastInsID();

			// $c = Db::name('article_pic')->insert($pic);


			// if($a&&$b&&$c){
			// 	throw new \Exception("添加数据失败");
			// }

			Db::commit(); 
			// exit;


		}catch (\Exception $e) {
			if(isset($pic)){
				foreach ($pic as $key => $value) {
				unlink($value['article_pic_path']."\\".$value['article_pic_dir']);
				}
			}
			
			Db::rollback();
			dump($e->getMessage());
		}

		$this->redirect('index/article');
		
	}

	//删除
	public function article_delete(int $id){

		//删除主表
		cookie('id',$id);
		cookie('model','article');
		@action('jump/delete');

		//删除describe表
		$data = db('article_describe')->where('article_id',$id)->find();
		cookie('id',$data['describe_id']);
		cookie('model','article_describe');
		@action('jump/delete');

		//删除article_pic表
		$data = db('article_pic')->where('describe_id',$data['describe_id'])->select();
		foreach ($data as $key => $value) {
			//删除图片释放空间
			$path = $value['article_pic_path']?$value['article_pic_path']:__DIR__."\\..\\..\\..\\public\\file\\upload";
			$dir = '../public/file/upload/'.$value['article_pic_dir'];
			unlink($dir);


			//删除对应数据
			cookie('id',$value['article_pic_id']);
			cookie('model','article_pic');
			@action('jump/delete');
		}
		//删除标签数据
		db('article_type_tags')->where('article_id',$id)->delete();
		//删除轮播图
		$slide = db('pic_dir')->where('article_id',$id)->find();
		if($slide){
			unlink('../public/file/upload/'.$slide['pic_dirname']);
			db('pic_dir')->where('article_id',$id)->delete();
		}
		
		$this->redirect('index/article');

	}


	
	//文章更新页
	public function article_up($id){
		$tokey = tokey_get();
		$this->assign('tokey',$tokey);
		//使用session进行传tokey值
		session('tokey',$tokey); 


		$data = db('article')->where('a.article_id',$id)->alias('a')->join('article_describe d','a.article_id = d.article_id','LEFT')->find();
		// halt($data);
		$pic = db('article_pic')->where('describe_id',$data['describe_id'])->select();

		// halt($pic);
		$i=0;
		$arr=[];
		//多少图片
		foreach ($pic as $key => $value) {
			$arr[$key]= $value['article_pic_dir'];
			// $arr[$key]['pic_path'] = $value['article_pic_path'];
			$i++;
		}
		$data['pic_count'] = $i;
		$data['pic_dir']   = $arr;
		// halt($data);

		$this->assign('data',$data);
		// halt($data);

		$column = db('column')->field('column_id,column_name')->select();
		$column2 = db('column_out')->field('column_out_id,column_out_name,column_id')->select();
		//转换二级栏目的数据,合并数据
		foreach ($column2 as $key => $value) {
			$column2[$key] = ['column_out_id'=>($value['column_id'].'.'.$value['column_out_id']),'column_name'=>"├".$value['column_out_name'],'column_id'=>$value['column_id']];
		}
		// halt($column2);
		//所有标签
		$tags = db('article_type')->select();

		//标签的显示
		$tag = db('article_type_tags')->where('article_id',$id)->field('type_id')->select();
		$tag_arr = [];
		foreach ($tag as $key => $value) {
			$tag_arr[] = $value['type_id'];
		}
		//将数组转化为字符串
		$tag_arr = implode(',',$tag_arr);

		// halt($tags);
		$this->assign('tags',$tags);
		$this->assign('tag',$tag_arr);
		$this->assign('column',$column);
		$this->assign('column2',$column2);
		return  view();
	}

	//文章更新
	public function article_upp(){
		$tokey = input('post.tokey');
		$pic = null;
		//更新图片
		if(!empty(session('file'))){
			$file = session('file');
			// dump(session('file'));
			// session('file',null);
			//清空file 防止二次操作出错

			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic[$key]['article_pic_path'] = $value['dir'];
					$pic[$key]['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);

			
			//需要删除的文件
		}

		
		// exit;

		// $desc['member_id'] 	=	session('admin')[0]['super_id'] ? 0:session('admin')[0]['member_id'];
		$desc['describe_content'] 	= 	input('post.describe_content');
		$desc['describe_author'] 	=	input('post.describe_author');
		$desc['describe_as_con']	=	input('post.describe_as_con');
		$desc['describe_update']	=	date('Y-m-d H:i:s',time());
		$model1 = new \app\admin\model\Article;
		$model2 = new \app\admin\model\ArticleDescribe;
		$model3 = new \app\admin\model\ArticlePic;
		$model4 = new \app\admin\model\ArticleTypeTags;
		Db::startTrans();
		try{

			//数据上传到article表
			// echo $model1->article_id;
			$model1->allowField(true)->save(input("post."),['article_id'=>input('post.article_id')]);

			// echo '1';
			$desc['article_id'] = $model1->article_id;
			// dump($desc['article_id']);
			// $model2->allowField(true)->save($desc,['article_id'=>input('post.article_id')]);

			$res[] = Db::name('article_describe')->where('article_id',$desc['article_id'])->update($desc);

			$descid = Db::name('article_describe')->where('article_id',$desc['article_id'])->value('describe_id');

			// echo '123';
			if($pic!=null){
				// echo "2";
				// $descid = $model2->describe_id;
				$arr = Db::name('article_pic')->where('describe_id',$descid)->select();
				//查找数据
				//删除数据
				$res[] = Db::name('article_pic')->where('describe_id',$descid)->delete();
				foreach ($pic as $key => $value) {
					$pic[$key]['describe_id'] = $descid;
				}

				//需要删除的图片
				$unpic = $arr;
				
				//添加图片
				$res[] = Db::name('article_pic')->insertAll($pic);
			}
			//由于会发生只有标签更新的情况,故将commit添加一个在此,后正常.
			Db::commit();	
			//标签云的更新
			$tags = input('post.');
			// dump($tags);
			if(!empty($tags['tags_type'])){
				// echo "存在标签";
				$tags_arr = [];
				$tag = db('article_type_tags')->where('article_id',$tags['article_id'])->select();
				$arr = [];
				//将已经存在的标签ID转化为数组
				foreach ($tag as $key => $value) {
					$arr[] = $value['type_id'];
				}
				//遍历需要更新的标签数组
				foreach ($tags['tags_type'] as $key => $value) {
					//判断需要更新的标签是否存在,如果不存在则添加
					if(!in_array($value,$arr)){
						$tags_arr['type_id']=$value;
						$tags_arr['article_id']=$desc['article_id'];
						$res[] = Db::name('article_type_tags')->insert($tags_arr);
						// echo "添加一条标签";
					}

				}
				//添加之后取出数据,然后与更新的标签进行对比,如果库里的多,则进行删除
				$tag = db('article_type_tags')->where('article_id',$tags['article_id'])->select();
				// echo "123";
				$arr = [];
				
				foreach ($tags['tags_type'] as $key => $value) {
					$arr[]=$value;
				}
				// $tags = input('post.');
				// dump($arr);exit;
				// dump($tag);
				foreach ($tag as $key => $value) {
					//判断数据库中的标签数是否多,多则删除
					if(!in_array($value['type_id'],$arr)){
						$res[] = Db::name('article_type_tags')->where('tags_id',$value['tags_id'])->delete();
						// echo "删除一条标签";
					}
				}
					
					
				// $model4->allowField(true)->saveAll($tags_arr);
			}else{
				// echo "删除所有";
				$model4::where('article_id',$tags['article_id'])->delete();

			}
			// dump($res);
			// foreach ($res as $key => $value) {
			// 	if($value)
			// }

			//数据上传到describe表
			Db::commit();
			//删除图片释放空间
			// foreach ($arr as $key => $value) {
			// 	unlink($value['article_pic_path']."\\".$value['article_pic_dir']);
			// }

		}catch (\Exception $e) {
			// echo "123";
			Db::rollback();
			dump($e->getMessage());
			// echo 'shibai';

		}
		
		
		// exit;
		
		// halt();


		//由于未更改图片,会报错未赋值,故去除报错
		// halt($res);
		return $this->redirect('index/article');
	}

	//特别推荐添加页
	public function article_push_add(){
		$tokey = tokey_get();
		$this->assign('tokey',$tokey);
		//使用session进行传tokey值
		session('tokey',$tokey); 
		return view();
	}

	//特别推荐添加逻辑

	public function article_push_ad(){
		$tokey = input('post.tokey');
		$pic = null;
		//更新图片
		if(!empty(session('file'))){
			$file = session('file');
			// dump(session('file'));
			// session('file',null);
			//清空file 防止二次操作出错

			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic[$key]['article_pic_path'] = $value['dir'];
					$pic[$key]['article_pic_dir'] = $value['filename'];
					// $i=$i+1;
					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);

			
			//需要删除的文件
		}

		
		// halt($data);


		//添加图片
		// Db::name('article_pic')->insertAll($pic);
		$mod = model('article_pic');
		$pic_id = '';
		foreach ($pic as $key => $value) {
			$mod->data($value);
			$mod->allowField(true)->save();
			$pic_id		= 	$mod->article_pic_id;
		}
		// halt($id);
		$data = input('post.');
		$data['pic_id']=$pic_id;
		model('article_push')->data($data)->allowField(true)->save();
		halt($data);
	}

	//特别推荐修改页
	public function article_push_up($id){

		$tokey = tokey_get();
		$this->assign('tokey',$tokey);
		//使用session进行传tokey值
		session('tokey',$tokey); 


		$art = db('article')->where('article_id',$id)->find();
		$data = db('article_push')->where('article_id',$id)->find();
		if(empty($data)){
			$data['push_name'] = "";
			$data['article_id']=$id;
			$data['pic_id'] ="0";
			$data['push_stats'] = 0;
			// $data['']
		}else{
			if($data['pic_id']){
				$data['pic_dir'] = db('article_pic')->where('article_pic_id',$data['pic_id'])->value('article_pic_dir');
			}

			

		}
		// halt($data);
		$this->assign('data',$data);
		return view('article/article_push_up');

	}
	public function article_push_upp(){

		$tokey = input('post.tokey');
		$pic = null;
		//更新图片
		if(!empty(session('file'))){
			$file = session('file');
			// dump(session('file'));
			// session('file',null);
			//清空file 防止二次操作出错

			//遍历二维数组$file 
			foreach ($file as $key => $value) {
				if($value['tokey']==$tokey){
					$pic[$key]['article_pic_path'] = $value['dir'];
					$pic[$key]['article_pic_dir'] = $value['filename'];
					// $i=$i+1;
					//释放session空间
					unset($file[$key]);
				}
				//为关联表添加属性
			}
			session('file',$file);

			
			//需要删除的文件
		}

		// echo "图片上传完毕";

		//查找是否有这一条记录
		$article = db('article_push')->where('article_id',input('article_id'))->find();
		$data 	=	input('post.');
		//判断是新增还是修改
		// halt($article);
		if(empty($article)){
			
			if ($pic) {
				$picmod =  new \app\admin\model\ArticlePic;
				$picid =  [];
				foreach ($pic as $key => $value) {
				$picmod->data($value);
				$picmod->save();
				$pic = $picmod->article_pic_id;

				}
				$data['pic_id'] = $pic;
				
			}
			
			$a = model('article_push');
			$a->data($data);
			$a->save();
			// echo "新增添加pic 与 push 表完毕";

		}else{
			$data['article_push_id'] = $article['article_push_id'];
			// $data['article_push_id'] = []
			//找到与其对应的pic 则删除,释放空间
			if(empty($article['pic_id'])){
				if (!empty($pic)) {
					$picmod =  new \app\admin\model\ArticlePic;
					$picid =  [];
					foreach ($pic as $key => $value) {
					$a = $picmod->data($value);
					$a->save();
					$pic = $a->article_pic_id;

					}
					$data['pic_id'] = $pic;
				
				}

				// echo  "没有对应pic";
			}else{
				// echo"有对应pic";
				

				if (!empty($pic)){
					model('article_pic')->destroy($article['pic_id']);
					$picmod =  new \app\admin\model\ArticlePic;
					$picid =  [];
					foreach ($pic as $key => $value) {
					$a = $picmod->data($value);
					$a->save();
					$pic = $a->article_pic_id;

					}
					$data['pic_id'] = $pic;
				
				}

			}

			$a = model('article_push');
			// $a->data($data);
			$a->allowField(true)->save($data,['article_push_id'=>$data['article_push_id']]);
			// echo "上传成功push";
		}
		$this->redirect('index/article_push');
	}


	//更改特别推荐状态开关
	public function article_push_stats($stats,$article_id){
		$data = db('article_push')->where('article_id',$article_id)->find();
		if(empty($data)){
			return action('article/article_push_up',$article_id);
		}else{
			db('article_push')->where('article_id',$article_id)->update(['push_stats'=>$stats]);
			$this->redirect('index/article_push');
		}
	}

	//标签云添加
	public function article_type_add(){
		return view();
	}
	//标签添加
	public function add_article_type(){
		$data = input('post.');
		if(!empty(session('file'))){
			$file = session('file');
			$pic  = [];
			// dump(session('file'));
			// session('file',null);
			//清空file 防止二次操作出错

			//遍历二维数组$file 
			foreach ($file as $key => $value) {
					//默认为一条
					$pic['article_pic_path'] = $value['dir'];
					$pic['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				
				//为关联表添加属性
			}
			session('file',null);
			$data['type_pic'] = $pic['article_pic_dir'];
		}
		// halt($pic);

		

		if(empty($data['type_color'])){
			$data['type_color']= dechex(mt_rand('0','255')).dechex(mt_rand('0','255')).dechex(mt_rand('0','255'));
			// halt($data);
		}
		$mod = model('article_type');
		$mod->data($data);
		$res = $mod->save();
		// dump(input('post.'));
		// dump($res);
		$this->redirect('index/article_type');
	}
	//标签修改
	public function article_type_up($id){
		$data = db('article_type')->where('type_id',$id)->find();
		$this->assign('data',$data);
		return view();
	}
	public function up_article_type(){
		$data = input('post.');
		if(!empty(session('file'))){
			$file = session('file');
			$pic  = [];
			// dump(session('file'));
			// session('file',null);
			//清空file 防止二次操作出错

			//遍历二维数组$file 
			foreach ($file as $key => $value) {
					//默认为一条
					$pic['article_pic_path'] = $value['dir'];
					$pic['article_pic_dir'] = $value['filename'];
					// $i=$i+1;

					//释放session空间
					unset($file[$key]);
				
				//为关联表添加属性
			}
			session('file',null);
			$data['type_pic'] = $pic['article_pic_dir'];

			// halt($pic);
			$mod = model('article_type');
			$test = $mod->get($data['id']);
			@unlink("../public/file/upload/".$test->type_pic);
			$test->data($data);
			$test->save();
		}else{
			$mod = model('article_type');
			$test = $mod->get($data['id']);
			// unlink("../public/file/upload/".$test->type_pic);
			$test->data($data);
			$test->save();
		}
		
		
		$this->redirect('index/article_type');
	}
	//标签删除
	public function del_article_type($id){
		$pic = db('article_type')->where('type_id',$id)->value('type_pic');
		db('article_type_tags')->where('type_id',$id)->delete();
		@unlink("../public/file/upload/".$pic);
		cookie('id',$id);
		cookie('model','article_type');
		action('Jump/delete');
		$this->redirect('index/article_type');
	}
}