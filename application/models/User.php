<?php

class User {

	protected $ID;
	protected $name;
	protected $password;
    protected $decription;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			$this->setID((int)$values['ID']);
			$this->setName($values['name']);
			$this->setPassword($values['password']);
            $this->setDescription($values['description']);
		}
	
	}
	
	public function setID($ID) {
		if(is_int($ID) && $ID > 0 && count($ID) <= 7) {
			$this->ID = $ID;
			return $this;
		} 
		return false;

	}
	
	public function getID() {
		return $this->ID;
	}
	
	
	
	public function setName($name) {
		if(!empty($name) && is_string($name) && count($name) <= 27){
			$this->name = $name;
			return $this;
		}
		return false;
	}

	
	public function getName() {
		return $this->name;
	}
	
	public function setPassword($password) {
		if(!empty($password) && is_string($password) && count($password) <= 128) {
			$this->password = $password;
			return $this;
		}
		return false; 
	}
	
	public function getPassword() {
		return $this->password;
	}

    public function setDescription($description) {
        if (!empty($description) && is_string($description) && count($description) <= 255) {
            $this->description = $description;
            return $this;
        }
        return false;
    }

    public function getDescription() {
        return $this->description;
    }

	public function toArray() {
		$array = array (
					'ID' => $this->ID,
					'name' => $this->name,	
					'password' => $this->password,
                    'description' => $this->description
				);
		return $array;
	}
	
}