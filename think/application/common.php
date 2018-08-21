<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function totalstr($str){
	$len = strlen($str);
	$test= ['a','b','c','d','e','f','g','h','j','k','l','q','w','r','t','y','u','i','o','p','s','z','x','v','n','m'];
	
	$test=array_flip($test);
	$test=array_map(function($num){return $num=0;}, $test);
	
	for ($i=0; $i < $len; $i++) { 
		
			foreach ($test as $key => $value) {
				if($key==$str[$i]){
				$test[$key]=$test[$key]+1;
				}
			}
	}
	$test = array_filters($test);
	return $test;
}

//删除数组中的空数组
function array_filters($arr){
	foreach ($arr as $key => $value) {
		if(empty($value)&&$value==0 ){
			unset($arr[$key]);
		}
	}
	return $arr;
}



//csv导入
function csv_get_lines($csvfile, $lines, $offset = 0) {
 if(!$fp = fopen($csvfile, 'r')) {
    return false;
 }
 $i = $j = 0;
    while (false !== ($line = fgets($fp))) {
        if($i++ < $offset) {
            continue; 
        }
        break;
    }
    $data = array();
    while(($j++ < $lines) && !feof($fp)) {
        $data[] = fgetcsv($fp);
    }

    fclose($fp);
    foreach ($data as $key => $value) 
    {
        foreach ($value as $k => $val)
        {   
            dump($value[$k]);
            // $value[$k]=iconv('utf-8','gb2312//IGNORE',$value[$k]);
        }

    }
 return $data;
}


//csv导出
function export_csv($data)
{
    $string="";
    foreach ($data as $key => $value) 
    {
        foreach ($value as $k => $val)
        {	
        	// dump($value[$k]);
            $value[$k]=iconv('utf-8','gb2312//IGNORE',$value[$k]);
        }

        $string .= implode(",",$value)."\n"; //用英文逗号分开 
    }
    $filename = date('Ymd').'.csv'; //设置文件名
    header("Content-type:text/csv"); 
    header("Content-Disposition:attachment;filename=".$filename); 
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
    header('Expires:0'); 
    header('Pragma:public'); 
    echo $string; 
}


//修改
//$data  string  表名,省去前缀 
//$arr    array  数据
//ID在arr中一并传输过来,支持单条修改
function Update($data,$arr){
    if (!is_object($data)) {
        $data = model($data);
    }
    $data = $data->get($arr['id']);
    $data->data($arr);
    return $data->save();
}

//删除
//$data  string  表名,省去前缀 
//$id    int    
//删除单挑数据
function Delete($data,$id){
    if (!is_object($data)) {
        $data = model($data);
    }
    $data = $data->get($id);
    // halt($id);
    return $data->delete();
}

//添加
//$data  string  表名,省去前缀 
//$arr    array  数据
function Insert($data,$arr){
    if (!is_object($data)) {
        $data = model($data);
    }
    dump($arr);
    $data->data($arr);
    return $data->save();
}

//加密管理员密码
function en_pass($pass){
    $pass = md5($pass);
    $pass = base64_encode($pass);
    return $pass;

}



//解密管理员密码
// function de_pass($pass){
// $pass = base64_decode($pass);
// }


//取文件后缀名
/*
    $name  string  文件名
*/
function get_ext($name){
    $arr = explode('.',$name);
    $len = count($arr);
    return $arr[$len-1];
}


/*
    图片上传的tokey值
    唯一
*/
function tokey_get(){
    $str = ""; //token值
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";//随机字符
    $len=8;//获取随机字符次数
    $ch_key="";//随机字符串 
    for ($i=0; $i < $len; $i++) { 
         $ch_key .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    // $ch_key="FWaAQ02";
    $mic = microtime(true);
    $arr = explode('.', $mic);
    // end($arr);
    $str = $ch_key.end($arr).substr(time(),-4);
    return $str;


}

//点击排行榜中的排序
/*
    $arr  array   传入二维数组
    $value string  二维数组中要排序的数
*/
function sort_value($arr,$value){
    array_multisort($arr);
    // halt($arr);
    // $data = '';
    foreach ($arr as $k => $v) {
        for($i=0;$i<count($arr)-1;$i++)
        {   $test = $arr[$i];
            if ($test[$value]<$arr[$i+1][$value]) {
                $arr[$i]=$arr[$i+1];
                $arr[$i+1]=$test;
            }
        }
        
    }
    return $arr;

}


//判断是否为数字
function is_num($str){
    if(is_int($str) || is_numeric($str)){
        return true; 
    }else{
        return false;
    }
}

//数组中的分页显示
function page_arr($arr,$limit=10,$page=1){
    $test = [];
    $i = 0;
    foreach($arr as $key => $value){
        if($i<$limit){
            if(($page-1)*$limit<=$key && $key<$limit*$page){
                $i++;
                // echo $key;
                $test[] = $value;
            }
            
        }
        
        
    }
    return $test;
}




//获取IP与地址
function get_IpAddress(){
            $host = "http://ip.chinaz.com/getip.aspx";
            $method = "GET";
            $curl = curl_init();
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $host);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$".$host, "https://"))
            {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            $out_put = curl_exec($curl);
            $out_puts = explode("'", $out_put);
            // halt($out_put);
            if(isset($out_puts['1'])){
                $arr = ['ip'=>$out_puts['1'],'address'=>$out_puts[3]];
            }else{
                $arr = $out_put;
            }
           

            // dump($arr);
            return $arr;
            // echo $out_put;
            // echo '123';
}

function getIpPlace(){  
    $ip=file_get_contents("http://fw.qq.com/ipaddress");  
    $ip=str_replace('"',' ',$ip);  
    $ip2=explode("(",$ip);  
    $a=substr($ip2[1],0,-2);                 
    $b=explode(",",$a);  
    return $b;  
    }  


//获取客户端 IP
function getIPaddress(){
    $IPaddress='';
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $IPaddress = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $IPaddress = getenv("HTTP_CLIENT_IP");
        } else {
            $IPaddress = getenv("REMOTE_ADDR");
        }
    }
    return $IPaddress;
}


//调用淘宝IP的API接口查询  返回省+信息
function taobaoIP($clientIP){
        $taobaoIP = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$clientIP;
        $IPinfo = json_decode(file_get_contents($taobaoIP));
        $province = $IPinfo->data->region;
        $city = $IPinfo->data->city;
        $data = $province.$city;
        return $data;
    }


//对两个查找IP的接口进行整合
function IPandADDress(){
    $arr = get_IpAddress();
        //如果失败了则调用淘宝API
    if(!is_array($arr)){
        $arr= [];
        $arr['ip'] = getIPaddress();
        $arr['address'] =  taobaoIP($arr['ip']);
    }
    return $arr;
}