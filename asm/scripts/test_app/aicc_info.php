<?php

	include_once "../include/AiccRequestHandler.php";
	$command = strtolower($_REQUEST['command']);
	$session_id = $_REQUEST['session_id'];
	$aiccHandler = new AiccRequestHandler();
	switch($command){
		case 'getparam':
			$aiccObj = $aiccHandler->handleRequestGet($_REQUEST);
			
			$rspnsStr = "Error=".$aiccObj->getError();
			$rspnsStr .=  getLineBreaks()."Error_text=";
			$rspnsStr .=  getLineBreaks()."Aicc_data=".$aiccObj->getAiccData();
			$rspnsStr .=  getLineBreaks()."Student_ID=".$aiccObj->getStudentId();
			$rspnsStr .=  getLineBreaks()."Student_Name=".$aiccObj->getStudentName();
			$rspnsStr .=  getLineBreaks()."Score=".$aiccObj->getScore();
			$rspnsStr .=  getLineBreaks()."Time=".$aiccObj->getTime();
			echo $rspnsStr;
			/*$response_str = "Error="."val";
			$response_str .=  getLineBreaks()."Error_text=";
			$response_str .=  getLineBreaks()."Aicc_data="."[Core]";
			$response_str .=  getLineBreaks()."Student_ID="."Student_id_val";
			$response_str .=  getLineBreaks()."Student_Name="."Student_Name_val";
			$response_str .=  getLineBreaks()."Lesson_Location="."Lesson_Location_val";
			$response_str .=  getLineBreaks()."Lesson_Status="."Not Started_val"; //Not Started, Incomplete, Completed, passed or Failed
			$response_str .=  getLineBreaks()."Lesson_Status="."Lesson_Status_val";
			$response_str .=  getLineBreaks()."Score="."Score_val";
			$response_str .=  getLineBreaks()."Time="."Time_val";
			$response_str .=  getLineBreaks()."[Core_Lesson]";
			echo $response_str;*/
		break;
		case 'putparam':
			$aiccObj = $aiccHandler->handleRequestPost($_REQUEST);
			// file_put_contents("postRequest.txt",$_REQUEST['aicc_data']);
			/*$response_str = "Error="."val123";
			$response_str .=  getLineBreaks()."Error_text=Successful";
			$response_str .=  getLineBreaks()."";*/
			echo $response_str;
		break;
		case 'exitau':
			echo 'exit au METHOD';
		break;
	}
	// exit();

	function getLineBreaks(){
		return "\n";
	}

	ob_clean();
/* ERROR=0
ERROR_TEXT=Successful
VERSION=2.2
AICC_DATA=[CORE]
STUDENT_ID=0123456 //student id
STUDENT_NAME=Doe, John R // student Name
SCORE=83 //score for the attempt course
TIME=02:35:37 //time that student spend
CREDIT=C // C for Credit & N for No-Credit
LESSON_LOCATION=page_1 //last viewed slide or page
LESSON_STATUS=INCOMPLETE // whether the course is Not Started, Incomplete, Completed, Passed or Failed.
[Core_Lesson]
[Objectives_Status] */
?>