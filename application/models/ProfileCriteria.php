<?php

class ProfileCriteria {

	protected $profileID;
	protected $criteriaID;
	
	public function __construct($values) {

		if(is_array($values) && !empty($values)) {
			
			$this->setProfileID((int)$values['profileID']);
			
			$this->setCriteriaID((int)$values['criteriaID']);
		}
	
	}
	
	public function setProfileID($profileID) {
		
		if(is_int($profileID) && $profileID > 0 && count($profileID) <= 5) {
		
			$this->profileID = $profileID;
		
			return $this;
			
		} 
		return false;

	}
	
	public function getProfileID() {
		
		return $this->profileID;
	}
	
	
	
	public function setCriteriaID($criteriaID) {
		
		if(is_int($criteriaID) && $criteriaID > 0 && count($criteriaID) <= 5){
			
			$this->criteriaID = $criteriaID;
			return $this;
		}
		return false;
	}

	
	public function getCriteriaID() {
		
		return $this->criteriaID;
		
	}
	
	
	public function toArray() {
		$array = array (
					'profileID' => $this->profileID,
					'criteriaID' => $this->criteriaID,	
				);
		
		return $array;
	}
	
}
