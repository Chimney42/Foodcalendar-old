<?php

class SelectStatement extends DBWhereStatement {
	
	protected $columns;
	
	public function __construct($DBTables) {
		parent::__construct($DBTables);
	}
	
	public function setSelect ($columns) {
        if((is_array($columns) || $columns = '*') && !empty($columns)) {
			$this->columns = $columns;
			return $this;
		}
		return false;
	}
	
	public function getStatement () {
		if(!empty($this->columns)) {
			$statement = "SELECT ";

			if(is_array($this->columns)){
				$columnCount = count($this->columns);
				$index = 0;
				foreach ($this->columns as $column) {
					if($index < $columnCount) {
					$statement .= $column . ", ";
					}
				$index++;
				}
				$statement = substr($statement, 0, -2);
			}

			if($this->columns == '*'){
				$statement .= '*';
			}
			$statement .= " FROM ";
			$tableCount = count($this->DBTables);
			$index = 0;
			
			foreach ($this->DBTables as $DBTable) {
				if($index < $tableCount) {
					$statement .= $DBTable;
					
					if($index < $tableCount - 1) {
					$statement .= ', ';
					$index++;
					}
				}
			}
			
			$whereStatement = $this->where();
			$statement .= $whereStatement;
			$statement .= ";";
			$this->statement = $statement;
			return $this->statement;
		}
		
		return false;
	}
}