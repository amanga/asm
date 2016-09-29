<?php 
	class AiccMetadata implements JsonSerializable{
		private $_sessionId;
		private $_error;
		private $_errorText;
		private $_VERSION = '2.2';
		private $_aiccData ;
		private $_lessonLocation;
		private $_lessonStatus;
		private $_time;
		private $_score;
		private $_studentId;
		private $_studentName;

		public function __construct(){
			
		}
		
		public function getSessionId(){
			return $this->_sessionId;
		}
		public function setSessionId($sessionId){
			$this->_sessionId = $sessionId;
		}
		
		public function getError(){
			return $this->_error;
		}
		public function setError($error){
			$this->_error = $error;
		}
		
		public function getErrorText(){
			return $this->_errorText;
		}
		public function setErrorText($errorText){
			$this->_errorText = $errorText;
		}

		public function getVersion(){
			return $this->_VERSION;
		}

		public function getAiccData(){
			return $this->_aiccData;
		}
		public function setAiccData($aiccData){
			$this->_aiccData = $aiccData;
		}

		public function getLessonLocation(){
			return $this->_lessonLocation;
		}
		public function setLessonLocation($lessonLocation){
			$this->_lessonLocation = $lessonLocation;
		}

		public function getLessonStatus(){
			return $this->_lessonStatus;
		}
		public function setLessonStatus($lessonStatus){
			$this->_lessonStatus = $lessonStatus;
		}

		//Time the user spend (hh:mm:ss)
		public function getTime(){
			return $this->_time;
		}
		
		public function setTime($time){
			$this->_time = $time;
		}

		public function getScore(){
			return $this->_score;
		}
		public function setScore($score){
			$this->_score = $score;
		}
		
		public function getStudentId(){
			return $this->_studentId;
		}
		public function setStudentId($studentId){
			$this->_studentId = $studentId;
		}
		
		public function getStudentName(){
			return $this->_studentName;
		}
		public function setStudentName($studentName){
			$this->_studentName = $studentName;
		}
		
		public function jsonSerialize() {
            return [
				'session_id' => $this->_sessionId,				
				'error' => $this->_error,
				'error_text' => $this->_errorText,
				'version' => $this->_VERSION,
				'aicc_data' => $this->_aiccData,
				'lesson_location' => $this->_lessonLocation,
				'lesson_status' => $this->_lessonStatus,
				'student_id' => $this->_studentId,
				'student_name' => $this->_studentName,
				'score' => $this->_score,
				'time' => $this->_time
            ];
        }
	}
	/*
	ERROR=0
	ERROR_TEXT=Successful
	VERSION=2.2
	AICC_DATA=[CORE]
	STUDENT_ID=0123456
	STUDENT_NAME=Doe, John R
	SCORE=83
	TIME=02:35:37
	CREDIT=C
	LESSON_LOCATION=page_1
	LESSON_STATUS=INCOMPLETE
	[Core_Lesson]
	[Objectives_Status] */
?>
