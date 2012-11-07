<?php

class Dish {

	protected $ID;
	protected $name;
	protected $cost;
	protected $rating;
	protected $eateryID;
	protected $vegetarian;
	protected $vegan;
	protected $lactosefree;
	protected $glutenfree;
    protected $created;
    protected $edited;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			$this->setID((int)$values['ID']);
			$this->setName($values['name']);
			$this->setCost((float)$values['cost']);
			$this->setRating((int)$values['rating']);
			$this->setEateryID((int)$values['eateryID']);
			$this->setVegetarian($values['vegetarian']);
			$this->setVegan($values['vegan']);
			$this->setLactosefree($values['lactosefree']);
			$this->setGlutenfree($values['glutenfree']);
            $this->setCreated((int)$values['created']);
            $this->setEdited((int)$values['edited']);
		}

	}
	
	public function setID($ID) {
		if((is_int($ID) && $ID > 0 && count($ID) <= 7) || is_null($ID)) {
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
	
	public function setCost($cost) {
		if(!empty($cost) && is_float($cost)) {
			$this->cost = $cost;
			return $this;
		}
        return false;
	}

	public function getCost() {
		return $this->cost;
	}
	
	public function setRating($rating) {
		if(!empty($rating) && is_int($rating)) {
			$this->rating = $rating;
			return $this;
		}
        return false;
    }
	
	public function getRating() {
		return $this->rating;
	}
	
	
	public function setEateryID($eateryID) {
		if(!empty($eateryID) && is_int($eateryID) && count($eateryID) <= 7) {
			$this->eateryID = $eateryID;
			return $this;
		}
        return false;
	}

	public function getEateryID() {
		return $this->eateryID;
	}
	
	public function setVegetarian ($vegetarian = 0) {
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

    public function setCreated($created) {
        if (is_int($created) && count($created <= 7) && !empty($created)) {
            $this->created = $created;
            return $this;
        }
        return false;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setEdited($edited){
        if (is_int($edited) && count($edited <= 7)) {
            $this->edited = $edited;
            return $this;
        }
        return false;
    }

    public function getEdited() {
        return $this->edited;
    }
	
	public function toArray() {
		$array = array (
					'ID' => $this->ID,
					'name' => $this->name,	
					'cost' => $this->cost,
					'rating' => $this->rating,
					'eateryID' => $this->eateryID,
					'vegetarian' => $this->vegetarian,
					'vegan' => $this->vegan,
					'lactosefree' => $this->lactosefree,
					'glutenfree' => $this->glutenfree,
                    'created' => $this->created,
                    'edited' =>$this->edited
				);
		
		return $array;
	}
	
}