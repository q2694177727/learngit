<?php
namespace app\index\controller;
use think\Controller;
/**
 * 
 */
class Ajax extends Controller
{
	
	//文章中的点击喜欢
    /*
        后期如果想每个用户只能喜欢一次的话,将前台的用户id传到后台再进行判断是否点过喜欢,如果点过则返回[error=>500,data=>原因],然后前台可以进行alert 弹出或者其他操作
    */
    public function updown($id){
        //调用别人的接口
        // $time1 = microtime(true);
        $arr = IPandADDress();
        // $time2 = microtime(true);
        // $time = [];

        
        // halt($arr);
        $test = db('message_down')->where('article_id',$id)->where('down_ip',$arr['ip'])->find();
        if(empty($test)){
            $updata['down_ip'] = $arr['ip'];
            $updata['down_address'] = $arr['address'];
            $updata['article_id'] = $id;
            db('message_down')->insert($updata);
            $article = new \app\admin\model\Article;
            $article = $article->get($id);
            $down = $article->down;
            //获取当前喜欢数
            $article->down = $down+1;
            //喜欢数加一
            
            $article->save();
            //上传到数据库
            // halt($res);
            // halt($data);

            //返回值
            $res = ['success'=>$down+1];
        // $time3 = microtime(true);
        
        // $time[] = $time3-$time2;
        }else{
            $res = ['error'=>"已经点过赞了!"];
        }
        // $time[] = $time2-$time1;
        // halt($time);

        return $res;
    }




    //阅读数
    public function read($id){
    	$data = db('article')->where('article_id',$id)->find();
    	$read = $data['read']+1;
    	$res = db('article')->update(['article_id'=>$data['article_id'],'read'=>$read]);
    	if($res){
    		return  ['success'=>200,'data'=>$read];
    	}else{
    		return 	['error'=>500];
    	}
    }

    //文章评论
    /*
        $id   int   文章ID
    */
    public function message($id){
        // halt(input());
        // echo '123';
        // if(strlen(input('message'))<3){
        //     return $this->redirect('index/info',['id'=>$id]);
        // }
        $arr = IPandADDress();
        $message = [];
        //屏蔽词
        $mess = input('message');
        $shield = db('shield')->find();
        $shield = explode('|',$shield['shield_con']);
        foreach ($shield as $key => $value) {
            $mess = str_replace($value,"**",$mess);
        }
        // halt($mess);
        $message['content_describe']=$mess;
        $message['article_id']=$id;
        $message['message_ip']=$arr['ip'];
        $message['message_ress']=$arr['address'];
        // halt($arr);
        $floor = db('message_content')->where('article_id',$id)->order('floor_id desc')->limit(1)->value('floor_id'); 
        //判断是否为第一楼
        if(empty($floor)){
            $message['floor_id']=1;
            

        }else{
            $message['floor_id']=$floor+1;
        }

        //判断是否为回复楼层
        if(empty(input('floor_id'))){
            $message['reply_floor_id']=0;
        }else{
            $message['reply_floor_id']=input('floor_id');
        }
        

        db('message_content')->insert($message);

        return $this->redirect('index/info',['id'=>$id]);
    }
    public function upmessage(){
        // dump(input());
        $data['message_name']=input('username');
        $data['message_email']=input('email');
        $data['message_cont']=input('message');
        db('message')->insert($data);
        $this->redirect('index/index');
    }


}