/*
	Answers
	@Param: qcId (answer Id)	@Param: qcText (answer text)
	@Param: qcTextType (question text type i.e image/audio/video/text/code)
	@Param: qcCorrectFlag (Correct answer indicator)	
	@Param: qcFlag (whether to show or not.)
*/
var QuestionChoice = function(qcId,qcText,qcTextType,qcCorrectFlag,qcComment,qcDesc,qcFlag,qcOrder,qcSelected){
	this.answerId = qcId;
	this.answerText = qcText;
	this.answerTextType = qcTextType;
	this.answerCorrectFlag = qcCorrectFlag;
	this.answerComment = qcComment;
	this.answerDescription = qcDesc;
	this.answerFlag = qcFlag;
	this.order = qcOrder; //anwers order
	
	this.setOrder = function(orderVal){
		this.order = orderVal
	}
};

/*
	Question and Collection of answers.
	@Param: qId (question Id)	@Param: qText (question text)
	@Param: qTextType (question text type i.e image/audio/video/text/code)
	@Param: qType (Type of a question i.e single/multi answer)	
	@Param: qAnswers (Collection of answers.)
	@Param: qFlag (whether to show or not.)
*/
var Question = function(qId,qText,qSubText,qTextType,qType,qAnswers,qComment,qDesc,qFlag,qOrder,qSelected,qExplanation,qRequired){
	this.questionId = qId;
	this.questionText = qText;
	this.questionSubText = qSubText;
	this.questionTextType = qTextType
	this.questionType = qType;
	this.questionAnswers = qAnswers; // array of Answers
	this.questionComment = qComment;
	this.questionDescription = qDesc;
	this.questionFlag = qFlag;
	this.order = qOrder; // question order for a particular questionBlock.
	this.selected = qSelected;
	this.questionExplanation =  qExplanation;
	this.required = qRequired;
	
	this.setOrder = function(orderVal){
		this.order = orderVal
	}
	this.setSelected = function(selectedVal){
		this.selected = selectedVal;
	}
};

/*
	Question block is collection of questions
	@param: qbId (question block id)
	@param: qbText (question block Title)
	@param: qbQuestions (collection of questions for this particular block)
	@param: qbRandomizeFlag (whether to randomize the questios for this block)
	@param: qbNoteInfo (important information that need to be noted.)	
	@param: qbFlag (whether to show or not)
*/
var QuestionBlock = function(qbId,qbText,qbQuestions,qbRandomizeFlag,qbNoteInfo,qbComment,qbDesc,qbFlag,qbOrder,qbSelected){
	this.qBlockId = qbId;
	this.qBlockText = qbText;
	this.qBlockQuestions = qbQuestions; //Collection of Questions
	this.qBlockRandomizeFlag = qbRandomizeFlag; //to randomize the questions for this block while loading this block.
	this.qBlockNoteInfo = qbNoteInfo; //important information related to this block
	this.qBlockComment = qbComment; 
	this.qBlockDescription = qbDesc;
	this.qBlockFlag = qbFlag; // whether to show or not 
	this.order = qbOrder; // question block order.
	this.selected = qbSelected;
	
	this.setOrder = function(orderVal){
		this.order = orderVal
	}
	
	this.setSelected = function(selectedVal){
		this.selected = selectedVal;
	}
}; //Collection of Question's

/*
	Assessment is collection of question blocks
	@param: asmId (Assessment id)
	@param: asmText (Assessment Title)
	@param: asmQBlocks (collection of question blocks)
	@param: asmQBlockTextFlag (whether to show the question block title or not.)
	@param: asmQBlockRandomizeFlag (flag to randomize the questions or not.)
	@param: asmNoteInfo (an important note for the assessment)
	@param: asmDesc (assessment description)
	@param: asmFlag (tell whether the assessment is active or not)
*/
var Assessment = function(asmId,asmText,asmQBlocks,asmQBlockTextFlag,asmQBlockRandomizeFlag,asmNoteInfo,asmComment,asmDesc,asmFlag){
	this.assessmentId = asmId;
	this.assessmentText = asmText;
	this.assessmentQBlocks = asmQBlocks; //Collection of question blocks for this assessment.
	this.assessmentQBlockTextFlag = asmQBlockTextFlag; // whether to show the title of the question block or not.
	this.assessmentQBlockRandomizeFlag = asmQBlockRandomizeFlag; //whether the blocks to be randomize for this assessment.
	this.assessmentNoteInfo = asmNoteInfo; // important note for the assessment.
	this.assessmentComment = asmComment;
	this.assessmentDesc = asmDesc;
	this.assessmentFlag = asmFlag;
	
	this.questionRandomize = false;
	this.answersRandomize = false;
	
	this.askNumOfQuestions  = 10;
	this.passingScore = 0;
	
	this.isAllQuestions = false;	
	
	this.setAllQuestionsFlag = function(value){
		this.isAllQuestions = value;
	}
	
	this.setAskNumOfQuestions = function(value){
		this.askNumOfQuestions = value;
	}
	this.getAskNumOfQuestions = function(){
		return this.askNumOfQuestions;
	}
	
	this.setPassingScore = function(value){
		this.passingScore = value;
	}
	this.getPassingScore = function(){
		return this.passingScore;
	}
	
	//returns the question blocks.
	this.getQuestionBlocks = function(){
		return this.assessmentQBlocks;
	}
	//returns a question block by Id.
	this.getQuestionBlock = function(id){
		var colQBlocks =  this.assessmentQBlocks;
		for(i=0; i<colQBlocks.length; i++){
			var qBlock = colQBlocks[i];
			if(qBlock.qBlockId == id){
				return qBlock;
				break;
			}
		}
		return null;
	}
	
	this.getNumOfSelectedQuestionsInQBlock = function(id){
		var qBlock = this.getQuestionBlock(id);
		return this.getNumOfQuestionsSelectedInArray(qBlock.qBlockQuestions);
	}
	
	//returns the question blocks.
	this.getAllQuestions = function(){
		var rtnAllQuestions = new Array();
		var questionBlocks = this.getQuestionBlocks();		
		for(i=0; i<questionBlocks.length; i++){			
			var questionBlock = questionBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for(j=0; j<colQuestions.length; j++){
				rtnAllQuestions.push(colQuestions[j]);
			}
		}
		return rtnAllQuestions;
	}
	
	//returns the selected question.
	this.getSelectedQuestions = function(){
		var questionBlocks = this.getQuestionBlocks();
		var rtnAllQuestions = new Array();
		var counter = 0;
		for(i=0; i<questionBlocks.length; i++){
			var questionBlock = questionBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for( j= 0 ; j<colQuestions.length; j++){
				var question = colQuestions[j];
				if(question.selected == "1"){
					rtnAllQuestions.push(colQuestions[j]);
				}
			}
		}
		return rtnAllQuestions;
	}
	
	//returns the number of selected questions.
	this.getNumOfSelectedQuestions = function(){
		return this.getSelectedQuestions().length;
	}
	
	//returns a question block by Id.
	this.getQuestion = function(qId){
		var questionBlocks = this.getQuestionBlocks();
		var rtnQuestion;
		for(i=0; i<questionBlocks.length; i++){
			var questionBlock = questionBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for(j=0;j<colQuestions.length; j++){
				rtnQuestion = colQuestions[j];
				if(rtnQuestion.questionId == qId){
					return 	rtnQuestion;
					break;
				}
			}
		}
		return null;
	}
	
	this.getCorrectAnswers = function(qId){
		var rtnColAnswers = new Array();
		var questionObj = this.getQuestion(qId);
		var colAnswers = questionObj.questionAnswers;
		for(i=0;i<colAnswers.length; i++){
			var rtnAnswer = colAnswers[i];
			if(rtnAnswer.answerCorrectFlag == '1'){
				rtnColAnswers.push(rtnAnswer.answerId);
			}
		}
		return 	rtnColAnswers;
	}
	
	this.getNumOfQuestionsSelectedInArray = function(arrayQuestions){
		var counter = 0;
		for(j=0;j<arrayQuestions.length; j++){
			rtnQuestion = arrayQuestions[j];
			if(rtnQuestion.selected == "1"){
				counter = counter + 1;
			}
		}
		return counter;
	}
	
	//returns number of question blocks
	this.getNumberOfBlocks = function(){		
		return this.assessmentQBlocks.length;	
	}
	
	//returns number of questions
	this.getTotalNumberOfQuestions = function(){
		var numQuestions = 0;
		for(i=0;i<this.assessmentQBlocks.length;i++){
			var questionBlock =  this.assessmentQBlocks[i];
			numQuestions = numQuestions + questionBlock.qBlockQuestions.length;
		}
		return numQuestions;
	}
	
	this.selectAllQuestions = function(){
		var questionBlocks = this.getQuestionBlocks();				
		for(i=0; i<questionBlocks.length; i++){
			var questionBlock = questionBlocks[i];
			questionBlock.setSelected("1");
			var colQuestions = questionBlock.qBlockQuestions;
			for( j= 0 ; j<colQuestions.length; j++){
				var question = colQuestions[j];
				question.setSelected("1");
			}
		}		
	}
	
	//sets the select to 1 for all required questions.
	this.selectRequiredQuestions = function(){
		var questionBlocks = this.getQuestionBlocks();				
		for(i=0; i<questionBlocks.length; i++){
			var questionBlock = questionBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for( j= 0 ; j<colQuestions.length; j++){
				var question = colQuestions[j];
				if(question.required =="1")
					question.setSelected("1");
			}
		}
	}
	
	//sets the order for each questionblock
	this.resetQuestionBlockOrder = function(){
		for(i=0;i<this.assessmentQBlocks.length;i++){
			var questionBlock =  this.assessmentQBlocks[i];
			questionBlock.setOrder(parseInt(questionBlock.order)+parseFloat(getCustomizedRandomNum()));
		}
	}
	//sets the order for each question in a questionblock.
	this.resetQuestionOrder = function(){
		for(i=0;i<this.assessmentQBlocks.length;i++){
			var questionBlock =  this.assessmentQBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for(j=0; j<colQuestions.length;j++){
				var question = colQuestions[j];
				question.setOrder(parseInt(question.order)+parseFloat(getCustomizedRandomNum()));
			}
		}
	}
	//sets the order for each question in a questionblock.
	this.resetAnswerOrder = function(){
		for(i=0;i<this.assessmentQBlocks.length;i++){
			var questionBlock =  this.assessmentQBlocks[i];
			var colQuestions = questionBlock.qBlockQuestions;
			for(j=0; j<colQuestions.length;j++){
				var question = colQuestions[j];
				var colAnswers = question.questionAnswers;
				for(k=0; k<colAnswers.length;k++){
					var answer = colAnswers[k];
					answer.setOrder(parseInt(answer.order)+parseFloat(getCustomizedRandomNum()));
				}
			}
		}
	}
	//sets the Selection of questions
	this.resetQuestionSelected = function(){
		var selectedCounter = 0;
		if((this.isAllQuestions) || (this.getTotalNumberOfQuestions() < this.askNumOfQuestions)){
			console.log("Number of questions to be asked is less then questions that assessment contains.");
			console.log("Ask all questions");
			this.selectAllQuestions();
		}else{
			// console.log("First select all the required questions");
			this.selectRequiredQuestions();
			// console.log("After Required, iterate till the reset of questions got selected.");
			while(selectedCounter < this.askNumOfQuestions){
				var rndmQBIndex = randomIntNumber(0,this.getNumberOfBlocks());
				var qBlock = this.getQuestionBlocks()[rndmQBIndex];
				if(qBlock.selected == "0"){
					qBlock.setSelected("1");
				}
				var colQuestions = qBlock.qBlockQuestions;
				var rndmQIndex = randomIntNumber(0,colQuestions.length);
				if(colQuestions[rndmQIndex].selected == "0"){
					colQuestions[rndmQIndex].selected = ""
					colQuestions[rndmQIndex].setSelected("1");
					selectedCounter = selectedCounter + 1;
				}
			}
		}
	}
	
	this.getSortedQuestionBlocks = function(){
		var colQBlocks =  this.assessmentQBlocks;
		return colQBlocks.sort(compare);
	}
	
	this.getSortedQuestions = function(qBlockId){
		var qBlock = this.getQuestionBlock(qBlockId);
		var colQuestions = qBlock.qBlockQuestions;
		return colQuestions.sort(compare);
	}
	
	this.getSortedQChoice = function(qId){
		var allQuestions = this.getAllQuestions();
		for(i=0; i<allQuestions.length; i++){
			var question = allQuestions[i];
			if(question.questionId == qId){
				
				var questionChoices = question.questionAnswers;
				return questionChoices.sort(compare);
			}
		}
		return null;
	}
}; //Collection of QuestionBlock's

var FinalizedAssessment = function(asm){
	this.asmObj = asm;
	this.finalizedAsm;
	
	this.setAsm = function(_finalizedAsm){
		this.finalizedAsm = _finalizedAsm;
	}
	this.getAsm = function(){
		return this.finalizedAsm;
	}
	this.constructAsm = function(){
		var _asmObj = this.asmObj;
		var _colQBlocks = this.getColSelectedQBlocks(_asmObj.assessmentQBlocks);
		var _finalAsm = new Assessment(_asmObj.assessmentId,_asmObj.assessmentText,_colQBlocks,_asmObj.assessmentQBlockTextFlag,_asmObj.assessmentQBlockRandomizeFlag,_asmObj.assessmentNoteInfo,_asmObj.assessmentComment,_asmObj.assessmentDesc,_asmObj.assessmentFlag);
		_finalAsm.setAskNumOfQuestions(_asmObj.askNumOfQuestions);
		_finalAsm.setPassingScore(_asmObj.passingScore);
		this.setAsm(_finalAsm);
	}
	
	this.getColSelectedQBlocks = function(colQBlocks){
		var _rtnColQBlocks = new Array();
		for(i=0; i<colQBlocks.length; i++){
			var _qBlock = colQBlocks[i];
			if(_qBlock.selected == "1"){
				var _qbQuestions = this.getColSelectedQuestions(_qBlock.qBlockQuestions);
				var _tmpQBlock = new QuestionBlock(_qBlock.qBlockId,_qBlock.qBlockText,_qbQuestions,_qBlock.qBlockRandomizeFlag,_qBlock.qBlockNoteInfo,_qBlock.qBlockComment,_qBlock.qBlockDescription,_qBlock.qBlockFlag,_qBlock.order,_qBlock.selected);
				_rtnColQBlocks.push(_tmpQBlock);
			}
		}
		return _rtnColQBlocks;
	}
	
	this.getColSelectedQuestions = function(colQuestions){
		var _rtnColQuestions = new Array();
		for(j=0;j<colQuestions.length;j++){
			var _question = colQuestions[j];
			if(_question.selected == "1"){
				_rtnColQuestions.push(_question);
			}
		}
		return _rtnColQuestions;
	}	
	this.constructAsm();
};

function getCustomizedRandomNum(){
	return (Math.random()).toFixed(7);
}

function compare(obj1, obj2) {
	if(obj1.order < obj2.order)
		return -1;
	if(obj1.order > obj2.order)
		return 1;
	return 0;
}

function randomIntNumber(min,max)
{
    return Math.floor(Math.random()*(max-min)+min);
}

function debugMsg(mssg){
	console.log(mssg);
}

var TempObj = function(id,order){
	this.id = id;
	this.order = order;
	
	this.toString = function(){
		return "[id:="+this.id+"] - [order:="+this.order+"]";
	}
};

var UserSelectedQuestion = function(key,value){
}