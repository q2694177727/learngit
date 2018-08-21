<?php
namespace app\index\controller;

use think\Request;
use think\Controller;
class Error  extends Controller
{
 public function _empty(){
    $this->redirect('index/index');
 }
}