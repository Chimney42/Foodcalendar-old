<?php


class DishIngredientMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'DishIngredient';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");

		mysql_select_db($this->DBName);

	}

	
	public function insert(DishIngredient $dishIngredient) {

		$statement = new InsertStatement(array($this->DBTable));
			
		$statement->setValues($dishIngredient);

		$query_output = $statement->execute();
		
		return $dishIngredient;

	}
	
	public function delete(DishIngredient $dishIngredient) {
		
		$statement = new DeleteStatement(array($this->DBTable));
		
		$statement->setConditions(array(
									'dishID'=>$dishIngredient->getDishID(),
									'ingredientID'=>$dishIngredient->getIngredientID(),
									));
		
		
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
					
			$return[] = new DishIngredient($row);
					
		}
			
		return $return;
	}
		
	public function update(DishIngredient $dishIngredient, $conditions) {
		
		$statement = new UpdateStatement(array($this->DBTable));
		
		$statement->setUpdate($dishIngredient->toArray());
		
		$statement->setConditions($conditions);
		
		$query_output = $statement->execute();
		
		return $query_output;
		
	}
		
}
