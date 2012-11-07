<?php

class EateryMapper {
	private $Host 		= 'bpdevsys-tools.bigpoint.net';
	private $DBName 	= 'Test_Lian';
	private $DBUsername = 'lian_test';
	private $DBPassword = 'lian_test';
	private $DBTable 	= 'Eatery';
	protected $columns;

	public function __construct() {
		mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");
		mysql_select_db($this->DBName);

	}

	
	public function insert(Eatery $eatery) {
		$statement = new InsertStatement(array($this->DBTable));
		$statement->setValues($eatery);
		$query_output = $statement->execute();
		$eatery->setID(mysql_insert_id());
		return $eatery;

	}
	
	public function delete(Eatery $eatery) {
		$statement = new DeleteStatement(array($this->DBTable));
		$statement->setConditions(array('ID'=>$eatery->getID()));
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
        if ($DBTables == array($this->DBTable)) {
		    while($row = mysql_fetch_assoc($query_output)){
			    $return[] = new Eatery($row);
            }
		} else {
            while ($row = mysql_fetch_array($query_output)) {
                $return[$row['ID']] = $row;
            }
        }
		return $return;
	}
		
	public function update(Eatery $eatery) {
		$statement = new UpdateStatement(array($this->DBTable));
		$statement->setUpdate($eatery->toArray());
		$statement->setConditions(array('ID' => $eatery->getID()));
		$query_output = $statement->execute();
		return $query_output;
	}
		
}
