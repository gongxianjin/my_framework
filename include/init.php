<?php

/*
	file init.php
	作用：框架初始化
*/

//初始化当前的绝对路径
//换成正斜线是因为win/linux都支持正斜线，而linux不支持反斜线; 
	
defined('ACC')||exit('ACC Denied');

// define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))).'/');
define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))).'/');

require(ROOT.'include/lib_base.php');

function __autoload($class){
	if(strtolower(substr($class,-5)) == 'model'){
		require(ROOT.'model/'.$class.'.class.php');
	}else{
		require(ROOT.'include/'.$class.'.class.php');
	}
}

//过滤参数
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);


//设置报错级别
define('DEBUG', true);
if(defined('DEBUG')){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}


 