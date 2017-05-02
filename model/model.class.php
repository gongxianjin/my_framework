<?php 

// 任务二: 分离出model

class model{

	protected $table = NULL;
	protected $db = NULL;

	public function __construct(){
		$this->db = mysql::getIns(); 
	}

}