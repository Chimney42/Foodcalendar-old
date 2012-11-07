<?php

class Calendar {

	protected $userID;
	protected $dishID;
	protected $date;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			
			$this->setUserID((int)$values['userID']);
			
			$this->setDishID((int)$values['dishID']);
			
			$this->setDate($values['date']);
		}
	
	}
	
	public function setUserID($userID) {
		
		if(is_int($userID) && $userID > 0 && count($userID) <= 5) {
		
			$this->userID = $userID;
		
			return $this;
			
		} 
		return false;

	}
	
	public function getUserID() {
		
		return $this->userID;
	}
	
	
	
	public function setDishID($dishID) {
		
		if(is_int($dishID) && $dishID > 0 && count($dishID) <= 5){
			
			$this->dishID = $dishID;
			return $this;
		}
		return false;
	}

	
	public function getdishID() {
		
		return $this->dishID;
		
	}
	
	public function setDate($date) {
		
		if(!empty($date) && is_string($date)) {
			
			$this->date = $date;
			
			return $this;
		}
		return false; 
	}
	
	public function getDate() {
		
		return $this->date;
	}
	
	public function toArray() {
		$array = array (
					'userID' => $this->userID,
					'dishID' => $this->dishID,	
					'date' => $this->date,	
				);
		
		return $array;
	}
	
}
