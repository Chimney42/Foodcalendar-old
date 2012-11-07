<?php

class DishMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Dish';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}

	
	public function insert(Dish $dish) {
		$statement = new InsertStatement(array($this->DBTable));
		$statement->setValues($dish);
		$query_output = $statement->execute();
		$dish->setID(mysql_insert_id());
		return $dish;
	}
	
	public function delete(Dish $dish) {
		$statement = new DeleteStatement(array($this->DBTable));
		$statement->setConditions(array('ID'=>$dish->getID()));
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
		if ($DBTables == array($this->DBTable)) {
			while($row = mysql_fetch_assoc($query_output)){
				$return[] = new Dish($row);
			}
		} else {
			 while ($row = mysql_fetch_array($query_output)) {
				$return[$row['ID']] = $row;
			}
		}
		return $return;
	}
		
	public function update(Dish $dish) {
		$statement = new UpdateStatement(array($this->DBTable));
		$statement->setUpdate($dish->toArray());
		$statement->setConditions(array('ID' => $dish->getID()));
		$query_output = $statement->execute();
		return $query_output;
	}
		
}
