<?php

class Eatery {
	
	protected $ID;
	protected $name;
	protected $description;
	
	public function __construct($values) {
		
		if(is_array($values) && !empty($values)) {
			
			$this->setID((int)$values['ID']);
			
			$this->setName($values['name']);
			
			$this->setDescription($values['description']);
		}
	}
	
	public function setID($ID) {
		
		if(is_int($ID) && $ID > 0 && count($ID) <= 5) {
			
			$this->ID = $ID;
			
			return $this;
		}
	}
	
	public function getID() {
	
		return $this->ID;
	}
	
	
	public function setName($name) {
	
		if(!empty($name) && is_string($name) && count($name) <= 20){
				
			$this->name = $name;
			return $this;
		}
		return false;
	}
	
	
	public function getName() {
	
		return $this->name;
	
	}
	
	
	public function setDescription($description) {
	
		if(!empty($description) && is_string($description) && count($description) <= 250) {
				
			$this->description = $description;
				
			return $this;
		}
	
	}
	
	public function getDescription() {
	
		return $this->description;
	}
	
	public function toArray() {
		$array = array (
						'ID' => $this->ID,
						'name' => $this->name,	
						'description' => $this->description,	
		);
	
		return $array;
	}
}