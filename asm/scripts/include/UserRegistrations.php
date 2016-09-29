<?php 
class UserRegistrations implements JsonSerializable{
	private $_userRegistrationId;
	private $_userId;
	private $_assessmentId;
	private $_createdOn;
	private $_createdBy;
	private $_lastmodifiedOn;
	private $_lastmodifiedBy;
	private $_status;
	private $_removed;
	private $_description;
	private $_comments;
	
	public function getUserRegistrationId(){
		return $this->_userRegistrationId;
	}
	public function setUserRegistrationId($userRegistrationId){
		$this->_userRegistrationId = $userRegistrationId;
	}
	
	public function getUserId(){
		return $this->_userId;
	}
	public function setUserId($userId){
		$this->_userId = $userId;
	}
	
	public function getAssessmentId(){
		return $this->_assessmentId;
	}
	public function setAssessmentId($assessmentId){
		$this->_assessmentId = $assessmentId;
	}
	
	public function getCreatedOn(){
		return $this->_createdOn;
	}
	public function setCreatedOn($createdOn){
		$this->_createdOn = $createdOn;
	}
	
	public function getCreatedBy(){
		return $this->_createdBy;
	}
	public function setCreatedBy($createdBy){
		$this->_createdBy = $createdBy;
	}
	
	public function getLastmodifiedOn(){
		return $this->_lastmodifiedOn;
	}
	public function setLastmodifiedOn($lastmodifiedOn){
		$this->_lastmodifiedOn = $lastmodifiedOn;
	}
	
	public function getLastmodifiedBy(){
		return $this->_lastmodifiedBy;
	}
	public function setLastmodifiedBy($lastmodifiedBy){
		$this->_lastmodifiedBy = $lastmodifiedBy;
	}
	
	public function getStatus(){
		return $this->_status;
	}
	public function setStatus($status){
		$this->_status = $status;
	}
	
	public function getRemoved(){
		return $this->_removed;
	}
	public function setRemoved($removed){
		$this->_removed = $removed;
	}
	
	public function getComments(){
		return $this->_comments;
	}
	public function setComments($comments){
		$this->_comments = $comments;
	}
}

?>


