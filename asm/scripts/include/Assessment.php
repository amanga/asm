<?php
	class Assessment implements JsonSerializable{
		private $_asmId;
		private $_asmTitle;
		//Array of question blocsk.
		private $_asmQBlocks;
		private $_asmQBlockTitleFlag;
		private $_asmQBlockRandomizeFlag;
		private $_asmNoteInfo;
		private $_asmComment;
		private $_asmDescription;
		private $_asmFlag;
		
		private $_askNumOfQuestions;
		private $_passingScore;

		public function __construct($asmId,$asmTitle,$asmQBlocks,$asmQBlockTitleFlag,$asmQBlockRandomizeFlag,$asmNoteInfo,$asmComment,$asmDescription,$asmFlag)
		{
			$this->_asmId = $asmId;
			$this->_asmTitle = trim($asmTitle);
			$this->_asmQBlocks = $asmQBlocks;
			$this->_asmQBlockTitleFlag = $asmQBlockTitleFlag;
			$this->_asmQBlockRandomizeFlag = $asmQBlockRandomizeFlag;
			$this->_asmNoteInfo = $asmNoteInfo;
			$this->_asmComment = $asmComment;
			$this->_asmDescription = $asmDescription;
			$this->_asmFlag = $asmFlag;
		}
			
		public function getId(){
			return $this->_asmId;
		}
		public function setId($asmId){
			$this->_asmId = $asmId;
		}

		public function getTitle(){
			return $this->_asmTitle;
		}
		public function setTitle($asmTitle){
			$this->_asmTitle = $asmTitle;
		}

		public function getQuestionBlocks(){
			return $this->_asmQBlocks;
		}
		public function setQuestionBlocks($asmQBlocks){
			$this->_asmQBlocks = $asmQBlocks;
		}

		public function getQuestionBlockTitleFlag(){
			return $this->_asmQBlockTitleFlag;
		}
		public function setQuestionBlockTitleFlag($asmQBlockTitleFlag){
			$this->_asmQBlockTitleFlag = $asmQBlockTitleFlag;
		}

		public function getQuestionBlockRandomizeFlag(){
			return $this->_asmQBlockRandomizeFlag;
		}
		public function setQuestionBlockRandomizeFlag($asmQBlockRandomizeFlag){
			$this->_asmQBlockRandomizeFlag = $asmQBlockRandomizeFlag;
		}

		public function getNoteInfo(){
			return $this->_asmNoteInfo;
		}
		public function setNoteInfo($asmNoteInfo){
			$this->_asmNoteInfo = $asmNoteInfo;
		}

		public function getComment(){
			return $this->_asmComment;
		}
		public function setComment($asmComment){
			$this->_asmComment = $asmComment;
		}

		public function getDescription(){
			return $this->_asmDescription;
		}
		public function setDescription($asmDescription){
			$this->_asmDescription = $asmDescription;
		}

		public function getFlag(){
			return $this->_asmFlag;
		}
		public function setFlag($asmFlag){
			$this->_asmFlag = $asmFlag;
		}
		
		public function getAskNumOfQuestions(){
			return $this->_askNumOfQuestions;
		}
		public function setAskNumOfQuestions($askNumOfQuestions){
			$this->_askNumOfQuestions = $askNumOfQuestions;
		}
		
		public function getPassingScore(){
			return $this->_passingScore;
		}
		public function setPassingScore($passingScore){
			$this->_passingScore = $passingScore;
		}
		
		
		public function jsonSerialize() {
            return [
				'asmid' => $this->_asmId,
				'asmtitle' => $this->_asmTitle,
				'qblocks' => $this->_asmQBlocks,
				'qbtitleflag' => $this->_asmQBlockTitleFlag,
				'qbrandom' => $this->_asmQBlockRandomizeFlag,
				'asmnote' => $this->_asmNoteInfo,
				'asmcomment' => $this->_asmComment,
				'asmdesc' => $this->_asmDescription,
				'asmflag' => $this->_asmFlag,
				'askNumOfQuestions' =>  $this->_askNumOfQuestions,
				'passingScore' => $this->_passingScore
            ];
        }
	}
?>