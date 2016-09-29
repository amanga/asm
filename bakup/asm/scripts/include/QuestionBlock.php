<?php 

	class QuestionBlock implements JsonSerializable{
		private $_qbId;
		private $_qbTitle;
		private $_qbQuestions;
		private $_qbRandomizeFlag;
		private $_qbNoteInfo;
		private $_qbComment;
		private $_qbDesc;
		private $_qbFlag;
		private $_qbOrder;
		private $_qbSelected;
		private $_qbRequired;

		public function __construct($qbId,$qbTitle,$qbQuestions,$qbRandomizeFlag,$qbNoteInfo,$qbComment,$qbDesc,$qbFlag,$qbOrder,$qbSelected,$qbRequired){
			$this->_qbId = $qbId;
			$this->_qbTitle = trim($qbTitle);
			$this->_qbQuestions = $qbQuestions;
			$this->_qbRandomizeFlag = $qbRandomizeFlag;
			$this->_qbNoteInfo = $qbNoteInfo;
			$this->_qbComment = $qbComment;
			$this->_qbDesc = $qbDesc;
			$this->_qbFlag = $qbFlag;
			$this->_qbOrder = $qbOrder;
			$this->_qbSelected = $qbSelected;
			$this->_qbRequired = $qbRequired;
		}
		
		public function getId(){
			return $this->_qbId;
		}
		public function setId($qbId){
			$this->_qbId = $qbId;
		}

		public function getTitle(){
			return $this->_qbTitle;
		}
		public function setTitle($qbTitle){
			$this->_qbTitle = $qbTitle;
		}

		public function getQuestions(){
			return $this->_qbQuestions;
		}
		public function setQuestions($qbQuestions){
			$this->_qbQuestions = $qbQuestions;
		}

		public function getRandomizeFlag(){
			return $this->_qbRandomizeFlag;
		}
		public function setRandomizeFlag($qbRandomizeFlag){
			$this->_qbRandomizeFlag = $qbRandomizeFlag;
		}

		public function getNoteInfo(){
			return $this->_qbNoteInfo;
		}
		public function setNoteInfo($qbNoteInfo){
			$this->_qbNoteInfo = $qbNoteInfo;
		}

		public function getComment(){
			return $this->_qbComment;
		}
		public function setComment($qbComment){
			$this->_qbComment = $qbComment;
		}

		public function getDescription(){
			return $this->_qbDesc;
		}
		public function setDescription($qbDesc){
			$this->_qbDesc = $qbDesc;
		}

		public function getFlag(){
			return $this->_qbFlag;
		}
		public function setFlag($qbFlag){
			$this->_qbFlag = $qbFlag;
		}

		public function getOrder(){
			return $this->_qbOrder;
		}
		public function setOrder($qbOrder){
			$this->_qbOrder = $qbOrder;
		}

		public function getSelected(){
			return $this->_qbSelected;
		}
		public function setSelected($qbSelected){
			$this->_qbSelected = $qbSelected;
		}
		
		public function getRequired(){
			return $this->_qbRequired;
		}
		public function setRequired($qbRequired){
			$this->_qbRequired = $qbRequired;
		}
		
		public function jsonSerialize() {
            return [
				'qbid' => $this->_qbId,
				'qbtitle' => $this->_qbTitle,
				'questions' => $this->_qbQuestions,
				'qbrandom' => $this->_qbRandomizeFlag,
				'qbnote' => $this->_qbNoteInfo,
				'qbcomment' => $this->_qbComment,
				'qbdesc' => $this->_qbDesc,
				'qbflag' => $this->_qbFlag,
				'qborder' => $this->_qbOrder,
				'qbselect' => $this->_qbSelected,
				'qbrequired' => $this->_qbRequired
            ];
        }
	}

?>