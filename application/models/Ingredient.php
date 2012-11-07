<?php

class Ingredient {
	
	protected $ID;
	protected $name;
	
	public function __construct($values) {
		
		if(is_array($values) && !empty($values)) {
			
			$this->setID((int)$values['ID']);
			
			$this->setName($values['name']);
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
	
	public function setName($name) {
		
		if(!empty($name) && is_string($name) && count($name) <= 20) {
			
			$this->name = $name;
			return $this;
			
		}
		return false;
	}

    public function getName() {

        return $this->name;
    }
	public function toArray() {
		
		$array = array (
					'ID' => $this->ID,
					'name' => $this->name,
				);
		
		return $array;
	}
	
}