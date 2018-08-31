<?php
namespace app\admin\controller;

use think\Request;
use think\Controller;
/**
 * 
 */
class Server  extends Controller
{

	//图片上传

	/*
		system 表中有 是否设置水印,后期封装一个水印的类,然后在此进行调用
	*/
	public function fileupload(Request $request){
		


		// dump($_FILES);exit;


		$file  =  $request->file('file');
        if(empty($file)) {  
            $this->error('请选择上传文件');  
        } 
        $dir = "./file/upload";
   //      if(!is_dir($dir)){
			// $dir = "./file/upload";
   //      }
        dump($dir);
        $info = $file->move($dir); 
        dump($info);

        $filename = $info->getSaveName();
        // dump($filename);
		// $url="C:\Users\Administrator\Desktop\\test.txt";
		// $f  = fopen($url,'a');
		// $str= $_FILES["file"]["name"].$_FILES["file"]["type"].$_FILES["file"]["size"].$_FILES["file"]["tmp_name"]."这是一次.";
		// $length=strlen($str);
		// fwrite($f,$str,$length);
		// fclose($f);
		$arr = [];
		$tokey = session('tokey');
		if(session('file')){
			$arr = session('file');
			$arr[] = ['dir'=>$dir,'filename'=>$filename,'tokey'=>$tokey];

		}else{
			$arr[] = ['dir'=>$dir,'filename'=>$filename,'tokey'=>$tokey];
		}
		// dump($arr);
		session('file',$arr);
		// dump(session('file'));
		// return ['success'=>200];
		// halt(cookie('file'));

		//文件上传
		// $file = $_FILES;

		/*
		1、上传之后如何传到文章表数据库。
		2、修改、删除、如何进行操作。如何关联到数据库
		3、如果上传之后没有保存呢。

		处理：暂存区。将数据暂时存起来，使用Session或者cookie 
		*/
	}
	public function index(Request $request){
		


		// dump($_FILES);exit;


		$file  =  $request->file('file');
        if(empty($file)) {  
            $this->error('请选择上传文件');  
        } 
        $dir = "./file/upload";
   //      if(!is_dir($dir)){
			// $dir = "/home/wwwroot/default/blog/public/file/upload";
   //      }
        // halt($dir);
        $info = $file->move($dir); 
        // dump($info);

        $filename = $info->getSaveName();
        // dump($filename);
		// $url="C:\Users\Administrator\Desktop\\test.txt";
		// $f  = fopen($url,'a');
		// $str= $_FILES["file"]["name"].$_FILES["file"]["type"].$_FILES["file"]["size"].$_FILES["file"]["tmp_name"]."这是一次.";
		// $length=strlen($str);
		// fwrite($f,$str,$length);
		// fclose($f);
		$arr = [];
		$tokey = session('tokey');
		if(session('file')){
			$arr = session('file');
			$arr[] = ['dir'=>$dir,'filename'=>$filename,'tokey'=>$tokey];

		}else{
			$arr[] = ['dir'=>$dir,'filename'=>$filename,'tokey'=>$tokey];
		}
		// dump($arr);
		session('file',$arr);
		// dump(session('file'));
		// return ['success'=>200];
		// halt(cookie('file'));

		//文件上传
		// $file = $_FILES;

		/*
		1、上传之后如何传到文章表数据库。
		2、修改、删除、如何进行操作。如何关联到数据库
		3、如果上传之后没有保存呢。

		处理：暂存区。将数据暂时存起来，使用Session或者cookie 
		*/
	}


	//上传
	// public function movefile($files){

	// 	$_FILES['file']=$files;
	// 	$dir = __DIR__."..\\..\\..\\public\\file\\upload\\";
	// 	$ext = get_ext($_FILES['file']['name']);
	// 	$dirname = date("Y-m-d",time())."\\".date("H-i-s",time());
	// 	$name = time().$ext;
	// 	if(is_dir($dir.$dirname)){
	// 		move_uploaded_file($_FILES['file']['tmp_name'],$dir.$dirname."\\".$name);
	// 		return ['dirname'=>$dirname,'name'=>$name,'dir'=>$dir];
	// 	}else{
	// 		return '失败';
	// 	}
		


	// }

	//删除文件
	// public function delfile($file)
	// {
	// 	$res = unlink($file);
	// 	return $res;
	// }
}