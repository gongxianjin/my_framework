<?php 

/*
file  config.class.php
配置文件读取类
单例模式  只有一个实例 必须自行创建这个实例 必须自行向整个系统提过这个实例
保证一个类仅有一个实例且易于被访问

*/

class config{
	protected  static $ins = null;
	protected  $data = array();


	final protected function __construct(){
		//一次性把配置文件信息都进来，赋给data属性
		//这样以后就可以不用管配置文件了
		//再要配置这个值，直接从data属性里来找
		require(ROOT.'include/config.inc.php');
		$this->data = $_CFG;
	}

	final protected function __clone(){

	}

	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;
		}else{
			self::$ins = new self();
			return self::$ins;
		}
	}

	//用魔术方法读取data内的配置信息
	public function __get($key){
		if(array_key_exists($key,$this->data)){
			return $this->data[$key]; 
		}else{
			return null;
		}
	}
	//用魔术方法动态增加或改变配置选项
	public function __set($key,$value){
		$this->data[$key] = $value;
	}

}
// $conf = config::getIns();
//已经能够把配置文件的信息，读取到自身的data中存储起来
//var_dump($conf);
//echo $conf->host;
//echo $conf->template_dir;
//动态追加选项
//$conf->template_dir = 'F:\AppServ\www\boolmart';
