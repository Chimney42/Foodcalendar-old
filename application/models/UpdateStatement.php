<?php 

class UpdateStatement extends DBWhereStatement {
	
	protected $updates;
	
	public function __construct ($DBTables) {
		parent::__construct($DBTables);
	}

	public function setUpdate($updates) {
		if(is_array($updates) && !empty($updates)) {
			$this->updates = $updates;
			return $this;
		} else {
			return false;
		}
	}
	

	
	
	public function getStatement() {
		
		
		if(!empty($this->updates)) {
			$updateCount = count($this->updates);
			$statement = "UPDATE " . $this->DBTables[0] . " SET ";
			$index = 0;
			foreach ($this->updates as $column => $value) {
				$statement .=$column . " ='" . $value . "'";
				if($index < $updateCount -1) {
					$statement .= ", ";
				}
				$index++;
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
