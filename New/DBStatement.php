<?php

class Statement {

    private $Host 		= 'bpdevsys-tools.bigpoint.net';
   	private $DBName 	= 'Test_Lian';
   	private $DBUsername = 'lian_test';
   	private $DBPassword = 'lian_test';
    protected $tables;
    protected $columns;
    protected $values;
    protected $conditions;

    public function __construct($query) {
        $this->_setTables($query['tables']);
        $this->_setColumns($query['columns']);
        $this->_setValues($query['values']);
        $this->_setConditions(($query['conditions']));

        mysql_connect($this->Host, $this->DBUsername, $this->DBPassword) or die ("Fehler");
        mysql_select_db($this->DBName);
    }

    protected function _setTables($tables) {
        $this->tables = $tables;
        return $this;
    }

    protected function _getTables() {
        return $this->tables;
    }

    protected function _setColumns($columns) {
        $this->columns = $columns;
        return $this;
    }

    protected function _getColumns() {
        return $this->columns;
    }

    protected function _setValues($values) {
        $this->values = $values;
        return $this;
    }

    protected function _getValues() {
        return $this->values;
    }

    protected function _setConditions($conditions) {
        $this->conditions = $conditions;
        return $this;
    }

    protected function _getConditions() {
        return $this->conditions;
    }

    public function insert() {
        if (is_array($this->_getTables())) {
            $tables = $this->_getTables();
            $this->_setTables($tables[0]);
        }
        $statement = 'INSERT INTO '.$this->_getTables().' ';
        $string = '';
        foreach ($this->_getColumns() as $column) {
            $string .= '`'.$column.'`, ';
        }
        $statement .= '('.substr($string, 0, -2).')';
        $statement .= ' VALUES ';
        $string = '';
        foreach ($this->_getValues() as $value) {
            $string .= "'".$value."', ";
        }
        $statement .= '('.substr($string, 0, -2).')';

        $query_output = mysql_query($statement) or die ("mysql error: " . mysql_error());
        return $query_output;
    }

    public function delete() {
        if (is_array($this->_getTables())) {
            $tables = $this->_getTables();
            $this->_setTables($tables[0]);
        }
        $statement = 'DELETE FROM '.$this->_getTables().' ';
        $statement .= $this->_where();

        $query_output = mysql_query($statement) or die ("mysql error: " . mysql_error());
        return $query_output;
    }

    public function select() {
        $statement = 'SELECT ';
        if ($this->_getColumns() == array('*')) {
            $statement .= '*  ';
        } else {
            foreach($this->_getColumns() as $column) {
                $statement .= '`'.$column.'`, ';
            }
        }
        $statement = substr($statement, 0, -2);
        $statement .= ' FROM ';
        foreach($this->_getTables() as $table) {
            $statement .= $table.', ';
        }
        $statement = substr($statement, 0, -2);
        $statement .= ' ';
        $statement .= $this->_where();

        $query_output = mysql_query($statement) or die ("mysql error: " . mysql_error());
        return $query_output;
    }

    public function update() {
        if (is_array($this->_getTables())) {
            $tables = $this->_getTables();
            $this->_setTables($tables[0]);
        }
        $statement = 'UPDATE '.$this->_getTables().' SET ';
        foreach($this->_getColumns() as $column) {
            $statement .= '`'.$column.'`, ';
        }
        $statement = substr($statement, 0, -2);
        $statement .= ' = ';
        foreach ($this->_getValues() as $value) {
            $statement .= "'".$value."', ";
        }
        $statement = substr($statement, 0 , -2);
        $statement .= ' ';
        $statement .= $this->_where();
        var_dump($statement);exit;
        $query_output = mysql_query($statement) or die ("mysql error: " . mysql_error());
        return $query_output;
    }

    protected function _where() {
        $statement = 'WHERE ';
        foreach ($this->_getConditions() as $condition) {
            $statement .= '`'.$condition['column'].'` '.$condition['operator']." '".$condition['value']."'";
            $statement .= ' AND ';
        }
        $statement = substr($statement, 0, -5);
        return $statement;
    }
}