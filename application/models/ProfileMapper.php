<?php

class ProfileMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Profile';
	protected $columns;
	
	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}
	
	public function insert(Profile $profile) {
		
		$statement = new InsertStatement (array($this->DBTable));
		
		$statement->setValues($profile);
		
		$query_output = $statement->execute();
		
		$profile->setID(mysql_insert_id());
		
		return $profile;
	}
	
	public function delete(Profile $profile) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions(array('ID'=>$profile->getID()));
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
	
	public function select($conditions, $columns = '*', $DBtables = null) {
		
		$statement = new SelectStatement(array($this->DBTable));
		
		if(empty($columns)){
				
			$columns = '*';
		}
		
		$statement->setSelect($columns);
		
		$statement->setConditions($conditions);
		
		$query_output = $statement->execute();
		
		$return = array();
		
		while($row = mysql_fetch_assoc($query_output)){

			$return[] = new Profile($row);

		}
		return $return;
	}
	
	public function update(Profile $profile) {
	
		$statement = new UpdateStatement(array($this->DBTable));
	
		$statement->setUpdate($profile->toArray());
	
		$statement->setConditions(array('ID' => $profile->getID()));
	
		$query_output = $statement->execute();
	
		return $query_output;
	
	}
}