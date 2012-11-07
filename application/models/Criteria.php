<?php

class Criteria {

	protected $ID;
	protected $criterion;
	protected $operator;
	protected $value;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			$this->setID((int)$values['ID']);
			$this->setCriterion($values['criterion']);
			$this->setOperator($values['operator']);
			$this->setValue($values['value']);
		}
	
	}
	
	public function setID($ID) {
		
		if(is_int($ID) && $ID > 0 && count($ID) <= 5) {
		
			$this->ID = $ID;
		
			return $this;
			
		} 
		return false;

	}
	
	public function getID() {
		
		return $this->ID;
	}
	
	
	
	public function setCriterion($criterion) {
		
		if(!empty($criterion)) {
			
			$this->criterion = $criterion;
			return $this;
		}
		return false;
	}

	
	public function getCriterion() {
		
		return $this->criterion;
		
	}
	
	public function setOperator($operator) {
		
		if(!empty($operator)) {
			
			$this->operator = $operator;
			
			return $this;
		}
		return false;
	}
	
	public function getOperator() {
		
		return $this->operator;
	}
	
	public function setValue($value) {

		if(!empty($value)) {
			
			$this->value = $value;
			
			return $this;
		}
		
		return false;
	}
	
	public function getValue() {
		
		return $this->value;
	}
	
	public function toArray() {
		$array = array (
					'ID' => $this->ID,
					'criterion' => $this->criterion,	
					'operator' => $this->operator,
					'value' => $this->value	
				);
		
		return $array;
	}
	
}