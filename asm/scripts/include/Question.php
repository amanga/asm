<?php 
	class Question implements JsonSerializable{
		private $_qId;
		private $_qTitle;
		private $_qSubTitle;
		private $_qTitleType;
		private $_qType;
		private $_qAnswers;
		private $_qComment;
		private $_qDesc;
		private $_qFlag;
		private $_qOrder;
		private $_qSelected;
		private $_qExplanation;
		private $_qRequired;

		public function __construct($qId,$qTitle,$qSubTitle,$qTitleType,$qType,$qAnswers,$qComment,$qDesc,$qFlag,$qOrder,$qSelected,$qExplanation,$qRequired){
			$this->_qId = $qId;
			$this->_qTitle = trim($qTitle);
			$this->_qSubTitle = trim($qSubTitle);
			$this->_qTitleType = $qTitleType;
			$this->_qType = $qType;
			$this->_qAnswers = $qAnswers;
			$this->_qComment = $qComment;
			$this->_qDesc = $qDesc;
			$this->_qFlag = $qFlag;
			$this->_qOrder = $qOrder;
			$this->_qSelected = $qSelected;
			$this->_qExplanation = $qExplanation;
			$this->_qRequired = $qRequired;
		}

		public function getId(){
			return $this->_qId;
		}
		public function setId($qId){
			$this->_qId = $qId;
		}

		public function getTitle(){
			return $this->_qTitle;
		}
		public function setTitle($qTitle){
			$this->_qTitle = $qTitle;
		}

		public function getSubTitle(){
			return $this->_qSubTitle;
		}
		public function setSubTitle($qSubTitle){
			$this->_qSubTitle = $qSubTitle;
		}
		
		public function getTitleType(){
			return $this->_qTitleType;
		}
		public function setTitleType($qTitleType){
			$this->_qTitleType = $qTitleType;
		}

		public function getType(){
			return $this->_qType;
		}
		public function setType($qType){
			$this->_qType = $qType;
		}

		public function getAnswers(){
			return $this->_qAnswers;
		}
		public function setAnswers($qAnswers){
			$this->_qAnswers = $qAnswers;
		}

		public function getComment(){
			return $this->_qComment;
		}
		public function setComment($qComment){
			$this->_qComment = $qComment;
		}

		public function getDescription(){
			return $this->_qDesc;
		}
		public function setDescription($qDesc){
			$this->_qDesc = $qDesc;
		}

		public function getFlag(){
			return $this->_qFlag;
		}
		public function setFlag($qFlag){
			$this->_qFlag = $qFlag;
		}

		public function getOrder(){
			return $this->_qOrder;
		}
		public function setOrder($qOrder){
			$this->_qOrder = $qOrder;
		}

		public function getSelected(){
			return $this->_qSelected;
		}
		public function setSelected($qSelected){
			$this->_qSelected = $qSelected;
		}

		public function getExplanation(){
			return $this->_qExplanation;
		}
		public function setExplanation($qExplanation){
			$this->_qExplanation = $qExplanation;
		}
		
		public function getRequired(){
			return $this->_qRequired;
		}
		public function setRequired($qRequired){
			$this->_qRequired = $qRequired;
		}

		public function jsonSerialize() {
            return [
				'qid' => $this->_qId,
				'qtitle' => $this->_qTitle,
				'qsubtitle' => $this->_qSubTitle,
				'qtitletype' => $this->_qTitleType,
				'qtype' => $this->_qType,
				'answers' => $this->_qAnswers,
				'qcomment' => $this->_qComment,
				'qdesc' => $this->_qDesc,
				'qflag' => $this->_qFlag,
				'qorder' => $this->_qOrder,
				'qselect' => $this->_qSelected,
				'qexplanation' => $this->_qExplanation,
				'qrequired' => $this->_qRequired
            ];
        }
	}
?>


