<?php

abstract class DBWhereStatement extends DBStatement {

	protected $conditions;
	
	public function __construct($DBTables) {
		parent::__construct($DBTables);
	}
	
	public function setConditions($conditions) {
		if(is_array($conditions) && !empty($conditions)) {
			$this->conditions = $conditions;
			return $this;
		} else {
			return false;
		}
	}
	
	protected function where() {

		if(!empty($this->conditions) && is_array($this->conditions)) {
			$statement .= " WHERE ";

			$conditionsCount = count($this->conditions);
			$index = 0;
			foreach($this->conditions as $column => $value) {

				if(strpos($column, '.') !== false) {

                    $columnParts = explode('.', $column);
                    $column = '`'.implode('`.`', $columnParts).'`';

				} else {

                    $column = "`".$column."`";
                }

                $statement .= $column . " = ";

                if(strpos($value, '.') !== false) {

                    $valueParts = explode('.', $value);
                    $value = '`'.implode('`.`', $valueParts).'`';

                } else {

                    $value = "'".$value."'";
                }

                $statement .= $value;
                if($index < $conditionsCount  - 1) {

                    $statement .= " AND ";

                }

			$index++;
			}
			
			return $statement;
		
		}
		
		return '';
	}
	
}


