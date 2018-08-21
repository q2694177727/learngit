-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2018 �?08 �?21 �?08:58
-- 服务器版本: 5.5.53
-- PHP 版本: 7.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--
CREATE DATABASE `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- 表的结构 `bg_article`
--

CREATE TABLE IF NOT EXISTS `bg_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `article_name` varchar(255) NOT NULL COMMENT '标题',
  `article_asname` varchar(255) NOT NULL COMMENT '别名',
  `type_id` varchar(20) NOT NULL COMMENT '列表id',
  `message_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '是否可以留言,0为不可以,1为可以',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `read` varchar(255) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `down` varchar(255) NOT NULL DEFAULT '0' COMMENT '点赞量',
  `article_sort` int(11) NOT NULL COMMENT '排序',
  `article_key` varchar(255) NOT NULL COMMENT '关键词',
  `article_stats` int(11) NOT NULL DEFAULT '1' COMMENT '0为冻结',
  `article_push` int(11) NOT NULL DEFAULT '0' COMMENT '推荐栏目,1为开启',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章表' AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `bg_article`
--

INSERT INTO `bg_article` (`article_id`, `article_name`, `article_asname`, `type_id`, `message_status`, `add_time`, `read`, `down`, `article_sort`, `article_key`, `article_stats`, `article_push`) VALUES
(23, '测试添加文章 使用模型12', '删除全部的图后开始测试添加文章', '8', 1, '2018-07-20 11:13:34', '44', '6', 51, '', 1, 1),
(24, '测试事物 ID23', '删除全部的图后开始测试添加文章', '8', 1, '2018-07-20 11:14:18', '18', '1', 52, '测试事物 ID23', 1, 1),
(28, '测试图片多张', '测试图片多张', '8', 1, '2018-07-20 11:38:40', '16', '1', 50, '测试图片多张', 1, 1),
(37, '123', '', '9', 1, '2018-07-20 15:00:05', '200', '11', 50, '', 1, 1),
(38, '测试123', '测试', '9', 1, '2018-07-20 15:00:42', '22', '11', 50, '测试多张图片上传到库', 1, 0),
(39, '测试两张图', '测试两张图', '8', 1, '2018-07-20 16:44:48', '10', '0', 50, '测试两张图', 1, 1),
(40, '如何成为一个内心强大的人？', '如何成为一个内心强大的人？', '8.1', 1, '2018-07-20 17:13:31', '132', '10', 100, '内心强大,人', 1, 1),
(44, '测试', '测试测试', '8.1', 1, '2018-07-23 16:09:47', '33', '2', 50, '测试测试测试测试测试', 1, 0),
(60, '标签测试修改', '标签测试修改', '8', 1, '2018-07-23 17:44:38', '7', '1', 50, '标签测试修改', 1, 0),
(61, '测试一下栏目显示', '测试一下栏目显示', '8', 1, '2018-07-24 15:13:05', '29', '3', 60, '测试一下栏目显示', 1, 0),
(62, '测试文章图片', '测试文章图片', '9.2', 1, '2018-07-27 09:57:28', '66', '5', 50, '测试文章图片', 1, 1),
(66, '从windows上把thinkphp项目移动到linux下', 'thinkphp上传linux的注意事项', '8.1', 1, '2018-08-04 09:48:30', '17', '3', 100, 'Linux、php', 1, 1),
(67, 'GIT分支系统的使用', 'git分支系统', '8.1', 1, '2018-08-21 16:47:39', '1', '0', 50, 'git、远程分支、github', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bg_article_describe`
--

CREATE TABLE IF NOT EXISTS `bg_article_describe` (
  `describe_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `describe_content` text NOT NULL COMMENT '文章内容',
  `describe_as_con` varchar(200) NOT NULL COMMENT '简介',
  `pic_state` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示图片,0为不显示,1为显示',
  `describe_update` datetime NOT NULL COMMENT '修改时间',
  `describe_author` varchar(255) NOT NULL COMMENT '作者',
  `article_id` int(11) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`describe_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章内容表' AUTO_INCREMENT=62 ;

--
-- 转存表中的数据 `bg_article_describe`
--

INSERT INTO `bg_article_describe` (`describe_id`, `describe_content`, `describe_as_con`, `pic_state`, `describe_update`, `describe_author`, `article_id`, `addtime`) VALUES
(20, '<h1>Hello world!删除全部的图后开始测试添加文章删除全部的图后开始测试添加文章删除全部的图后开始测试添加文章12312312312312</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '																																								删除全部的图后开始测试添加文章																																', 0, '2018-07-27 10:18:40', '', 23, '2018-07-20 03:13:34'),
(23, '<h1>Hello world!测试事物 ID23测试事物 ID23测试事物 ID23测试事物 ID23测试事物 ID23测试事物 ID23</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.测试事物 ID23测试事物 ID23测试事物 ID23</p>\r\n', '测试事物 ID23', 0, '0000-00-00 00:00:00', '测试事物 ID23', 24, '2018-07-20 03:14:18'),
(24, '<h1>Hello world!测试图片多张测试图片多张</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.测试图片多张测试图片多张</p>\r\n', '					测试图片多张				', 0, '2018-07-20 15:01:49', '测试图片多张', 28, '2018-07-20 03:38:40'),
(33, '<h1>Hello world!</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '																		', 0, '2018-07-20 18:03:23', '', 37, '2018-07-20 07:00:05'),
(34, '<h1>Hello world!</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.测试测试</p>\r\n', '																																													', 0, '2018-07-20 15:40:14', '测试', 38, '2018-07-20 07:00:43'),
(35, '<h1>Hello world!</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.测试两张图</p>\r\n', '测试两张图', 0, '0000-00-00 00:00:00', '测试两张图', 39, '2018-07-20 08:44:48'),
(36, '<p>弱者普遍易怒如虎，而且容易暴怒。强者通常平静如水，并且相对平和。一个<a href="http://www.duwenzhang.com/huati/neixin/index1.html">内心</a>不强大的人，自然内心不够平静。内心不平静的人，处处是风浪。再小的事，都会被无限放大。一个内心不强大的人，心中永远缺乏安全感。</p>\r\n\r\n<p><a href="http://www.duwenzhang.com/wenzhang/lizhiwenzhang/20160831/358520.html"><img alt="如何成为一个内心强大的人？" src="http://www.duwenzhang.com/upimg/160831/1_160416.jpg" style="float:right; height:284px; width:245px" /></a>　　不够强大，意味着很容易受到外界的影响，通常表现为：要么特别在意别人的看法，要么活在他人的眼目口舌之中。从而<a href="http://www.duwenzhang.com/huati/shiqu/index1.html">失去</a>独立的判断能力，变得摇摆不定和坐立不安。</p>\r\n\r\n<p>　　要想成为一个内心强大的人，需要具备至少以下六大品质特征：1）高度自律和自黑；2）必须经历<a href="http://www.duwenzhang.com/huati/juewang/index1.html">绝望</a>；3）培养独处的能力；4）不设限的思考；5）需要一个信仰；6）BE YOURSELF（做自己）。</p>\r\n\r\n<p>　　1。 高度自律和自黑</p>\r\n\r\n<p>　　为什么不说<a href="http://www.duwenzhang.com/huati/zixin/index1.html">自信</a>呢？不自信的人，普遍内心比较<a href="http://www.duwenzhang.com/huati/cuiruo/index1.html">脆弱</a>。一个自信的人，对自己充满信心，做事往往带着积极向上的力量，并时刻充满激情。所有的盲目自信，和空腹自信，都是自以为是。心中要有真才实学，哪怕在不断的试错，但终究能到达攀登高峰的那一天。</p>\r\n\r\n<p>　　人的自信到底从何而来？以及如何培养自己的自信？高度的自信，从高度的自律而来。自律又是什么？自律就是自己管理自己，自己约束自己。这是一个很重要的能力。先学会克制自己，用严格的日程表来控制<a href="http://www.duwenzhang.com/wenzhang/shenghuosuibi/">生活</a>，才能在这种自律中不断磨练出自信。自信也代表着对事情的控制能力，连最基本的<a href="http://www.duwenzhang.com/huati/shijian/index1.html">时间</a>都控制不了，谈何自信？</p>\r\n\r\n<p>　　除了自律以外，自黑的能力也相当重要。世界之大，什么鸟都有。等你哪一天稍微做出点成绩，很多认识或不认识的人便在背后，唧唧歪歪的议论是非。从最开始的吐槽，到断章取义的论断甚至无趣的黑你。</p>\r\n\r\n<p>　　自黑就是自己嘲笑自己，自己黑色幽默自己。自黑是一种沟通方式，也是一种境界，更是一种另类的<a href="http://www.duwenzhang.com/wenzhang/renshengzheli/20080818/15697.html">修养</a>。自黑不是等到有人说你时才出现，而是从头到尾都需要有的能力。你必须看透那些<a href="http://www.duwenzhang.com/huati/wuliao/index1.html">无聊</a>恶俗的人，要比他们还会擅长黑自己，待他们自知无趣后，便会羞愧的退场而去。</p>\r\n\r\n<p>　　2。 必须经历绝望</p>\r\n\r\n<p>　　经历绝望的意思，就是已经走过这段岁月。也许你还未曾绝望过，并不意味着你不<a href="http://www.duwenzhang.com/huati/jianqiang/index1.html">坚强</a>，但一定没有经历过绝望的人坚强。未绝望过的<a href="http://www.duwenzhang.com/wenzhang/renshengzheli/">人生</a>是不<a href="http://www.duwenzhang.com/huati/wanmei/index1.html">完美</a>的人生。绝望可能是<a href="http://www.duwenzhang.com/">情感</a>、<a href="http://www.duwenzhang.com/huati/shiye/index1.html">事业</a>抑或无法面对的<a href="http://www.duwenzhang.com/huati/gudu/index1.html">孤独</a>等等。</p>\r\n\r\n<p>　　「必须」 是一个前缀词，一个重要的状态。「必须」并非主动选择，而是做好充分的心理准备。当绝望来临时，坦然无惧的接受它，即使当下极其<a href="http://www.duwenzhang.com/huati/tongku/index1.html">痛苦</a>，甚至失去了自我。在绝望中寻找<a href="http://www.duwenzhang.com/huati/xiwang/index1.html">希望</a>，才是值得体验的一种人生。</p>\r\n\r\n<p>　　强大的人不是征服什么，而是能承受什么。一些事情，只有经历过了，才能明白其中的道理，和懂得人生的真谛。绝望并不可怕，可怕的是失去<a href="http://www.duwenzhang.com/huati/yongqi/index1.html">勇气</a>和激情。经历绝望，但不要被绝望吞噬。相反你要胜过它，如同战胜黑暗，迎接光明一样。</p>\r\n\r\n<p>　　3。 培养独处的能力</p>\r\n\r\n<p>　　孤独和独处并不是一件事，是两码事，而且经常会被混淆。人们往往把交往看作一种能力，却忽略了独处也是一种能力，并且在一定意义上是比交往更为重要的一种能力。如果说不擅交际是一种<a href="http://www.duwenzhang.com/huati/xingge/index1.html">性格</a>的弱点，那么，不耐孤独就简直是一种<a href="http://www.duwenzhang.com/huati/linghun/index1.html">灵魂</a>的缺陷了。</p>\r\n\r\n<p>　　要耐得住<a href="http://www.duwenzhang.com/huati/jimo/index1.html">寂寞</a>，不随波逐流。<a href="http://www.duwenzhang.com/huati/gudan/index1.html">孤单</a>是一个人的狂欢，狂欢是一群人的孤单。所谓的<a href="http://www.duwenzhang.com/huati/chengshu/index1.html">成熟</a>，就是你越长大，越能学会一个人适应一切。在独处的时光中，找到自己真正热爱的，并培养自己独立的判断能力。</p>\r\n\r\n<p>　　人只有先学会爱自己，才有能力爱他人。如果你不学着与自己对话，便更难和别人交流。越能独处的人，越能面对和理解困境，也越能与他人相处。因为能瞬间换位思考，更能设身处地为对方着想。</p>\r\n\r\n<p>　　4。 不设限的思考</p>\r\n\r\n<p>　　你的眼光要比别人远，你的心胸要比他人宽广。天天算计的人生，未来迟早也会被人生算计。除此以外，还活在各种小心眼和小格局之中。</p>\r\n\r\n<p>　　人生如同开车一样，当你比别人快30码，你体会到的感受别人无法感知。人生又如同开飞机，当你比别人高30000英尺，你看到的视野自然不同于他人。意思就是，当你在<a href="http://www.duwenzhang.com/huati/zhuiqiu/index1.html">追求</a>更高更远的美景时，也就不必在意他人短视的眼目。一切自然云淡风轻，不再受影响。</p>\r\n\r\n<p>　　宽阔之后，就不会受狭隘主义的捆绑。<a href="http://www.duwenzhang.com/huati/ziyou/index1.html">自由</a>之后，就不会受形式主义的限制。</p>\r\n\r\n<p>　　5。 需要一个信仰</p>\r\n\r\n<p>　　人实在太有限，不论你信仰什么，总归要有一个信仰，否则和动物无任何区别。</p>\r\n\r\n<p>　　在这个时代，几乎人人都有信仰，只是各自的信仰不同而已。有人信仰权力，有人信仰<a href="http://www.duwenzhang.com/huati/jinqian/index1.html">金钱</a>，有人信仰自我，有人信仰<a href="http://www.duwenzhang.com/wenzhang/aiqingwenzhang/">爱情</a>，有人信仰<a href="http://www.duwenzhang.com/huati/xingfu/index1.html">幸福</a>，有人信仰美食，有人信仰党派，有人信仰制度，有人信仰无神，有人信仰有神，有人信仰多神，有人笃信基督&hellip;&hellip;</p>\r\n\r\n<p>　　不管什么样的信仰，都令人值得尊重，而且任何信仰都需要深入了解并<a href="http://www.duwenzhang.com/huati/xiangxin/index1.html">相信</a>，才能称之为信仰。任何一种信仰，如果是稀里糊涂的信，都称不上信仰，属于迷信，包括基督教在内的所有宗教信仰。</p>\r\n\r\n<p>　　智慧和真理，有着天与地的距离。学会渴慕真理胜过追求智慧。真理能使人更有智慧的来看待世间万物，<a href="http://www.duwenzhang.com/huati/kuanrong/index1.html">宽容</a>的<a href="http://www.duwenzhang.com/huati/taidu/index1.html">态度</a>面对错综复杂的人际关系，无比坚定的<a href="http://www.duwenzhang.com/huati/xinnian/index1.html">信念</a>奔走人生之路，从容淡定的直面<a href="http://www.duwenzhang.com/huati/renxing/index1.html">人性</a>的黑暗和世间的悲剧。</p>\r\n\r\n<p>　　6。 BE YOURSELF（做自己）</p>\r\n\r\n<p>　　JUST BE YOURSELF。 不要试图取悦所有人，现在做不到，未来也做不到。</p>\r\n\r\n<p>　　人不可能面面俱到。每个人应该会有自己最在乎的人，他们才是你<a href="http://www.duwenzhang.com/huati/shengming/index1.html">生命</a>中最宝贵的财富。倘若他们对你所做的事有误解或质疑，值得你花时间去回应和解释。</p>\r\n\r\n<p>　　以下是个人最在乎的三类群体，仅供参考：1、家人（亲戚不算在内，一年到头只见一回，并不清楚你的人生定位）；2、人生<a href="http://www.duwenzhang.com/huati/zhiji/index1.html">知己</a>（为数不多的真正挚友，一切都知根知底）；3、牧师或导师（属灵上的导师，和职场中的前辈引领者）。</p>\r\n\r\n<p>　　他们的评价/意见/建议，则会认真的聆听。若存在不理解时，一定会充分的解释和回应。只有真正在乎的人相对全面了解你，其他人大部分是片面的认知。在生活中也没有特别的交集，有的只是道听途说或仅仅是几面之缘而已。</p>\r\n\r\n<p>　　不必回应那些熟悉的陌生人，他们并不一定真正关心你，更多的只是好奇宝宝。时间如此宝贵，无暇顾及这些，也不在解释的义务范畴。你的人生并不需要活在他人的言语中，还有很多更重要的事等着去做。</p>\r\n\r\n<p>　　内心强大的人，很少在意他人的看法，包括熟悉的陌生人。就像积极的人很少关注消极的信息，即便看到，也自动瞬间被屏蔽或消化。他们很清楚自己的定位和追求。</p>\r\n\r\n<p>　　遇到了障碍，会想尽一切办法铲除。遇到了<a href="http://www.duwenzhang.com/huati/cuozhe/index1.html">挫折</a>，也不轻易<a href="http://www.duwenzhang.com/huati/fangqi/index1.html">放弃</a>倒下。克服了困难，便<a href="http://www.duwenzhang.com/huati/yongyou/index1.html">拥有</a>了力量。解决了问题，便拥有了智慧。走出了黑暗，便拥有了希望。对他们而言，这些仅仅是人生的必经之路。</p>\r\n\r\n<p>　　真正内心强大的人，一定有一颗平静的内心，有一颗温柔的心肠，有一颗智慧的头脑。一定经历过狂风暴雨，体验过高山低谷，也见识过人生百态。惟愿我们在人生的道路上，不论何种境遇都能充满智慧的刚强壮胆，成为内心强大的人。</p>\r\n\r\n<p>　　<a href="http://www.duwenzhang.com/">文章</a>来源 / 丹尼尔先生</p>\r\n\r\n<p>&nbsp;</p>\r\n', '																									弱者普遍易怒如虎，而且容易暴怒。强者通常平静如水，并且相对平和。一个内心不强大的人，自然内心不够平静。内心不平静的人，处处是风浪。再小的事，都会被无限放大。一个内心不强大的人，心中永远缺乏安全感。\r\n如何成为一个内心强大的人？　　不够强大，意味着很容易受到外界的影响，通常表现为：要么特别在意别人的看法，要么活在他人的眼目口舌之中。从而失去独立的判断', 0, '2018-07-28 09:33:32', '老王', 40, '2018-07-20 09:13:31'),
(40, '<h1>Hello world!测试测试测试测试测试测试测试测试测试</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '', 0, '0000-00-00 00:00:00', '测试测试测试测试', 44, '2018-07-23 08:09:47'),
(56, '<h1>Hello world!标签测试修改标签测试修改标签测试修改标签测试修改</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '标签测试修改标签测试修改标签测试修改标签测试修改', 0, '0000-00-00 00:00:00', '标签测试修改', 60, '2018-07-23 09:44:38'),
(57, '<h1>Hello world!测试一下栏目显示测试一下栏目显示测试一下栏目显示测试一下栏目显示</h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '测试一下栏目显示测试一下栏目显示测试一下栏目显示', 0, '0000-00-00 00:00:00', '测试宝宝', 61, '2018-07-24 07:13:05'),
(58, '<h1>Hello world!<a href="../file/upload/images.jpg"><img alt="" src="https://timgsa.baidu.com/timg?image&amp;quality=80&amp;size=b9999_10000&amp;sec=1532673839477&amp;di=9af29f74a10a0370311f8b30024ee712&amp;imgtype=0&amp;src=http%3A%2F%2Fb.hiphotos.baidu.com%2Fimage%2Fpic%2Fitem%2F960a304e251f95ca50958c64c5177f3e660952fb.jpg" /></a></h1>\r\n\r\n<p>I&#39;m an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>\r\n', '										测试文章图片测试文章图片测试文章图片测试文章图片测试文章图片测试文章图片测试文章图片测试文章图片								', 0, '2018-07-27 11:56:05', '测试', 62, '2018-07-27 01:57:28'),
(60, '<p>在Windows中的博客上传到linux下</p>\r\n\r\n<p>出现了很多问题.</p>\r\n\r\n<p>在一键安装过lnmp之后需要设置入口文件</p>\r\n\r\n<p>在/uer/nginx/conf/nginx.conf中设置入口文件</p>\r\n\r\n<p>设置入口文件之后进入localhost 成功 但是却显示的为空白页面,没有报错</p>\r\n\r\n<p>经过一系列的查找之后发现是包含thinkphp/base.php出现了问题.</p>\r\n\r\n<p>在网上查找之后知道了php中有个参数 open_basedir 限制目录</p>\r\n\r\n<p>最后发现在/uer/nginx/conf/fastcgi.conf 中 自动生成了一段话,使得出现了限制目录的情况.</p>\r\n\r\n<p>将一切搞定,首页正常显示,但是点击到其他栏目的时候报错404.</p>\r\n\r\n<p>百度之后发现nginx 上是没有phpinfo模式的,需要再配置</p>\r\n\r\n<p>在/uer/nginx/conf/nginx.conf中的server 中添加</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; location / {</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; //如果是资源文件，则不走phpinfo模式</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if (!-e $request_filename){</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; rewrite ^/(.*)$ /index.php?s=$1 last;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; }&nbsp;&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>重启lnmp后 成功,</p>\r\n', '					在Windows中的博客上传到linux下\r\n\r\n会出现很多问题.																																														', 0, '2018-08-04 10:32:56', '作者', 66, '2018-08-04 01:48:30'),
(61, '<p>首先</p>\r\n\r\n<p>$git init</p>\r\n\r\n<p>初始化git仓库</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>$git add 文件 &nbsp; &nbsp;</p>\r\n\r\n<p>上传文件到master分支或者其他分支,</p>\r\n\r\n<p>$git commit -m &quot;版本号&quot;</p>\r\n\r\n<p>-m 是必不可少的一个东西,可以使自己分清楚各个版本,个人喜欢使用时间或者时间+做的事 来进行处理</p>\r\n\r\n<pre>\r\n<code>$ git remote add origin git@github.com:q2694177727/learngit.git</code></pre>\r\n\r\n<p><code>或者</code></p>\r\n\r\n<p><code>$ git remote add origin https://github.com/q2694177727/learngit.git</code></p>\r\n\r\n<p><code>主要部分为 &nbsp; git remote add 远程库名 地址</code></p>\r\n\r\n<p><code>地址可以在github后台那找到</code></p>\r\n\r\n<p><code>之后就可以</code></p>\r\n\r\n<pre>\r\n<code>$ git push -u 远程库名 本地分支名称(</code>master<code>)</code></pre>\r\n\r\n<p><code>-u的作用为把本地分支 与 远程分支关联起来 在以后使用push的时候可以省略掉 &nbsp;直接 git push</code></p>\r\n\r\n<p>git push 中有个额外的参数为 -f 强制上传</p>\r\n\r\n<p>使用这个命令主要是因为 当时更新的时候 git push 报错 ,后来找到了这个命令.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '										使用git创建远程仓库，并进行一系列的使用								', 0, '2018-08-21 16:57:43', '作者', 67, '2018-08-21 08:47:39');

-- --------------------------------------------------------

--
-- 表的结构 `bg_article_pic`
--

CREATE TABLE IF NOT EXISTS `bg_article_pic` (
  `article_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_pic_dir` text NOT NULL COMMENT '图片路径',
  `article_pic_path` text NOT NULL COMMENT '图片路径',
  `describe_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应describe表',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`article_pic_id`),
  KEY `describe_id` (`describe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章图片' AUTO_INCREMENT=84 ;

--
-- 转存表中的数据 `bg_article_pic`
--

INSERT INTO `bg_article_pic` (`article_pic_id`, `article_pic_dir`, `article_pic_path`, `describe_id`, `creat_time`) VALUES
(2, '20180720/48d4a5df73c1ebd23a638a476e29b90e.jpg', '/home/wwwroot/default/blog/public/file/upload/', 20, '2018-07-20 03:13:34'),
(3, '20180720/d140112f934c07c96aa02a638a438c49.jpg', '/home/wwwroot/default/blog/public/file/upload/', 23, '2018-07-20 03:14:18'),
(4, '20180720/7bd2b4ec73ff1f69f8bdec240637f38f.jpg', '/home/wwwroot/default/blog/public/file/upload/', 24, '2018-07-20 03:38:40'),
(17, '20180720/d3e1aa2ab023e14cc8e860a874ce8994.jpeg', '/home/wwwroot/default/blog/public/file/upload/', 34, '2018-07-20 07:00:43'),
(18, '20180720/07f89e427633f2e7b7b5b5b5f780b047.jpg', '/home/wwwroot/default/blog/public/file/upload/', 34, '2018-07-20 07:00:43'),
(19, '20180720/dd6d3a26f6da41a2b758cf1e173ea23b.jpg', '/home/wwwroot/default/blog/public/file/upload/', 34, '2018-07-20 07:00:43'),
(20, '20180720/9b78facb6e110725bf0b748b5a030e3d.jpeg', '/home/wwwroot/default/blog/public/file/upload/', 35, '2018-07-20 08:44:48'),
(21, '20180720/5d403e3e79713d5bee411bab884cc1fa.jpg', '/home/wwwroot/default/blog/public/file/upload/', 35, '2018-07-20 08:44:48'),
(34, '20180720/ca76ccd8a3366a78b9ce81201e293126.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-20 10:00:55'),
(35, '20180720/6fdffa1add877dd46edae0cf073f849a.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-20 10:00:55'),
(36, '20180720/375e7325464509518371f2816d6dcbfd.jpg', '/home/wwwroot/default/blog/public/file/upload/', 33, '2018-07-20 10:03:23'),
(37, '20180720/7c9bb45fb000d701fdf9098225b6a824.jpg', '/home/wwwroot/default/blog/public/file/upload/', 33, '2018-07-20 10:03:23'),
(38, '20180721/df602a318ee0583e2b16260eb9ea1847.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 03:22:42'),
(39, '20180721/bc20462edfce7fa956944e96753a3e8d.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 03:23:15'),
(40, '20180721/edb21e5db6f2438e626bb78003ef78e4.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 03:27:27'),
(41, '20180721/48bf43b21f8b642f117a312b44e223f5.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 03:28:36'),
(43, '20180721/44e892cc41df3e194ae1675e42fbdbf5.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 06:53:35'),
(44, '20180721/222bae570d1391e1ebcb9afedc0ba638.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 06:54:46'),
(45, '20180721/0e407adce1d616a79ef28b594c8668ef.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 06:55:51'),
(47, '20180721/d52eef9e583f5200bd27fb4c27417772.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 06:59:31'),
(52, '20180721/5beddfff85d2f01ebbe47a9d50f2551e.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 07:12:22'),
(54, '20180721/aed03bae5ee2d781693d7e0aa893b98f.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 07:15:51'),
(55, '20180721/03bf16f3231a50215590416e96c8d7fc.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 07:15:56'),
(56, '20180721/f4d8ba0c7d0aadb0f0a174ea2d004b7c.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-07-21 07:33:47'),
(60, '20180723/15fa603e636ff76e47d034e1d1321e7d.jpg', '/home/wwwroot/default/blog/public/file/upload/', 40, '2018-07-23 08:09:47'),
(68, '20180723/2e1a24d49994af0cb10e966f98904ea9.jpg', '/home/wwwroot/default/blog/public/file/upload/', 56, '2018-07-23 09:44:38'),
(69, '20180724/e62a9dc134410aee99d14e5c32431014.jpg', '/home/wwwroot/default/blog/public/file/upload/', 57, '2018-07-24 07:13:05'),
(82, '20180727/91aefcbfc5138ba1ee331421d8d2c88d.jpg', '/home/wwwroot/default/blog/public/file/upload/', 58, '2018-07-27 03:54:55'),
(83, '20180804/f33117ce7fdca43c24ba500df00795d8.jpg', '/home/wwwroot/default/blog/public/file/upload/', 0, '2018-08-04 02:32:40');

-- --------------------------------------------------------

--
-- 表的结构 `bg_article_push`
--

CREATE TABLE IF NOT EXISTS `bg_article_push` (
  `article_push_id` int(11) NOT NULL AUTO_INCREMENT,
  `push_name` varchar(50) NOT NULL COMMENT '推荐标题',
  `pic_id` int(11) DEFAULT '0' COMMENT '如果有的话,对应图片栏',
  `article_id` int(11) NOT NULL COMMENT '对应的文章栏',
  `push_stats` int(11) NOT NULL COMMENT '是否开启,0为不开启,1为开启',
  `push_sort` int(11) NOT NULL COMMENT '排序',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`article_push_id`),
  KEY `article_id` (`article_id`),
  KEY `pic_id` (`pic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章特别推荐' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `bg_article_push`
--

INSERT INTO `bg_article_push` (`article_push_id`, `push_name`, `pic_id`, `article_id`, `push_stats`, `push_sort`, `creat_time`) VALUES
(1, '为什么为甚么测试', 40, 23, 1, 10, '2018-07-21 03:27:27'),
(2, '测试测试', 56, 24, 1, 50, '2018-07-21 03:28:36'),
(3, '测试测试测试', 52, 28, 1, 50, '2018-07-21 03:29:31'),
(4, '测试嗷嗷嗷啊啊啊 啊啊', 54, 37, 1, 50, '2018-07-21 06:57:15'),
(6, '测试ID38', 55, 38, 0, 50, '2018-07-21 07:03:01'),
(7, '在Linux下配置环境出现的问题', 83, 66, 1, 40, '2018-08-04 02:30:00');

-- --------------------------------------------------------

--
-- 表的结构 `bg_article_type`
--

CREATE TABLE IF NOT EXISTS `bg_article_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL COMMENT '类型名称',
  `type_desc` varchar(100) NOT NULL COMMENT '类型描述',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `type_color` varchar(20) NOT NULL COMMENT '颜色',
  `type_pic` text NOT NULL COMMENT '在标签栏目中显示的图片',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章标签' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `bg_article_type`
--

INSERT INTO `bg_article_type` (`type_id`, `type_name`, `type_desc`, `addtime`, `type_color`, `type_pic`) VALUES
(2, 'PHP', 'php基础', '2018-07-23 07:05:21', 'a2f124', '20180726\\da6357881d64aca36fc091adade3daa6.jpg'),
(3, '生活', '生活', '2018-07-23 07:47:39', 'ffc647', '20180726\\a824afd219fd9bfe37692259dca158f2.png'),
(4, 'css3', 'css3', '2018-07-23 07:48:23', 'b42562', '20180726\\91b37ebfd19d3487bf7f7cd67e2405b7.jpg'),
(5, 'JScript', 'JScript', '2018-07-23 07:48:33', '8e3c2e', '20180726\\49e738f939f7b05265ad51478dff7a8e.jpg'),
(6, '白羊', '白羊', '2018-07-23 07:49:29', 'baccb7', '20180726\\47f69e78964c04fdb8a6042db779b79a.jpg'),
(8, '天秤', '测试图片效果', '2018-07-25 09:54:05', '5ebc34', '20180726\\d4ca8dc65c6f5a3547f074cf03a57123.jpg'),
(9, 'Git', '分支系统', '2018-08-21 08:40:05', 'adc172', '20180821\\dc60c8e66d60e250b85110456c328a59.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `bg_article_type_tags`
--

CREATE TABLE IF NOT EXISTS `bg_article_type_tags` (
  `tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '对应article表',
  `type_id` int(11) NOT NULL COMMENT '对应article_type表',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间与更新时间',
  PRIMARY KEY (`tags_id`),
  KEY `article_id` (`article_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='文章标签表' AUTO_INCREMENT=76 ;

--
-- 转存表中的数据 `bg_article_type_tags`
--

INSERT INTO `bg_article_type_tags` (`tags_id`, `article_id`, `type_id`, `creat_time`) VALUES
(45, 40, 4, '2018-07-24 03:02:03'),
(46, 40, 3, '2018-07-24 03:02:30'),
(48, 61, 6, '2018-07-24 07:13:05'),
(50, 38, 2, '2018-07-26 07:54:05'),
(51, 38, 3, '2018-07-26 07:54:05'),
(52, 38, 8, '2018-07-26 07:54:05'),
(54, 23, 4, '2018-07-26 07:54:11'),
(55, 23, 5, '2018-07-26 07:54:11'),
(62, 61, 3, '2018-07-26 07:54:30'),
(63, 61, 4, '2018-07-26 07:54:30'),
(65, 62, 4, '2018-07-27 01:57:28'),
(66, 62, 5, '2018-07-27 01:57:28'),
(67, 62, 8, '2018-07-27 01:57:28'),
(69, 62, 3, '2018-07-27 02:10:58'),
(70, 62, 6, '2018-07-27 02:15:14'),
(71, 66, 2, '2018-08-04 01:48:30'),
(72, 66, 3, '2018-08-04 01:48:30'),
(73, 67, 3, '2018-08-21 08:47:39'),
(74, 67, 8, '2018-08-21 08:47:39'),
(75, 67, 9, '2018-08-21 08:47:39');

-- --------------------------------------------------------

--
-- 表的结构 `bg_column`
--

CREATE TABLE IF NOT EXISTS `bg_column` (
  `column_id` int(11) NOT NULL AUTO_INCREMENT,
  `column_name` varchar(50) NOT NULL COMMENT '栏目名称',
  `column_tags` varchar(100) NOT NULL COMMENT '链接',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `column_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `column_disp` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示下拉 0为不显示',
  `column_desc` varchar(50) NOT NULL COMMENT '栏目中的一句话',
  PRIMARY KEY (`column_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='栏目表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `bg_column`
--

INSERT INTO `bg_column` (`column_id`, `column_name`, `column_tags`, `addtime`, `column_sort`, `column_disp`, `column_desc`) VALUES
(6, '网站首页', 'index', '2018-07-12 08:52:38', 0, 0, '愿花开有声落地无痕。'),
(7, '关于我', 'about', '2018-07-12 08:52:52', 10, 0, ''),
(8, '学无止境', 'content', '2018-07-12 08:53:00', 1, 1, '不要轻易放弃。学习成长的路上，我们长路漫漫，只因学无止境。'),
(9, '慢生活', 'content', '2018-07-12 08:53:12', 3, 1, '慢生活，不是懒惰，放慢速度不是拖延时间，而是让我们在生活中寻找到平衡。'),
(10, '时间轴', 'time', '2018-07-12 08:54:14', 4, 0, '时光飞逝，机会就在我们眼前，何时找到了灵感，就要把握机遇，我们需要智慧和勇气去把握机会。'),
(11, '留言', 'message', '2018-07-12 08:54:19', 11, 0, ''),
(13, '小标签', 'tags', '2018-07-13 03:01:53', 5, 0, '愿即可朝九晚五又可浪迹天涯。');

-- --------------------------------------------------------

--
-- 表的结构 `bg_column_out`
--

CREATE TABLE IF NOT EXISTS `bg_column_out` (
  `column_out_id` int(11) NOT NULL AUTO_INCREMENT,
  `column_out_name` varchar(50) NOT NULL COMMENT '二级栏目标题',
  `column_out_tags` varchar(100) NOT NULL COMMENT '链接',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `column_id` int(11) NOT NULL COMMENT '上级栏目ID',
  `column_sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `column_out_desc` varchar(50) NOT NULL COMMENT '栏目中的描述',
  PRIMARY KEY (`column_out_id`),
  KEY `column_id` (`column_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='二级栏目' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `bg_column_out`
--

INSERT INTO `bg_column_out` (`column_out_id`, `column_out_name`, `column_out_tags`, `addtime`, `column_id`, `column_sort`, `column_out_desc`) VALUES
(1, '心得笔记', 'content', '2018-07-13 03:49:09', 8, 50, '我们的爱呀哎呦'),
(2, '慢慢生活', 'content', '2018-07-25 01:19:43', 9, 50, '慢慢生活吧');

-- --------------------------------------------------------

--
-- 表的结构 `bg_member`
--

CREATE TABLE IF NOT EXISTS `bg_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_name` varchar(50) NOT NULL COMMENT '昵称',
  `member_email` varchar(50) NOT NULL COMMENT '电子邮箱',
  `member_mobile` text NOT NULL COMMENT '手机号',
  `member_sex` int(11) NOT NULL DEFAULT '0' COMMENT '0为未知,1为男,2为女',
  `member_birthday` datetime NOT NULL COMMENT '生日',
  `member_state` int(11) NOT NULL DEFAULT '1' COMMENT '0为冻结,1为正常',
  `member_real_state` int(11) NOT NULL DEFAULT '0' COMMENT '实名是否成功',
  `member_address` varchar(50) NOT NULL COMMENT '用户所在地',
  `member_addtime` varchar(255) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='用户信息表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `bg_member`
--

INSERT INTO `bg_member` (`member_id`, `member_name`, `member_email`, `member_mobile`, `member_sex`, `member_birthday`, `member_state`, `member_real_state`, `member_address`, `member_addtime`) VALUES
(8, '我是刚添加的', '1234@qq.com', '1234324', 0, '0000-00-00 00:00:00', 1, 0, '', '2018-06-28 16:28:47');

-- --------------------------------------------------------

--
-- 表的结构 `bg_member_card`
--

CREATE TABLE IF NOT EXISTS `bg_member_card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_card` varchar(18) NOT NULL COMMENT '身份证',
  `card_turename` varchar(50) NOT NULL COMMENT '真实名字',
  `card_birth_ress` text NOT NULL COMMENT '地址',
  `card_state` int(11) NOT NULL DEFAULT '1' COMMENT '0为冻结,1为正常使用',
  `card_addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '实名时间',
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='实名认证表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `bg_member_card`
--

INSERT INTO `bg_member_card` (`card_id`, `member_card`, `card_turename`, `card_birth_ress`, `card_state`, `card_addtime`, `member_id`) VALUES
(13, '12312412412', '刚添加', '德玛西亚人', 1, '2018-06-28 08:28:47', 8);

-- --------------------------------------------------------

--
-- 表的结构 `bg_member_login`
--

CREATE TABLE IF NOT EXISTS `bg_member_login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_id` int(11) NOT NULL COMMENT '哪个用户的',
  `login_user` varchar(50) NOT NULL COMMENT '登录用户名',
  `login_as_user` varchar(50) NOT NULL COMMENT '第二个登录名',
  `login_pass` varchar(50) NOT NULL COMMENT '密码',
  `login_pass_salt` varchar(50) NOT NULL COMMENT '密码盐值',
  `login_retry` int(11) NOT NULL DEFAULT '0' COMMENT '重试次数,如果成功一次,则清零',
  `login_addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `login_stats` int(11) NOT NULL DEFAULT '1' COMMENT '是否冻结,0为冻结,1为不冻结',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk COMMENT='用户登录表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bg_message`
--

CREATE TABLE IF NOT EXISTS `bg_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `message_name` varchar(20) NOT NULL COMMENT '姓名',
  `message_email` varchar(50) NOT NULL COMMENT '邮箱',
  `message_cont` varchar(255) NOT NULL COMMENT '留言内容',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '留言发表时间',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='留言表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `bg_message`
--

INSERT INTO `bg_message` (`message_id`, `message_name`, `message_email`, `message_cont`, `creat_time`) VALUES
(1, '老王', 'laowang@111.com', '呦呦呦', '2018-07-31 09:15:30'),
(2, '呦吼', '123@123.com', '呦吼呦吼', '2018-08-04 01:21:20');

-- --------------------------------------------------------

--
-- 表的结构 `bg_message_content`
--

CREATE TABLE IF NOT EXISTS `bg_message_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '哪个用户留的言',
  `floor_id` int(11) NOT NULL COMMENT '楼层ID',
  `reply_floor_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复那个楼层的,0为自己发表的',
  `content_describe` text NOT NULL COMMENT '留言内容',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '留言时间',
  `content_state` int(11) NOT NULL DEFAULT '1' COMMENT '0为冻结,1为正常',
  `article_id` int(11) NOT NULL COMMENT '对应文章表',
  `message_ip` varchar(30) NOT NULL COMMENT 'IP',
  `message_ress` varchar(30) NOT NULL COMMENT '地址',
  PRIMARY KEY (`content_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='留言内容表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `bg_message_content`
--

INSERT INTO `bg_message_content` (`content_id`, `member_id`, `floor_id`, `reply_floor_id`, `content_describe`, `addtime`, `content_state`, `article_id`, `message_ip`, `message_ress`) VALUES
(4, 0, 1, 0, '12312123123123123', '2018-07-31 03:57:58', 1, 62, '39.78.245.47', '山东省 联通'),
(5, 0, 2, 0, '123123123213', '2018-07-31 03:59:17', 1, 62, '39.78.245.47', '山东省 联通'),
(6, 0, 3, 0, '123123', '2018-07-31 04:00:52', 1, 62, '39.78.245.47', '山东省 联通'),
(7, 0, 1, 0, '<p>666666好<img alt="" src="http://www.blog.com/html/plugins/emoticons/images/0.gif" />123</p>\r\n', '2018-07-31 06:56:31', 1, 37, '39.78.245.47', '山东省 联通'),
(8, 0, 2, 0, '<strong>好好好好后受到挥洒汗水大厦哈啥健</strong><strong>康哈撒开了哈哈哈哈哈<img src="http://www.blog.com/html/plugins/emoticons/images/13.gif" border="0" alt="" /><img src="http://www.blog.com/html/plugins/emoticons/images/13.gif" border="0" alt="" /><img src="http://www.blog.com/html/plugins/emoticons/images/13.gif" border="0" alt="" /></strong>', '2018-07-31 07:11:52', 1, 37, '39.78.245.47', '山东省 联通'),
(9, 0, 3, 0, '<p style="text-align:left;">\r\n	<sub><span style="font-size:12px;"></span><span style="font-size:12px;"></span><img src="http://www.blog.com/html/plugins/emoticons/images/0.gif" border="0" alt="" />123</sub><sup>123123</sup><sub>123123<span style="color:#E56600;">5345435345<span style="color:#FF9900;"><strong>345345</strong></span></span></sub>\r\n</p>\r\n<div style="text-align:left;">\r\n	<span style="font-size:12px;"></span>\r\n</div>', '2018-07-31 07:17:39', 1, 37, '39.78.245.47', '山东省 联通'),
(10, 0, 4, 0, '<p style="text-align:left;">\r\n	<sub><span style="font-size:12px;"></span><span style="font-size:12px;"></span><img src="http://www.blog.com/html/plugins/emoticons/images/0.gif" border="0" alt="" />123</sub><sup>123123</sup><sub>123123<span style="color:#E56600;">5345435345<span style="color:#FF9900;"><strong>345345</strong></span></span></sub>\r\n</p>\r\n<div style="text-align:left;">\r\n	<span style="font-size:12px;"></span>\r\n</div>', '2018-07-31 07:17:39', 1, 37, '39.78.245.47', '山东省 联通'),
(11, 0, 5, 0, '帅酷美留啊是雕塑大师的', '2018-07-31 07:53:42', 0, 37, '39.78.245.47', '山东省 联通'),
(12, 0, 6, 3, '呦呦呦回复3楼', '2018-07-31 08:13:46', 1, 37, '39.78.245.47', '山东省 联通'),
(13, 0, 7, 5, '呦呦呦 厉害了', '2018-07-31 08:20:24', 1, 37, '39.78.245.47', '山东省 联通'),
(14, 0, 8, 6, '我很厉害啊', '2018-07-31 08:33:15', 1, 37, '39.78.245.47', '山东省 联通'),
(15, 0, 1, 0, '一一一一一', '2018-08-01 07:27:22', 1, 61, '39.78.245.139', '山东省 联通'),
(16, 0, 4, 2, '你好2楼', '2018-08-01 07:34:35', 1, 62, '39.78.245.139', '山东省 联通'),
(17, 0, 1, 0, '<p>\r\n	linux下的路径以"/"隔开 但是windows中的路径以\\隔开,对于unlink或者require 中使用路径需要注意,如果使用错误则会出现&nbsp; 名为abc/123.txt的文件\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '2018-08-04 03:13:28', 1, 66, '112.231.81.160', '山东省济南市 联通'),
(18, 0, 2, 0, '当把文件上传至虚拟主机上时出现了两个问题,其中一个就是文件被识别了,但是什么都不会显示,后来发现是命名空间的问题. php版本太低不支持DIR与命名空间,在之后就是 mkdir() 的问题, thinkphp会自动在访问的时候 在runtime/temp目录下生成缓存文件,但是runtime目录的文件权限就是个问题,实际上他需要 777 的权限, 注意一点就是他不知755权限.会报错,在虚拟机上实测。<br />', '2018-08-15 01:51:08', 1, 66, '112.230.249.220', '山东省济南市 联通');

-- --------------------------------------------------------

--
-- 表的结构 `bg_message_down`
--

CREATE TABLE IF NOT EXISTS `bg_message_down` (
  `down_id` int(11) NOT NULL AUTO_INCREMENT,
  `down_ip` varchar(50) NOT NULL COMMENT 'IP',
  `down_address` varchar(50) NOT NULL COMMENT '地址',
  `creat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`down_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='点赞表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `bg_message_down`
--

INSERT INTO `bg_message_down` (`down_id`, `down_ip`, `down_address`, `creat_time`, `article_id`) VALUES
(4, '39.78.150.140', '山东省 联通', '2018-07-30 03:09:18', 37),
(6, '39.78.150.140', '山东省 联通', '2018-07-30 07:07:50', 40),
(7, '39.78.245.47', '山东省 联通', '2018-07-31 03:27:08', 62),
(9, '39.78.245.47', '山东省 联通', '2018-07-31 07:32:14', 37),
(10, '39.78.245.139', '山东省 联通', '2018-08-01 07:27:08', 61),
(11, '39.78.245.139', '山东省 联通', '2018-08-01 07:34:06', 62),
(12, '39.78.245.139', '山东省 联通', '2018-08-01 08:33:18', 40),
(13, '39.64.250.153', '山东省 联通', '2018-08-02 01:45:56', 62),
(14, '112.231.81.160', '山东省济南市 联通', '2018-08-04 00:50:06', 61),
(15, '112.231.81.160', '山东省济南市 联通', '2018-08-04 00:50:17', 44),
(16, '112.231.81.160', '山东省济南市 联通', '2018-08-04 00:50:29', 23),
(18, '112.231.81.160', '山东省济南市 联通', '2018-08-04 01:19:21', 24),
(19, '112.231.81.160', '山东省济南市 联通', '2018-08-04 01:20:03', 28),
(20, '112.231.81.160', '山东省济南市 联通', '2018-08-04 01:58:19', 66),
(21, '112.230.249.220', '山东省济南市 联通', '2018-08-15 01:51:50', 66),
(22, '127.0.0.1', 'XX内网IP', '2018-08-21 05:26:33', 66);

-- --------------------------------------------------------

--
-- 表的结构 `bg_pic`
--

CREATE TABLE IF NOT EXISTS `bg_pic` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pic_name` varchar(50) NOT NULL COMMENT '标题',
  `pic_div_state` int(11) NOT NULL DEFAULT '0' COMMENT '是否使用固定宽高,0为不使用,1为使用',
  `pic_add` varchar(255) NOT NULL COMMENT '创建时间',
  `pic_type_id` int(11) NOT NULL COMMENT '类型id',
  PRIMARY KEY (`pic_id`),
  KEY `pic_type_id` (`pic_type_id`),
  KEY `pic_type_id_2` (`pic_type_id`),
  KEY `pic_type_id_3` (`pic_type_id`),
  KEY `pic_type_id_4` (`pic_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk COMMENT='图片表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bg_pic_dir`
--

CREATE TABLE IF NOT EXISTS `bg_pic_dir` (
  `pic_dir_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pic_type_id` int(11) NOT NULL COMMENT '对应的是哪个图片栏目',
  `pic_dir_name` varchar(255) NOT NULL COMMENT '标题',
  `pic_dirname` varchar(255) NOT NULL COMMENT '路径',
  `pic_dir_addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `article_id` int(11) DEFAULT NULL COMMENT '文章ID',
  PRIMARY KEY (`pic_dir_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='图片地址表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `bg_pic_dir`
--

INSERT INTO `bg_pic_dir` (`pic_dir_id`, `pic_type_id`, `pic_dir_name`, `pic_dirname`, `pic_dir_addtime`, `article_id`) VALUES
(1, 1, '测试图片', '20180727\\262de8f0cb769c0355966138763b7fa4.jpg', '2018-07-27 08:33:18', 40),
(2, 1, '123', '20180727\\f2e81a5c5af9d78141574610e0c98429.jpg', '2018-07-27 09:06:29', 23),
(3, 1, '测试图片', '20180727\\f19c6b5cf9d2c1758202a7bb65bf5318.jpg', '2018-07-27 09:06:59', 28),
(5, 2, '文章推荐默认图', '20180728\\f8f24c6f2ecba8adb0d422644af89c62.jpg', '2018-07-28 01:26:28', NULL),
(6, 3, '小标签默认图', '20180728\\3f52949f1fcd96668de4469cf9d3182d.jpg', '2018-07-28 01:26:43', NULL),
(7, 3, '小标签默认图2', '20180728\\a627434f05fb3d510ba85240df61f1dd.jpg', '2018-07-28 01:26:52', NULL),
(8, 3, '小标签默认图3', '20180728\\4e83f08881aa731a103040bcb9f41f50.jpg', '2018-07-28 01:27:01', NULL),
(9, 2, '文章推荐默认图2', '20180728\\ebd4a5ce97cca0be25afaf282b9059de.jpg', '2018-07-28 01:27:17', NULL),
(10, 2, '文章推荐默认图3', '20180728\\17ebded454dc49ef6b63a25915327c8f.jpg', '2018-07-28 01:27:26', NULL),
(12, 4, '支付宝支付二维码', '20180728\\7fc30f2fde75557b7ef278011924f871.png', '2018-07-28 07:31:10', NULL),
(13, 5, '微信支付二维码', '20180728\\455f0633d7a3334d75fa5aecbdb09b0a.png', '2018-07-28 07:31:29', NULL),
(14, 6, '微信二维码', '20180728\\73b0616c3ca8ea9a622c0e20bea28931.png', '2018-07-28 07:31:43', NULL),
(15, 1, '小猫猫', '20180802\\7d53e9f43e60982e6aa44322fa1aeec8.jpg', '2018-08-02 02:19:16', 37);

-- --------------------------------------------------------

--
-- 表的结构 `bg_pic_type`
--

CREATE TABLE IF NOT EXISTS `bg_pic_type` (
  `pic_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pic_type_name` varchar(50) NOT NULL COMMENT '分类名',
  `pic_name_state` int(11) NOT NULL DEFAULT '1' COMMENT '是否使用标题',
  `pic_ water_state` int(11) NOT NULL DEFAULT '0' COMMENT '1使用水印,0不使用水印',
  `pic_type_addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`pic_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='图片类型表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `bg_pic_type`
--

INSERT INTO `bg_pic_type` (`pic_type_id`, `pic_type_name`, `pic_name_state`, `pic_ water_state`, `pic_type_addtime`) VALUES
(1, '轮播图(ID为1)', 1, 0, '2018-07-28 01:10:41'),
(2, '文章推荐默认图', 1, 0, '2018-07-27 03:34:21'),
(3, '小标签栏目默认图', 1, 0, '2018-07-27 07:57:20'),
(4, '支付宝', 1, 0, '2018-07-28 07:27:02'),
(5, '微信支付', 1, 0, '2018-07-28 07:27:07'),
(6, '微信二维码', 1, 0, '2018-07-28 07:27:20');

-- --------------------------------------------------------

--
-- 表的结构 `bg_shield`
--

CREATE TABLE IF NOT EXISTS `bg_shield` (
  `shield_id` int(11) NOT NULL AUTO_INCREMENT,
  `shield_con` text NOT NULL COMMENT '屏蔽词, 以| 隔开',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`shield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='屏蔽词' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bg_shield`
--

INSERT INTO `bg_shield` (`shield_id`, `shield_con`, `addtime`) VALUES
(1, '她妈|它妈|他妈|你妈|去死|贱人|1090tv|10jil|21世纪中国基金会|2c8|3p|4kkasi|64惨案|64惨剧|64学生运动|64运动|64运动民國|89惨案|89惨剧|89学生运动|89运动|adult|asiangirl|avxiu|av女|awoodong|A片|bbagoori|bbagury|bdsm|binya|bitch|bozy|bunsec|bunsek|byuntae|B样|fa轮|fuck|ＦｕｃΚ|gay|hrichina|jiangzemin|j女|kgirls|kmovie|lihongzhi|MAKELOVE|NND|nude|petish|playbog|playboy|playbozi|pleybog|pleyboy|q奸|realxx|s2x|sex|shit|sorasex|tmb|TMD|tm的|tongxinglian|triangleboy|UltraSurf|unixbox|ustibet|voa\r\n', '2018-08-04 01:24:29');

-- --------------------------------------------------------

--
-- 表的结构 `bg_shield_content`
--

CREATE TABLE IF NOT EXISTS `bg_shield_content` (
  `shield_con_id` int(11) NOT NULL AUTO_INCREMENT,
  `shield_con` text NOT NULL COMMENT '屏蔽的内容,以半角'',''隔开',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `uptime` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`shield_con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk COMMENT='屏蔽词字段' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bg_supermin`
--

CREATE TABLE IF NOT EXISTS `bg_supermin` (
  `super_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `super_user` varchar(50) NOT NULL COMMENT '管理员账号',
  `super_pass` varchar(50) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`super_id`),
  KEY `super_pass` (`super_pass`),
  KEY `super_pass_2` (`super_pass`),
  KEY `super_pass_3` (`super_pass`),
  KEY `super_pass_4` (`super_pass`),
  KEY `super_pass_5` (`super_pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='系统管理员' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `bg_supermin`
--

INSERT INTO `bg_supermin` (`super_id`, `super_user`, `super_pass`) VALUES
(4, 'root', 'ZTEwYWRjMzk0OWJhNTlhYmJlNTZlMDU3ZjIwZjg4M2U=');

-- --------------------------------------------------------

--
-- 表的结构 `bg_system`
--

CREATE TABLE IF NOT EXISTS `bg_system` (
  `system_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `system_key` varchar(255) NOT NULL COMMENT '配置key',
  `system_val` varchar(255) NOT NULL COMMENT '配置值',
  `system_name` varchar(255) NOT NULL COMMENT '配置名称',
  `system_describe` text NOT NULL COMMENT '配置描述',
  `system_type` varchar(50) NOT NULL COMMENT '配置的数据类型',
  `system_default` varchar(50) DEFAULT NULL COMMENT '配置初始值',
  `lastUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`system_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk COMMENT='系统配置' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `bg_system`
--

INSERT INTO `bg_system` (`system_id`, `system_key`, `system_val`, `system_name`, `system_describe`, `system_type`, `system_default`, `lastUpdated`) VALUES
(1, 'sys_name', 'My''s  博客', '网站名称', '网站名称', '', NULL, '2018-07-28 06:20:26'),
(2, 'sys_describe', '博客博客博客', '描述', 'SEO网站描述', '', NULL, '2018-07-28 03:28:05'),
(3, 'sys_key', 'you123', '关键词', 'SEO关键词', '', 'you', '2018-07-19 01:07:16'),
(4, 'sys_power', '@2017', '版权信息', '底部版权信息', '', NULL, '2018-07-31 08:55:18'),
(5, 'sys_keepor', '测试ICP备11002373号', '备案号', '备案号', '', NULL, '2018-07-28 07:09:05'),
(6, 'sys_mobile', '400-123456789', '联系电话', '联系电话', '', '123456', '2018-07-28 06:18:01'),
(7, 'sys_email', '2694177727@qq.com', '联系邮箱', '联系邮箱', '', '123@qq.com', '2018-07-28 06:18:01'),
(8, 'sys_water', '1', '水印', '是否开启水印,1为开始,0为关闭', '', '0', '2018-07-19 01:07:16'),
(9, 'sys_water_pos', '9', '水印位置', '水印位置,1为左上,2上,3为右上,4左,5为中心,6右,7为左下,8下,9为右下', '', '9', '2018-07-19 01:07:16'),
(10, 'sys_admin_pass', '', '后台登录口令', '登录的口令', '', 'root', '0000-00-00 00:00:00'),
(11, 'sys_admin_pass_status', '', '是否开启口令', '是否开启口令,0为关闭,1为开启', '', '0', '0000-00-00 00:00:00'),
(12, 'sys_code_status', '', '验证码是否开启', '验证码是否开启,0为关闭,1为开启', '', '0', '0000-00-00 00:00:00'),
(13, 'sys_xinlemail', '博客网', '新浪微博', '', '', NULL, '2018-07-28 06:18:01'),
(14, 'sys_tengxemail', '博客网', '腾讯微博', '', '', NULL, '2018-07-28 06:18:01'),
(15, 'sys_qqcard', '2694177727', 'qq号', '', '', NULL, '2018-07-28 06:18:01'),
(16, 'sys_wxcard', 'qq2694177727', '微信号', '', '', NULL, '2018-07-28 06:18:01');

-- --------------------------------------------------------

--
-- 表的结构 `bg_test_redis`
--

CREATE TABLE IF NOT EXISTS `bg_test_redis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bg_test_redis`
--

INSERT INTO `bg_test_redis` (`id`, `num`) VALUES
(1, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
