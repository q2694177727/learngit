<?php
namespace app\admin\validate;

use think\Validate;


/**
 * 
 */
class Login extends Validate
{
	
	protected $rule =   [
        'username'  => 'require|max:25',
        // 'age'   => 'number|between:1,120',
        // 'email' => 'email', 
        // ['email','email','邮箱格式错误'],
		'password' 	=> 'require', 
    ];
    
    protected $message  =   [
        'username.require' => '账号必须',
        'username.max'     => '账号最多不能超过25个字符',
        'password.require' => '密码必须',
        // 'age.number'   => '年龄必须是数字',
        // 'age.between'  => '年龄只能在1-120之间',
        // 'email'        => '邮箱格式错误',    
    ];
    //  protected function checkPass($value,$rule,$data=[])
    // {
    //     return $rule == $value ? true : '名称错误';
    // }
    
}