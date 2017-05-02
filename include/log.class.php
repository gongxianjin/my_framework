<?php 
/*
file log.class.php
作用：记录信息到日志
*/ 

/*
思路：如果文件大于1M用fopen,fwrite;
传给我一个内容，判断当前日志的大小，如果大于1M，备份日志，否则写入
*/ 

class Log{
	const LOGFILE = 'curr.log';//弄一个常量，代表日志文件的名称
	// 写日志
	public static function write($cont){
		$cont .= "\r\n";
		//判断是否备份
		$log = self::isBak();//计算备份日志的地址
		$fh = fopen($log,'ab');
		fwrite($fh, $cont);
		fclose($fh);
	}
	// 备份日志
	public static function bak(){
		// 把原来的日志形式 改个名存储起来
		// 改成年 月 日.bak
		$log = ROOT.'data/log/'.self::LOGFILE;
		$bak = ROOT.'data/log/'.date('ymd').mt_rand(10000,99999).'.bak';
		return rename($log,$bak);
	}

	// 读取并判断日志的大小
	public static function isBak(){
		$log = ROOT.'data/log/'.self::LOGFILE; 
		if(!file_exists($log)){
			touch($log);//如果文件不存在就创建这个文件 touch在linux也是快速建立一个文件
			return $log;
		} 
		//如果要是存在，判断大小
		// 清除缓存
		clearstatcache();
		$size = filesize($log);
		if($size<=1024*1024){//sda
			return $log;
		} 
		
		//走到这一步，说明大于1M
		if(!self::bak()){
			return $log;
		}else{
			touch($log);
			return $log;
		}
	}
}