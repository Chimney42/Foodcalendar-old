<?php

class ProfileCriteriaMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'ProfileCriteria';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}

	
	public function insert(ProfileCriteria $profileCriteria) {

		$statement = new InsertStatement(array($this->DBTable));
			
		$statement->setValues($profileCriteria);

		$query_output = $statement->execute();
		
		return $profileCriteria;

	}
	
	public function delete(ProfileCriteria $profileCriteria) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions(array(
									'profileID'=>$profileCriteria->getProfileID(),
									'criteriaID'=>$profileCriteria->getCriteriaID(),
									));
		
		
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
					
			$return[] = new ProfileCriteria($row);
					
		}
			
		return $return;
	}
		
	public function update(ProfileCriteria $profileCriteria, $conditions) {
		
		$statement = new UpdateStatement(array($this->DBTable));
		
		$statement->setUpdate($profileCriteria->toArray());
		
		$statement->setConditions($conditions);
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
		
}
