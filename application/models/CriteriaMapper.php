<?php

class CriteriaMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Criteria';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}

	
	public function insert(Criteria $criteria) {

		$statement = new InsertStatement(array($this->DBTable));
			
		$statement->setValues($criteria);

		$query_output = $statement->execute();

		$criteria->setID(mysql_insert_id());

		return $criteria;

	}
	
	public function delete(Criteria $criteria) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions(array('ID'=>$criteria->getID()));
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
	
	public function select($conditions, $columns = '*', $DBTables = null) {

        if ($DBTables == null) {
            $DBTables = array($this->DBTable);
        }

		$statement = new SelectStatement($DBTables);
				
		if(empty($columns)){
			
			$columns = '*';
		}
		
		$statement->setSelect($columns);
		
		$statement->setConditions($conditions);
				
		$query_output = $statement->execute();
				
		$return = array();
				
		while($row = mysql_fetch_assoc($query_output)){
					
			$return[] = new Criteria($row);
					
		}
	
		return $return;
	}
		
	public function update(Criteria $criteria) {
		
		
		$statement = new UpdateStatement(array($this->DBTable));
		
		$statement->setUpdate($criteria->toArray());
		
		$statement->setConditions(array('ID' => $criteria->getID()));
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
		
}
