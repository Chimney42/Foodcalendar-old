<?php

class DeleteStatement extends DBWhereStatement {
	
	public function __construct($DBTables) {
		parent::__construct($DBTables);
	}
	
	public function getStatement() {
		if (is_array($this->DBTables) && count($this->DBTables) == 1) {
			$statement = "DELETE FROM " . $this->DBTables[0];
			$whereStatement = $this->where();
			$statement .= $whereStatement;
			$statement .= ";";
			$this->statement = $statement;
			return $this->statement;
		}
		return false;
	}
}