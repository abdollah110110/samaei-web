<?php
class Posts extends Database{
	
	public function __construct() {
		$this->table = strtolower(get_class($this));
	}
	
	
	/**
	 * 
	 * @param type $params values for where
	 * @return type a array result of query contain several records
	 */
	public function findAll() {
		$this->sql .= $this->selectAll();
		return $this;
	}
	
	/**
	 * 
	 * @param type $params values for where
	 * @param type $fields values for choise fields
	 * @return type  a array result of query contain several records
	 */
	public function findFields($fields = []) {
		$this->sql = $this->selectFields($fields);
		return $this;
	}
	
}

