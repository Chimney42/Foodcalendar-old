<?php

class InsertStatement extends DBStatement {
	
	protected $values;
	
	public function __construct($DBTables) {
		parent::__construct($DBTables);
	}
	
	
	public function setValues($values) {
		if(is_object($values)) {
			$values = $values->toArray();
		}

		if(is_array($values) && !empty($values)) {
			$this->values = $values;
			return $this;
		} else {
			return false;
		}
	}
	
	public function getStatement() {
	
		if(!empty($this->values)) {
			$columns = "";
			$values = "";
			
			foreach ($this->values as $column => $value) {
				
				$columns .= "`" . $column ."`, ";
				$values .= "'" . $value . "', ";
			}
			
			$columns = substr($columns, 0, -2);
			$values = substr($values, 0, -2);
			
			
			if (is_array($this->DBTables) && count($this->DBTables) == 1) {
			
				$statement = "INSERT INTO " . $this->DBTables[0] . " ($columns) VALUES ($values);"; 
			
			} else {
				die("Multiple tables for insert");
			}

			$this->statement = $statement;

			return $this->statement;
		}
		return false;
	}
	
}

