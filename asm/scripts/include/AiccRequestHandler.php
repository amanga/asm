<?php 
	include_once "AiccMetadata.php";
	include_once "../test_app/mock_aiccData.php";
	
	class AiccRequestHandler implements JsonSerializable{
		public function __construct(){
			
		}
		public function handleRequestGet($request){
			//Based on session id, get user Information for the assessment/unit that is active.
			$rtnObj = getRequest($request['session_id']);
			return $rtnObj;
		}
		
		public function handleRequestPost($request){
			$rtnObj = putRequest($request);
			return $rtnObj;
			/* Based on incomming message, update the user attempt for assessment/unit that is actively finishing.			command=PutParam
			session_id=1
			version=2.0
			AICC_DATA=[core]
			lesson_location=http://support.click2learn.com/ts_test_files/lorenm/81spec20compatibilityflag/index.html#p0
			Lesson_Status=Completed
			Time=00:00:12
			score=67
			[core_lesson]
			_MDP_TESTSTATE_RAWSCORE=2.0
			PAGE ID 0MULTIPLE CHOICE (P0:9)=PREVIOUS_ATTEMPT_COUNT~1~CorrectAnswer~a~0~1~Choice #2~b~1~0~Choice
			#3~c~0~0~Choice #4~d~0~0
			PAGE ID 0TRUE/FALSE (P0:3)=PREVIOUS_ATTEMPT_COUNT~1~CorrectAnswer~a~1~1~False~b~0~0
			_MDP_TESTSTATE__GLOBAL_SEQUENCE=new Array("p0")
			PAGE ID 0FILL IN THE BLANK (P0:10)=PREVIOUS_ATTEMPT_COUNT~1~a~1~yes
			[mercury_data]
			maxtestscore=3.0
			mintestscore=0.0*/
		}
		
		public function handleExitAU($request){
			
		}

		public function parseRequestedInfo($mssg){
			
		}

		function getLineBreaks(){
			return "\n";
		}
		
		function getMockData($request){
			$aiccHandler = new AiccMetadata();
			$aiccHandler->setSessionId($request['session_id']);
			$aiccHandler->setStudentId('ANM_123');
			$aiccHandler->setStudentName('Siva Kumar Sundar');
		}
		
		public function jsonSerialize() {
			return null;           
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
	}
?>
