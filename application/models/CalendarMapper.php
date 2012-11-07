<?php

class CalendarMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Calendar';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}

	
	public function insert(Calendar $calendar) {

		$statement = new InsertStatement(array($this->DBTable));
			
		$statement->setValues($calendar);

		$query_output = $statement->execute();
		
		return $calendar;

	}
	
	public function delete(Calendar $calendar) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions($calendar->toArray());
		
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
					
			$return[] = new Calendar($row);
					
		}
			
		return $return;
	}
		
	public function update(Calendar $calendar, $conditions) {
		
		$statement = new UpdateStatement(array($this->DBTable));
		
		$statement->setUpdate($calendar->toArray());
		
		$statement->setConditions($conditions);
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
		
}
