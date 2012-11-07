<?php 

abstract class DBStatement {
	
	protected $DBTables;
	protected $statement;
	
	
	public function __construct(array $DBTables) {
		
		$this->DBTables = $DBTables;
		
	}

				
		

	public function execute() {

		$query_output	= 	mysql_query($this->getStatement()) or die ("mysql error: " . mysql_error());

		return $query_output;	
	}
	
	abstract function getStatement();
	
}
