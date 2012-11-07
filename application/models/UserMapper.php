<?php

class UserMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'User';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");
		mysql_select_db($this->DBName);
	}

	
	public function insert(User $user) {
		$statement = new InsertStatement(array($this->DBTable));
		$statement->setValues($user);
		$query_output = $statement->execute();
		$user->setID(mysql_insert_id());
		return $user;

	}
	
	public function delete(User $user) {
		$statement = new DeleteStatement(array($this->DBTable));
		$statement->setConditions(array('ID'=>$user->getID()));
		$query_output = $statement->execute();
		return $query_output;
		
	}
	
	public function select($conditions, $columns = '*') {
		$statement = new SelectStatement(array($this->DBTable));
		if(empty($columns)){
			$columns = '*';
		}
		$statement->setSelect($columns);
		$statement->setConditions($conditions);
		$query_output = $statement->execute();
		$return = array();
		while($row = mysql_fetch_assoc($query_output)){
			$return[] = new User($row);
		}
		return $return;
	}
		
	public function update(User $user) {
		$statement = new UpdateStatement(array($this->DBTable));
		$statement->setUpdate($user->toArray());
		$statement->setConditions(array('ID' => $user->getID()));
		$query_output = $statement->execute();
		return $query_output;
	}
}