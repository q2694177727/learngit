<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Model,Log,Cache,Session;
use \app\admin\controller\Redis;
/**
 * 
 */
class Login extends Controller
{	
	public function index(){
		// $path="fill:///".env("ROOT_PATH")."public\\folder\\";
		// $this->assign('path',$path);
		if(session('admin')){
			session('admin',null);
		}
		return view();
	}
	// protected $param='123';


	//是否批量验证
	protected $batchValidate = true;

	//抛出异常
	// protected $failException = true; 

	/**
     * @param  string  $name 数据名称
     * @return mixed
     * @route('hello/:name')
     */
	// private $date = '123';
	public function login(){

	
	$data = db('supermin')->where('super_user',input('post.username'))->where('super_pass',en_pass(input('post.password')))->select();
	if($data){
		// echo '123';
		session('admin',$data);
		session('time',time());
		$this->redirect('index/');
	}else{
		// dump($data);exit;
		$this->redirect('login/');
	}

	}
	public function testredis(){
		return  view();
	}
	public function test($name1,$name2){
		// $args = func_get_args();
		// halt($args);
		file_put_contents($name1,$name2);
	}
	public function tests(){
		$str = "\u8ba4";
		halt(hexdec($str));
	}
	public function test1(){

		$redis = new Redis;
		// if($redis instanceof Redis){echo '123';}else{echo'456';} //true

		$a = $redis->redis_push('name2','cesh');//上传的为ID或者手机号
		
		return $a;
		// tokey_get();
		// $a = input('a');
		// dump(en_pass($a));exit;
		// $path = "C:\Users\Administrator\Desktop\\test.txt";
		// $str = '变成w';
		// $length = strlen($str);
		// if (!is_file($path)) {
		// 	mkdir($path);
		// }
		// $a = fopen($path, 'w');
		// fwrite($a,$str,$length);
		// fclose($a);
	
		// $a = mail("2694177727@qq.com","123","123123");
		// halt($a);
		// $a = send_mail("2262649839@qq.com","2694177727@qq.com","123","123123");
		// // require_once("../vendor/PHPMailer/src/Exception.php");
		// // $ex = new \PHPMailer\PHPMailer\Exception;
		// halt($a);


		// $csvfile = "C:\Users\Administrator\Desktop\wt_withdraw.json";
		// $contents = csv_get_lines($csvfile,230);
		// dump($contents);

	}
	public function test2(){
		$redis = new Redis;
		$a = $redis->redis_pop('name2');//根据储存的为用户ID还是手机号来区分如何进行操作,后期可以进行操作.
		$data = db('test_redis')->find();
		// echo $val;exit;
		$val = $data['num']-1;
		if($val<=0){
			return "未存货";
		}else{
			db('test_redis')->where('id',$data['id'])->update(['num'=>$val]);
			return  "成功";
		}
		
	}
	public function open_json(){
		// $path="C:\Users\Administrator\Desktop\wt_withdraw.json";
		// $fp = fopen($path, 'r');
		// $contents = fread($fp, filesize($path));
		// $data = [];
		// $contents = json_decode($contents);
		// dump($contents);
		// foreach ($contents as $key => $value) {

	
		// }
		// dump($data);
	

		
		// export_csv($wt_withdraw);

		$jsonfile = "C:\Users\Administrator\Desktop\wt_member.json";

		$fp = fopen($jsonfile,'r');
	 	$contents = fread($fp, filesize($jsonfile));
		fclose($fp);
		$test = json_decode($contents);
		// dump($test);exit;
		// export_csv($data);
		$data = [];
		foreach ($test as $key => $value) {
				
				foreach ($value as $k => $v) {
					if ($k=="member_group_id") {
						switch ($v) {
						case '1':
							$data[$key][$k] = "普通会员";
							break;
						case '2':
							$data[$key][$k] = "VIP会员";
							break;
						case '6':
						$data[$key][$k] = "分销商";
						break;
						case '7':
						$data[$key][$k] = "代理商";
						break;
						case '8':
							$data[$key][$k] = "城市合伙人";
							break;
						default:
							$data[$key][$k] = $v;
							break;
					}
					}else{
						$data[$key][$k] = $v;
					}
					
						
					
					
				}
		}
		// dump($data);exit;
		export_csv($data);

	}
	public function csv(){
		$csvfile = "C:\Users\Administrator\Desktop\下级.csv";
		$csvfile2 = "C:\Users\Administrator\Desktop\wt_member.json";
		$a = csv_get_lines($csvfile,1727);


		$fp = fopen($csvfile2,'r');
	 	$contents = fread($fp, filesize ($csvfile2));
		fclose($fp);
		$member = json_decode($contents);
		
		$data=[];
		// $data2=[];
		for($i=0;$i<1727;$i++){
			$data[$i]['relation_id']=$a[$i][0];
			$data[$i]['relation_member_id']=$a[$i][1];
			$data[$i]['relation_parent_id']=$a[$i][2];
			for ($j=0; $j < 1772; $j++) { 
				if ($a[$i][2]==$member[$j]->member_id) {
					$data[$i]['member_mobile']=$member[$j]->member_mobile;
					$data[$i]['member_from'] = $member[$j]->member_from;
					$data[$i]['member_nick'] = $member[$j]->member_nick;
					
				}
				if ($a[$i][1]==$member[$j]->member_id) {
					$data[$i]['relation_member_mobile']=$member[$j]->member_mobile;
					$data[$i]['relation_member_from'] = $member[$j]->member_from;
					$data[$i]['relation_member_nick'] = $member[$j]->member_nick;
					
				}
			}

				
			
			
		}
		// dump($data);exit;
		export_csv($data);
		// dump($json);exit;
		// for ($i=0; $i < 1773; $i++) { 
		// 	$data2[$i]['member_id'] = $member[$i][0];
		// 	$data2[$i]['member_nick'] = $member[$i][1];
		// 	$data2[$i]['member_mobile'] = $member[$i][2];
		// }


		// foreach ($data as $key => $value) {
		// 	dump($value);
		// }

	}
	public function  APIbankCard($bankcard,$idcard,$name){

	$host = "https://bcard3and4.market.alicloudapi.com";
    $path = "/bank3Check";
    $method = "GET";
    $appcode = "528c4b1f67024440b855f41dbb9c77c0";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "accountNo=".$bankcard."&idCard=".$idcard."&name=".$name;
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $out_put = curl_exec($curl);
    echo $out_put;
	}

	


	


	public function APIbankCard4(){
	header("Content-type: text/html; charset=utf-8");
	//接口地址
	$url = 'https://aliyun-bankcard4-verify.apistore.cn/bank4';
	//appcode查看地址 https://market.console.aliyun.com/imageconsole/
	$appCode = '528c4b1f67024440b855f41dbb9c77c0';

	$params['bankcard'] = '6217921761483190';
	$params['realName'] = '张旺旺';
	$params['cardNo'] = '370125199603232319';
	$params['Mobile'] = '15964550565';
	//发送远程请求;
	$result = self::APISTORE($url, $params, $appCode, "GET");
	var_dump("<pre>");
	var_dump($result);
	//返回结果
	if ($result['error_code'] == 0)
	{
	    echo $result['reason']; //信息一致
	}
	else
	{
	    echo $result['reason'];  //信息不一致
	}
	} 	

/**
 * APISTORE 获取数据
 * @param $url 请求地址
 * @param array $params 请求的数据
 * @param $appCode 您的APPCODE
 * @param $method
 * @return array|mixed
 */
 public function APISTORE($url,$params = array(),$appCode,$method = "GET")
{
	
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $method == "POST" ? $url : $url . '?' . http_build_query($params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization:APPCODE ' . $appCode
    ));
    //如果是https协议
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //CURL_SSLVERSION_TLSv1
        curl_setopt($curl, CURLOPT_SSLVERSION, 1);
    }
    //超时时间
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //通过POST方式提交
    if ($method == "POST") {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    }
    //返回内容
    $callbcak = curl_exec($curl);
    //http status
    $CURLINFO_HTTP_CODE = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //关闭,释放资源
    curl_close($curl);
    //如果返回的不是200,请参阅错误码 https://help.aliyun.com/document_detail/43906.html
    if ($CURLINFO_HTTP_CODE == 200)
        return json_decode($callbcak, true);
    else if ($CURLINFO_HTTP_CODE == 403)
        return array("error_code" => $CURLINFO_HTTP_CODE, "reason" => "剩余次数不足");
    else if ($CURLINFO_HTTP_CODE == 400)
        return array("error_code" => $CURLINFO_HTTP_CODE, "reason" => "APPCODE错误");
    else
        return array("error_code" => $CURLINFO_HTTP_CODE, "reason" => "APPCODE错误");
}

//短信验证码发送

//https://market.aliyun.com/products/56928004/cmapi023305.html?spm=5176.730005.productlist.d_cmapi023305.55E4yJ#sku=yuncode1730500007
public function PhoneCode($mobile){
	$host = "http://dingxin.market.alicloudapi.com";
    $path = "/dx/sendSms";
    $method = "POST";
    $appcode = "528c4b1f67024440b855f41dbb9c77c0";
    $code = '1234';
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "mobile=".$mobile."&param=code:4567&tpl_id=TP1711063";
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    var_dump(curl_exec($curl));
}

    

}

