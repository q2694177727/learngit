<?php
namespace app\index\controller;
use  \QRcode;
/**
 * 
 */
class Test
{
	
	public function index()
	{
		return view();
	}

	/*
	php二维码显示
	*/
	public function phpqrcode(){
		// include "\phpqrcode\phpqrcode";
		// require_once 'vendor/phpqrcode/phpqrcode.php';
		// require_once 'vendor/phpqrcode/phpqrcode.php';

		// $a = new QRcode;
		// $foo = new \QRcode();
		$value = input('name')?input('name'):'微信二维码'; //二维码内容

		$errorCorrectionLevel = 'L';//容错级别

		$matrixPointSize = 6;//生成图片大小

		//生成二维码图片

		QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
		//qrcode.png   生成的png的二维码

		

		echo '<img src="../../qrcode.png">';

	} 

	public function get_ip(){
    //判断服务器是否允许$_SERVER
    if(isset($_SERVER)){    
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            $realip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        //不允许就使用getenv获取  
        if(getenv("HTTP_X_FORWARDED_FOR")){
              $realip = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
              $realip = getenv("HTTP_CLIENT_IP");
        }else{
              $realip = getenv("REMOTE_ADDR");
        }
    }

    dump($realip);
	} 
	public function phpconfig(){
		phpinfo();
	}
	public function action_redis(){
		cache('name','laowang');
		echo cache('name');
	}

}