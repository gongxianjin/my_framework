<?php 	
 /*
	
	mysql类的封装
	目标：
	链接数据库
	发送查询
	对于select 反馈结果
	关闭mysql链接

	思路：
	首先是链接，链接得有参数
	参数如何传，1配置文件2构造函数

 */
class mysql extends db{

    private static $ins = NULL;
    private $conn = NULL;
	private $conf = array();

	final protected function __construct(){   
		$this->conf = config::getIns();
		$this->connect($this->conf->host,$this->conf->user,$this->conf->pwd);
		$this->select_db($this->conf->db);
		$this->setChar($this->conf->char);
	}

	public function __destruct(){

	}

	public static function getIns(){ 
		if(!(self::$ins instanceof self)){
			self::$ins = new self();
		}
		return self::$ins;
	}
	 
	 //负责链接 
	public function connect($h,$u,$p){
		$this->conn = mysql_connect($h,$u,$p);
		if(!$this->conn){
			$err = new Exception('链接失败');
			throw $err;
		}
	}

	protected function select_db($db){
		$sql = 'use '.$db;
		$this->query($sql);
	}

	protected function setChar($char){
		$sql = 'set names '.$char;
		return $this->query($sql);
	}

	//负责sql查询 
	public function query($sql){
		$rs = mysql_query($sql,$this->conn);
		log::write($sql);
		return $rs;
	}

	public function autoExecute($table,$arr,$model='insert',$where=' where 1 limit 1'){
        /*    insert into tbname (username,passwd,email) values ('',)
        /// 把所有的键名用','接起来
        // implode(',',array_keys($arr));
        // implode("','",array_values($arr));
        */
        if(!is_array($arr)){
        	return false;
        }
        if($model == 'update'){
        	$sql = 'update '.$table.' set ';
        	foreach($arr as $k=>$v){
        		$sql .= $k ."='".$v."'.";
        	}
        	$sql = rtrim($sql,',');
        	$sql .= $where;

        	return $this->query($sql);
        }

        $sql = 'insert into '.$table.' ('.implode(',',array_keys($arr)).')';
        $sql .= ' values (\'';
        $sql .= implode("','", array_values($arr));
        $sql .= '\')';

		return $this->query($sql);
	}


	public function getAll($sql){
		$rs = $this->query($sql); 
		$list = array();
		while($row = mysql_fetch_assoc($rs)){
			$list[] = $row;
		}
		return $list;
	}

	public function getRow($sql){
		$rs = $this->query($sql);
		 
		return mysql_fetch_assoc($rs);
	}

	public function getOne($sql){
		$rs = $this->query($sql);
		$row = mysql_fetch_row($rs);
		return $row[0];
	}

	 // 返回影响行数的函数
    public function affected_rows() {
        return mysql_affected_rows($this->conn);
    }

    // 返回最新的auto_increment列的自增长的值
    public function insert_id() {
        return mysql_insert_id($this->conn);
    }



}