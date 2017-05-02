<?php 

/*
	file:db.class.php
	数据库类

	目前到底使用什么数据库还不清楚

*/

abstract class db{

	/*
	链接服务器
	parms $h 服务器地址
	parms $u 用户名
	parms $p 密码
	return bool
	*/
	public abstract function connect($h,$u,$p);
	/*
	发送查询
	parms $sql 发送的sql语句
	return mixed bool/resource
	*/
	public abstract function query($sql);

	/*
	查询多行数据	
	return array/bool
	*/
	public abstract function getAll($sql);

	/*
	查询单行数据	
	return array/bool
	*/
	public abstract function getRow($sql);

	/*
	查询单个数据	
	return array/bool
	*/
	public abstract function getOne($sql);

	/*
	自动执行insert/updata语句	
	parms $table 表名
 	parms $data  数组
	parms $act   动作
	parms $where  针对于update/delete使用
	return array/bool
	*/
	public abstract function autoExecute($table,$data,$act='insert',$where='');


}