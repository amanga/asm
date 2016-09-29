<?php 
	class Answer implements JsonSerializable{
		private $_qcId;
		private $_qcTitle;
		private $_qcTitleType;
		private $_qcCorrectFlag;
		private $_qcComment;
		private $_qcDesc;
		private $_qcFlag;
		private $_qcOrder;
		private $_qcSelected;

		public function __construct($qcId,$qcTitle,$qcTitleType,$qcCorrectFlag,$qcComment,$qcDesc,$qcFlag,$qcOrder,$qcSelected){
			$this->_qcId = $qcId;
			$this->_qcTitle = trim($qcTitle);
			$this->_qcTitleType = $qcTitleType;
			$this->_qcCorrectFlag = $qcCorrectFlag;
			$this->_qcComment = $qcComment;
			$this->_qcDesc = $qcDesc;
			$this->_qcFlag = $qcFlag;
			$this->_qcOrder = $qcOrder;
			$this->_qcSelected = $qcSelected;
		}
		
		public function getId(){
			return $this->_qcId;
		}
		public function setId($qcId){
			$this->_qcId = $qcId;
		}

		public function getTitle(){
			return $this->_qcTitle;
		}
		public function setTitle($qcTitle){
			$this->_qcTitle = $qcTitle;
		}

		public function getTitleType(){
			return $this->_qcTitleType;
		}
		public function setTitleType($qcTitleType){
			$this->_qcTitleType = $qcTitleType;
		}

		public function getCorrectFlag(){
			return $this->_qcCorrectFlag;
		}
		public function setCorrectFlag($qcCorrectFlag){
			$this->_qcCorrectFlag = $qcCorrectFlag;
		}

		public function getComment(){
			return $this->_qcComment;
		}
		public function setComment($qcComment){
			$this->_qcComment = $qcComment;
		}

		public function getDescription(){
			return $this->_qcDesc;
		}
		public function setDescription($qcDesc){
			$this->_qcDesc = $qcDesc;
		}

		public function getFlag(){
			return $this->_qcFlag;
		}
		public function setFlag($qcFlag){
			$this->_qcFlag = $qcFlag;
		}

		public function getOrder(){
			return $this->_qcOrder;
		}
		public function setOrder($qcOrder){
			$this->_qcOrder = $qcOrder;
		}

		public function getSelected(){
			return $this->_qcSelected;
		}
		public function setSelected($qcSelected){
			$this->_qcSelected = $qcSelected;
		}

		public function jsonSerialize() {
            return [
				'ansid' => $this->_qcId,
				'anstitle' => $this->_qcTitle,
				'anstitletype' => $this->_qcTitleType,
				'anscorrectflag' => $this->_qcCorrectFlag,
				'anscomment' => $this->_qcComment,
				'ansdesc' => $this->_qcDesc,
				'ansflag' => $this->_qcFlag,
				'ansorder' => $this->_qcOrder,
				'ansselect' => $this->_qcSelected
            ];
        }
	}
?>

