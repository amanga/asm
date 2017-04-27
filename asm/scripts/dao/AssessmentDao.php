<?php
	include_once "../include/dbconnection.php";
	include_once "../include/Assessment.php";
	include_once "../include/QuestionBlock.php";
	include_once "../include/Question.php";
	include_once "../include/Answer.php";

	class AssessmentDao {
		private $dbConn;

		public function __construct(){
			$this->dbConn = new DBConnection();
			
		}
		public function getAllAsm(){
			echo "Get All Assessments";
		}
		public function getAsm($_id){
			//echo "Get Assessment :=".$_id;
			$conn = $this->dbConn->getConnection();

			$asm = null;
			$questionBlocks = null;
			$asmQBlockRandomizeFlag = false;
			$asmQBlockTitleFlag = false;

			$asm_sql = "SELECT * "
				." FROM ASSESSMENT ASM "
				." WHERE ASM.ASSESSMENT_ID = ".$_id;

			$result = $conn->query($asm_sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$questionBlocks = $this->loadQuestionBlocks($_id);
					 $asm = new Assessment($row["ASSESSMENT_ID"],$row["TITLE"],$questionBlocks,$asmQBlockTitleFlag,$asmQBlockRandomizeFlag,$row["NOTE"],$row["COMMENTS"],$row["DESCRIPTION"],$row["STATUS"]);
					//load question blocks
					
					
				}
			}
			$conn->close();
			return $asm;
		}

		function loadQuestionBlocks($_asmID){
			// echo "Load QuestionBlocks".$_asmID;
			$rtnQBlockArray = array();
			$conn = $this->dbConn->getConnection();
			$sql = "SELECT QB.* "
				." FROM QUESTIONBLOCK QB "
				." INNER JOIN ASSESSMENT_MAPPING AM ON AM.QUESTIONBLOCK_ID=QB.QUESTIONBLOCK_ID AND AM.ASSESSMENT_ID=".$_asmID;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$qbQuestions = null;
					$qbRandomizeFlag = 0;
					$qbOrder = 0;
					$qbSelected = 0;
					$qRequired = 0;

					//load questions
					$qbQuestions = $this->loadQuestions($row["QUESTIONBLOCK_ID"]);

					$tmpQBlock = new QuestionBlock($row["QUESTIONBLOCK_ID"],$row["TITLE"],$qbQuestions,$qbRandomizeFlag,$row["NOTE"],$row["COMMENTS"],$row["DESCRIPTION"],$row["DESCRIPTION"],$qbOrder,$qbSelected,$qRequired);
					array_push($rtnQBlockArray,$tmpQBlock);
				}
			}
			$conn->close();
			return $rtnQBlockArray;
		}

		function loadQuestions($_qBlockID){
			$rtnQuestions = array();
			$conn = $this->dbConn->getConnection();
			$sql = "SELECT Q.* "
				." FROM QUESTIONS Q"
				." INNER JOIN QUESTIONBLOCK_MAPPING QM ON QM.QUESTION_ID=Q.QUESTION_ID AND QM.QUESTIONBLOCK_ID=".$_qBlockID;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$qOrder=0;
					$qSelected=0;
					$qRequired=0;
					
					//load answers;
					$qAnswers=$this->loadAnswers($row["QUESTION_ID"]);
					$qType = $this->questionType($qAnswers);
					$tmpQuestion = new Question($row["QUESTION_ID"],$row["TITLE"],$row["SUB_TITLE"],$row["TITLE_TYPE"],$qType,$qAnswers,$row["COMMENTS"],$row["DESCRIPTION"],$row["STATUS"],$qOrder,$qSelected,$row["EXPLANATION"],$qRequired);
					array_push($rtnQuestions, $tmpQuestion);
				}
			}
			$conn->close();
			return $rtnQuestions;
		}

		function loadAnswers($_qID){
			$rtnAnswers = array();
			$conn = $this->dbConn->getConnection();
			$sql = "SELECT A.* "
				." FROM ANSWERS A"
				." WHERE A.QUESTION_ID =".$_qID;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$qcOrder=0;
					$qcSelected=0;

					$tmpAnswer = new Answer($row["ANSWER_ID"],$row["TITLE"],$row["TITLE_TYPE"],$row["CORRECT"],$row["COMMENTS"],$row["DESCRIPTION"],$row["STATUS"],$qcOrder,$qcSelected);
					array_push($rtnAnswers,$tmpAnswer);
				}
			}
			$conn->close();
			return $rtnAnswers;
		}

		function questionType($_answers){
			$count = 0;
			foreach ($_answers as $answer) {
				if($answer->getCorrectFlag()){
					$count = $count +1;
				}
			}
			if($count>1){return "multiple";}else{ return "single";}
			
		}
	}
?>