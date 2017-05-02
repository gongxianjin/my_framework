<?php 

class Testmodel extends model{ 

	//用户注册的方法 
	protected $table = 'user';

	public function reg($data){
		return $this->db->autoExecute($this->table,$data,'insert');	
	}

	public function select(){
		return $this->db->getAll('select * from '.$this->table);
	}
}