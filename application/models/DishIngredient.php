<?php

class DishIngredient {

	protected $dishID;
	protected $ingredientID;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			
			$this->setDishID((int)$values['dishID']);
			
			$this->setIngredientID((int)$values['ingredientID']);
		}
	
	}
	
	public function setDishID($dishID) {
		
		if(is_int($dishID) && $dishID > 0 && count($dishID) <= 5) {
		
			$this->dishID = $dishID;
		
			return $this;
			
		} 
		return false;

	}
	
	public function getDishID() {
		
		return $this->dishID;
	}
	
	
	
	public function setIngredientID($ingredientID) {
		
		if(is_int($ingredientID) && $ingredientID > 0 && count($ingredientID) <= 5){
			
			$this->ingredientID = $ingredientID;
			return $this;
		}
		return false;
	}

	
	public function getIngredientID() {
		
		return $this->ingredientID;
		
	}
	
	
	public function toArray() {
		$array = array (
					'dishID' => $this->dishID,
					'ingredientID' => $this->ingredientID,	
				);
		
		return $array;
	}
	
}
