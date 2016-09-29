<?php
	include_once "../include/AiccMetadata.php";
	
	function getRequest($sessionId){
		$userMetaData = new AiccMetadata();
		$userMetaData->setSessionId($sessionId);
		$userMetaData->setError("0");
		$userMetaData->setAiccData("[core]");
		$userMetaData->setStudentId("student_1234");
		$userMetaData->setStudentName("Kumar, Sai");
		$userMetaData->setScore("0");
		$userMetaData->setTime("00:00:00");
		
		return $userMetaData;
	}
	
	function putRequest($request){
		file_put_contents("postRequest.txt",$request['aicc_data']);
	}
	
	//echo json_encode(getRequest("1234"));
	
	
?>