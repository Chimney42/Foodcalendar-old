<?php

class Profile {
	
	protected $ID;
	protected $name;
	protected $userID;
    protected $vegetarian;
    protected $vegan;
    protected $lactosefree;
    protected $glutenfree;
	
	public function __construct($values) {
		
		if(is_array($values) && !empty($values)) {

			$this->setID((int)$values['ID']);
			$this->setName($values['name']);
			$this->setUserID((int)$values['userID']);
            $this->setVegetarian((int)$values['vegetarian']);
            $this->setVegan((int)$values['vegan']);
            $this->setLactosefree((int)$values['lactosefree']);
            $this->setGlutenfree((int)$values['glutenfree']);

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
	
	public function setUserID($userID) {
		
		if(!empty($userID) && is_int($userID) && count($userID) <= 5) {
			$this->userID = $userID;
			return $this;
		}
		return false;
	}
	
	public function getUserID() {
		return $this->userID;
	}

    public function setVegetarian($vegetarian = 0) {
        if($vegetarian == 1 || $vegetarian == true) {
            $this->vegetarian = 1;
            return $this;
        } else {
            $this->vegetarian = 0;
        }
  	 	return false;
  	}

  	public function getVegetarian() {

  		return $this->vegetarian;
  	}

  	public function setVegan($vegan = 0) {
        if($vegan == 1 || $vegan == true) {
            $this->vegan = 1;
            return $this;
        } else {
            $this->vegan = 0;
        }
        return false;
  	}

  	public function getVegan() {

  		return $this->vegan;
  	}

  	public function setLactosefree($lactosefree = 0) {
        if($lactosefree == 1 || $lactosefree == true) {
            $this->lactosefree = 1;
            return $this;
        } else {
            $this->lactosefree = 0;
        }
        return false;
  	}

  	public function getLactosefree() {

  		return $this->lactosefree;
  	}

  	public function setGlutenfree($glutenfree = 0) {
        if($glutenfree == 1 || $glutenfree == true) {
            $this->glutenfree = 1;
            return $this;
        } else {
            $this->glutenfree = 0;
        }
        return false;
  	}

  	public function getGlutenfree() {

  		return $this->glutenfree;
  	}
	
	public function toArray() {
		$array = array (
					'ID' => $this->ID,
					'name' => $this->name,
					'userID' => $this->userID,
                    'vegetarian' => $this->vegetarian,
                    'vegan' => $this->vegan,
                    'lactosefree' =>$this->lactosefree,
                    'glutenfree' => $this->glutenfree
				);
		
		return $array;
	}
}