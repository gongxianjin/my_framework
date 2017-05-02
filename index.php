<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 2016/8/14
 * Time: 16:14
 */

define('ACC',true);
/*
 * 所有 用户能直接访问的页面都需要首先加载INIT.PHP
 * */
include_once('include/init.php');


$test = new Testmodel();
$list = $test->select();

print_r($list);exit;

// $mysql = mysql::getIns();

// $res = $mysql->autoExecute('test',$_GET,'insert');

// var_dump($res);