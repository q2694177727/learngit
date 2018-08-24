<?php
namespace app\index\controller;
use think\Controller,Db,Model;
// use app\admin\model;
class Index extends Controller
{
    public function index()
    {
        $column = self::head();

        //关联两个表的数据
        $data = Db::name('article')->alias('a')->where('article_stats','1')->join('article_describe b','b.article_id = a.article_id')->order('a.add_time desc')->select();
        // halt($data);
        
        //找出对应的图片
        foreach ($data as $key => $value) {
            $arr = Db::name('article_pic')->where('describe_id',$value['describe_id'])->select();

            if(!empty($arr)){
                // dump($arr);
                $array = [];
                $i = 0;
                foreach ($arr as $k => $v) {
                    $array[] = $v['article_pic_dir'];
                    $i++;
                }
                $data[$key]['pic_count'] = $i;
                $data[$key]['pic_dir'] = $array;
            }else{
                $data[$key]['pic_count'] = 0;
            }
        }
        // dump($data);
        // exit;

        //轮播图
        $slide = db('pic_dir')->where('pic_type_id',1)->limit(5)->select();
        //轮播图侧边推荐位
        $slide_right = db('article')->alias('a')->order('a.article_sort desc')->join('article_describe d','d.article_id=a.article_id')->limit(2)->field('a.article_id,a.article_name,d.describe_id,a.type_id')->select();
        // halt($slide_right);
        //找到对应图片,如果找不到则从默认中抽出一条
        foreach ($slide_right as $key => $value) {
            $test = db('article_pic')->where('describe_id',$value['describe_id'])->find();
            if(!empty($test)){
                $slide_right[$key]['article_pic_dir'] = $test['article_pic_dir'];
            }else{
                $slide_right[$key]['article_pic_dir'] = db('pic_dir')->where('pic_type_id',2)->value('pic_dirname');
            }
            $arr = explode('.',$value['type_id']);
            if(isset($arr[1])){
                $slide_right[$key]['column_name'] = db('column_out')->where('column_out_id',$arr[1])->value('column_out_name');
            }else{
                $slide_right[$key]['column_name'] = db('column')->where('column_id',$arr[0])->value('column_name');
            }

        }
        //轮播图侧边推荐对应栏目

        // halt($column);
        // halt($data);
        $this->assign('slide',$slide);
        $this->assign('slide_right',$slide_right);
        $this->assign('column',$column);
        $this->assign('article',$data);


        
        self::right_fn();


        return view();
    }
    //系统分离模板↓↓↓↓↓↓↓
    public function header()
    {
        return view();
    }
    public function footer()
    {
        return view();
    }
    public function right()
    {
        return view();
    }
    //系统分离模板↑↑↑↑↑↑


    //right中需要使用到的东西
    public function right_fn(){
        //right中的内容
         //特别推荐栏
        $push = db('article_push')->alias('p')->join('article_pic pic','pic.article_pic_id = p.pic_id')->order('push_sort asc')->limit(3)->select();
        // halt($push);
        foreach ($push as $key => $value) {
            $push[$key]['type_id'] = db('article')->where('article_id',$value['article_id'])->value('type_id');            
        }
        //点击排行榜
        $arr = db('article')->order('read desc')->limit(5)->field('article_id,article_name,add_time,read,type_id')->select();
        // halt($arr);
        $pictest = db('article_pic')->alias('pic')->join('article_describe d','d.describe_id = pic.describe_id')->field('pic.article_pic_dir,d.article_id')->select();
        // halt($pictest);

        //点击排行榜默认的一张图片
        $dir = "default/images.jpg";
        foreach ($pictest as $k => $v) {

        
            foreach ($arr as $key => $value) {
                
                if($value['article_id']==$v['article_id']){
                    $arr[$key]['article_pic_dir']=$v['article_pic_dir'];
                }
            }
            //添加一个参数 rank[排名]
            
        }


        //对read参数进行排序,之前是乱的。
        $arr = sort_value($arr,'read');
        foreach ($arr as $key => $value) {
            if(empty($value['article_pic_dir'])){
                $arr[$key]['article_pic_dir']=$dir;
            }
            $arr[$key]['rank'] = 0;
        }

        //因为前台样式中第一个不一样,所以给第一个添加一个参数 rank[排名]
        $arr[0]['rank'] = 1;
        // halt($arr);  
      
        //推荐文章
        $commend = db('article')->where('article_stats','1')->where('article_push','1')->order('article_sort desc')->limit(5)->field('article_id,article_name,add_time,type_id')->select();
        //默认的一张图片
        $dir = db('pic_dir')->where('pic_type_id',2)->value('pic_dirname');
        foreach ($pictest as $k => $v) {

        
            foreach ($commend as $key => $value) {
                
                if($value['article_id']==$v['article_id']){
                    $commend[$key]['article_pic_dir']=$v['article_pic_dir'];
                }
            }
            //添加一个参数 rank[排名]
            
        }
        //添加一个参数,使第一名凸显出来
        foreach ($commend as $key => $value) {
            if(empty($value['article_pic_dir'])){
                $commend[$key]['article_pic_dir']=$dir;
            }
            $commend[$key]['rank'] = 0;
        }
        $commend[0]['rank'] = 1;
        // halt($commend);

        //标签云
        $tags = db('article_type')->select();

        //微信二维码
        $wxpic = db('pic_dir')->where('pic_type_id',6)->value('pic_dirname');

        $this->assign('wxpic',$wxpic);
        $this->assign('tags',$tags); //标签云
        $this->assign('commend',$commend);//普通推荐
        $this->assign('read',$arr);//点击排行榜
        $this->assign('push',$push);//特别推荐
    }

    //文章页下相关文章
    /*
        article_id  int     文章ID
        type        int     根据什么来判断相关文章,1标签,2栏目
    */

    public function RelevantArticle($id,$type=1){

        //标签相关文章
        if($type==1){
            //找到该文章的标签ID
            $tags_id_arr = db('article')->alias('a')->where('a.article_id',$id)->join('article_type_tags t','t.article_id=a.article_id')->field('t.type_id')->select();
            $tags_id = [];
            foreach ($tags_id_arr as $key => $value) {
                $tags_id[]=$value['type_id'];
            }
            $data = db('article_type_tags')->alias('t')->join('article a','a.article_id=t.article_id')->where('t.type_id','in',$tags_id)->group('t.article_id')->field('t.article_id,a.article_name,a.article_sort')->select();
            
            // halt($data);
        }
        //栏目相关文章
        if($type==2){
            $colid = db('article')->where('article_id',$id)->value('type_id');
            $colids = explode('.',$colid);
            //是否为二级栏目下的内容
            if(isset($colids[1])){
                $data = db('article')->where('type_id',$colid)->group('article_id')->field('article_id,article_name,article_sort')->select();
            }else{
                //如果不是二级栏目下的,则将此主栏目下的所有文章显示,包括二级栏目。
                
                
                $col = db('column_out')->where('column_id',$colid)->select();
                $data = [];
                foreach ($col as $key => $value) {
                    $testid = $colid.".".$value['column_out_id'];
                    $data = db('article')->where('type_id',$testid)->field('article_id,article_name,article_sort')->select();
                    
                }
                
                $test = db('article')->where('type_id',$colid)->field('article_id,article_name,article_sort')->select();
                $arr = [];
                foreach ($test as $key => $value) {
                     array_push($data,$value);
                }
               
               
                // halt($data);

            }
            


        }
        foreach ($data as $key => $value) {
                if($value['article_id']==$id){
                    unset($data[$key]);
                }
            }

        return $data;

    }


    public function about()
    {   
        $column = self::head();
        $this->assign('column',$column);
        return view();
    }
    public function info($id)
    {   
        //相关文章
        if(empty(input('type'))){
             $aboutarticle = self::RelevantArticle($id);

             $type = 0;
             // echo '123';
        }else{
            $aboutarticle = self::RelevantArticle($id,input('type'));
            $type = input('type');
        }
        // halt($aboutarticle);

        $limit = 10;//相关文章中需要显示的个数


        $aboutarticle = sort_value($aboutarticle,"article_sort");
        $aboutarticle = page_arr($aboutarticle,$limit);


        // halt($aboutarticle);
        $this->assign('type',$type);
        $this->assign('about',$aboutarticle);
        $column = self::head();
        $article = new \app\index\controller\Article;
        $data = $article->article_list($id);
        
        // halt($column);
        // halt($data);
        $t_nav = explode('.',$data['type_id']);

        self::get_col($data['type_id']);
        // halt($a);
        $this->assign('column',$column);
        $this->assign('data',$data);

        //上一篇
        $prev = db('article')->alias('a')->where('article_stats','1')->where('a.add_time','>',$data['add_time'])->order('add_time asc')->limit(1)->join('article_describe d','a.article_id=d.article_id')->find();
        //下一篇
        $next = db('article')->alias('a')->where('article_stats','1')->where('a.add_time','<',$data['add_time'])->order('add_time desc')->limit(1)->join('article_describe d','a.article_id=d.article_id')->find();
        // halt($next);
        $this->assign('prev',$prev);
        $this->assign('next',$next);

        //标签云
        // dump($data);
        $tags = db('article_type_tags')->where('article_id',$data['article_id'])->alias('tags')->join('article_type t','tags.type_id=t.type_id')->select();
        // halt($tags);
        self::right_fn();

        //支付宝微信二维码
        $alipay['zfb'] = db('pic_dir')->where('pic_type_id',4)->value('pic_dirname');
        $alipay['wx']  = db('pic_dir')->where('pic_type_id',5)->value('pic_dirname');

        // 查看接口的反应速度

        /**
            经测试  两个接口中的另一个21秒响应时间启用
        */
        // $newtime = microtime(true);
        // echo $newtime;exit;
        //获取IP与地址
        // $ip_arr = get_IpAddress();
        //运行之后的时间
        // $outtime = microtime(true);
        // $time[0] = $outtime-$newtime;
        // echo $time;
        //获取留言表内容
        $message = db('message_content')->where('article_id',$id)->where('content_state',1)->select();
        //获取留言表回复的内容
        // halt($message);
        foreach ($message as $key => $value) {
            if(!empty($value['reply_floor_id'])){
                $test=db('message_content')->where('article_id',$id)->where('floor_id',$value['reply_floor_id'])->find();
                if(!empty($test)){
                    $message[$key]['reply']=$test;
                }else{
                    $message[$key]['reply']['content_state']=  2;
                }
                
            }
        }
        // halt($message);


        // exit;
        $this->assign('message',$message);
        // $this->assign('ip',$ip_arr);
        $this->assign('alipay',$alipay);
        $this->assign('tag',$tags);
        return view();
    }


    //文章 column 栏目需要的数据
    public function head(){
        //加载导航
        $column = db('column')->order('column_sort asc')->select();
        $column2 = db('column_out')->order('column_sort desc')->field('column_out_id,column_out_name,column_out_tags,column_id')->select();
        //转换二级栏目的数据,合并数据
        foreach ($column2 as $key => $value) {
            $column2[$key] = ['column_out_id'=>$value['column_id'],'column_name'=>"├".$value['column_out_name'],'column_id'=>($value['column_id'].'.'.$value['column_out_id']),'column_tags'=>$value['column_out_tags']];
        }

        $array['column1']=$column;
        $array['column2']=$column2;
        $arr = db('system')->field('system_key,system_val,system_default')->select();
        $system = [];
        foreach ($arr as $key => $value) {
            // halt($value);
            $system = array_merge($system,[$value['system_key']=>$value['system_val']]);
        }
        // halt($system);
        $this->assign('system',$system);

        return  $array;
    }
    //内容模板需要的栏目的内容
    public function get_col($column_id=0){
        // halt(input('column_id'));
        if(empty($column_id)){
                //获取栏目的内容
                // halt($clids);
                $clid = input('column_id');
                $clids=explode('.', $clid);

                if(isset($clids[1])){
                    $col = db('column')->alias('c')->join('column_out co','c.column_id=co.column_id')->where('c.column_id',$clids[0])->field('c.column_name,co.column_out_name,co.column_out_desc,co.column_out_tags,c.column_tags,c.column_id,co.column_out_id')->find();
                    $col['col_out']=1;//当前为二级
                    $col['column_out_id']= $col['column_id'].".".$col['column_out_id'];
                }else{
                    $col = db('column')->where('column_id',$clids[0])->find();
                    $col['col_out']=0;//当前为一级
                }
               

                // halt($col);
                
                $this->assign('col',$col);
                return $col;


            



        }else{

                //获取栏目的内容
                // halt($clids);
                $clid = $column_id;
                $clids=explode('.', $clid);

                if(isset($clids[1])){
                    $col = db('column')->alias('c')->join('column_out co','c.column_id=co.column_id')->where('c.column_id',$clids[0])->field('c.column_name,co.column_out_name,co.column_out_desc,co.column_out_tags,c.column_tags,c.column_id,co.column_out_id')->find();
                    $col['col_out']=1;//当前为二级
                    $col['column_out_id']= $col['column_id'].".".$col['column_out_id'];
                }else{
                    $col = db('column')->where('column_id',$clids[0])->find();
                    $col['col_out']=0;//当前为一级
                }
               

                // halt($col);
                
                $this->assign('col',$col);
                return $col;


        }
            
            
    }



    //内容页
    public function content(){
        //栏目列表内容
        $column = self::head();
        $this->assign('column',$column);
        //调用right需要用到的内容
        self::right_fn();
        // halt($column);
        self::get_col();


        //关联两个表的数据
        $data = Db::name('article')->alias('a')->where('article_stats','1')->join('article_describe b','b.article_id = a.article_id')->order('a.add_time desc')->select();
        // halt($data);
        
        //找出对应的图片
        foreach ($data as $key => $value) {
            $arr = Db::name('article_pic')->where('describe_id',$value['describe_id'])->select();

            if(!empty($arr)){
                // dump($arr);
                $array = [];
                $i = 0;
                foreach ($arr as $k => $v) {
                    $array[] = $v['article_pic_dir'];
                    $i++;
                }
                $data[$key]['pic_count'] = $i;
                $data[$key]['pic_dir'] = $array;
            }else{
                $data[$key]['pic_count'] = 0;
            }
        }
        // dump($data);
        // halt($data);


        
            //判断是否为数字
            $clid = input('column_id');
            $clids=explode('.', $clid);
            $arr = []; //当前栏目下的内容
            foreach ($data as $key => $value) {
                    $typeid = explode('.', $value['type_id']);
                    if(!isset($clids[1])){
                       if($clid == $typeid[0]){
                            $arr[]=$value;
                       }
                    }else{
                        if($clid==$value['type_id']){
                            $arr[]=$value;
                        }
                    }
                    
                }
            //总共多少条
            $total['count'] = count($arr);
            


            //分页显示
            $page = input('page')?input('page'):1;
            $limit = 10;

            //总共有多少页
            $total['page']  =   ceil($total['count']/$limit);

            //判断是否为正常的分页
            if($page>$total['page']){
                $page=$total['page'];
            }
            if($page<1){
                $page=1;
            }

            $arr = page_arr($arr,$limit,$page);
            // $this->assign('article',$arr);

            

            
            //上一页
            $total['pvre']  =   ($page-1)==0?$page:$page-1;
            //下一页  
            $total['next']  =   $page==$total['page']?$page:$page+1;
            //当前为第几页
            $total['nows']  =   $page;
            //判断是否有选择栏目
            if(input('column_id')){
                $total['column_id'] = input('column_id');
            }else{
                $total['column_id'] = "";
            }


            // dump($data);
            $this->assign('article',$arr);
            $this->assign('total',$total);
            // halt($arr);
            return view();
        }

    //时间轴的显示
    public function time(){
        $column = self::head();
        $this->assign('column',$column);

        //判断分页是否正常
        $test = db('article')->where('article_stats',1)->select();
        $pagecount = count($test);
        $page = input('page')?input('page'):1;
        $limit = input('limit')?input('limit'):25;
        $totalpage = ceil($pagecount/$limit);
        if($page>$totalpage){$page=$totalpage;}
        if($page<1){$page=1;}
        
        //文章的显示
        $article = db('article')->where('article_stats',1)->order('add_time desc')->page($page,$limit)->select();
        foreach ($article as $key => $value) {
            $article[$key]['add_time'] = date('Y-m-d',strtotime($value['add_time']));
        }
        // halt($article);
        $this->assign('article',$article);

        $tags = db('column')->where('column_tags','time')->find();
        $this->assign('tags',$tags);

        //分页显示
        //上一页
        $total['pvre']  =   ($page-1)==0?$page:$page-1;
        //下一页  
        $total['next']  =   $page==$totalpage?$page:$page+1;
        //当前为第几页
        $total['nows']  =   $page;
        //总共有多少条
        $total['count'] =   $pagecount;
        //总共多少页
        $total['totalpage'] =   $totalpage;

        if(!empty(input('limit'))){
            $total['limit'] = 1;
            $total['limits']= input('limit');
        }else{
            $total['limit']=0;
        }

        $this->assign('total',$total);

        return view();
    }

    public function tags(){
        $column = self::head();
        $this->assign('column',$column);
        self::get_col();

        $test = db('article_type')->select();
        $pages['count'] = count($test);
        $page = input('page')?input('page'):1;
        $limit = 8;
        $pages['totalpage'] = ceil($pages['count']/$limit);
        if($page<1){
            $page=1;
        }
        if($page>$pages['totalpage']){
            $page=$pages['totalpage'];
        }
        $pages['nows']=$page;
        $pages['column_id'] = input('column_id')?input('column_id'):0;
        $type = db('article_type')->page($page,$limit)->select();
        $this->assign('type',$type);

        $pages['next']=($page+1)>$pages['totalpage']?$page:$page+1;
        $pages['prev']=($page-1)<1?$page:$page-1;
        $this->assign('page',$pages);

        return view();
    }
    public function tags_list(){
        $column = self::head();
        $this->assign('column',$column);
        // self::get_col();
        $col = db('column')->where('column_tags','tags')->find();
        $tags = db('article_type')->where('type_id',input('tags'))->find();
        $col['column_tags_name'] = $tags['type_name'];
        $this->assign('col',$col);

        $data = db('article_type_tags')->alias('tag')->where('tag.type_id',input('tags'))->leftJoin('article a','a.article_id=tag.article_id')->order('a.article_sort asc')->group('a.article_id')->select();
        // halt($data);
        foreach ($data as $key => $value) {
            $test_pic = db('article_describe')->alias('d')->where('article_id',$value['article_id'])->join('article_pic pic','pic.describe_id=d.describe_id')->field('article_pic_dir')->find();
            // halt($test_pic);
            if($test_pic){
                $data[$key]['pic_dir'] = $test_pic['article_pic_dir'];
            }else{
                $data[$key]['pic_dir'] = "default/tags_list.jpg";
            }
        }


        //分页
        $page['tags'] = input('tags')?input('tags'):0;
        $page['count']= count($data);
        $page['nows'] = input('page')?input('page'):1;
        $page['limit'] = 16;
        $page['totalpage']=ceil($page['count']/$page['limit']);
        if($page['nows']<1){
            $page['nows']=1;
        }
        if($page['nows']>$page['totalpage']){
            $page['nows']=$page['totalpage'];
        }
        $page['next']=($page['nows']+1)>$page['totalpage']?$page['nows']:$page['nows']+1;
        $page['prev']=($page['nows']-1)<1?1:$page['nows']-1;
        $data = page_arr($data,$page['limit'],$page['nows']);
        // halt($col);

        $this->assign('article',$data);
        $this->assign('page',$page);
        

        return view();
    }
    public function message(){
        self::head();
        return view();
    
    }
        
}




