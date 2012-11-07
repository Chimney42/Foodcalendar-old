<?php

class IngredientMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Ingredient';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");
		
		mysql_select_db($this->DBName);
		
	}
	
	
	public function insert(Ingredient $ingredient) {
		
		$statement = new InsertStatement(array($this->DBTable));
		
		$statement->setValues($ingredient);
		
		$query_output = $statement->execute();

		$ingredient->setID(mysql_insert_id());

		return $ingredient;
	}
	
	public function delete(Ingredient $ingredient) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions(array('ID' => $ingredient->getID()));
		
		$query_output = $statement->execute();
		
		return $query_output;
	}
	
	public function select($conditions, $columns = '*', $DBTables = NULL) {

        if ($DBTables == null) {

            $DBTables = array($this->DBTable);
        }
		
		$statement = new SelectStatement(array($this->DBTable));
				
		if(empty($columns)){
			
			$columns = '*';
		}
		
		$statement->setSelect($columns);
		
		$statement->setConditions($conditions);

		$query_output = $statement->execute();
				
		$return = array();
				
		while($row = mysql_fetch_assoc($query_output)){
					
			$return[] = new Ingredient($row);
					
		}

		return $return;
	}
	
	public function update(Ingredient $ingredient) {
		
		$statement = new UpdateStatement(array($this->DBTable));
		
		$statement->setUpdate($ingredient->toArray());
		
		$statement->setConditions(array('ID' => $ingredient->getID()));
		
		$query_output = $statement->execute();
		
		return $query_output;
	}
	
}