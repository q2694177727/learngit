<?php

namespace app\test\controller;

/**
 * 
 */
class Test 
{	
	// public  $str;
	
	public function index($data = 0){
		static $str;
		$str  += $data;
		return $str;
	}
}