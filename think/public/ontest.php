<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;
// 加载基础文件
// header('Access-Control-Allow-Origin:*');
// header('Access-Control-Allow-Credentials: true');
// header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
// header("Access-Control-Max-Age: 3600");
// if (strtoupper($_SERVER['REQUEST_METHOD']) == 'OPTIONS') {
//     exit;
// }

require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();//绑定到index模块
