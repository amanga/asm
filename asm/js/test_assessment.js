var questionChoices1 = new QuestionChoice("answer1","Yes","t",true,"answer Choice 1","",true,1,0);
var questionChoices2 = new QuestionChoice("answer2","No","t",false,"answer Choice 2","",true,2,0);
var questionChoices3 = new QuestionChoice("answer3","None","t",false,"answer Choice 2","",true,3,0);
var arrayQuestionChoices =[questionChoices2,questionChoices1];

var question1 = new Question("questionId1","Is String is immutable object?","t","s",arrayQuestionChoices,"Question 1 comments","Java related question",true,2,0,"Explanation1:",0);
var question2 = new Question("questionId2","Is StringBuffer is thread safe?","t","s",arrayQuestionChoices,"Question 2 comments","Java related question",true,1,0,"Explanation2:",0);

var question3 = new Question("questionId3","1 + 1 = 2 ?","t","s",arrayQuestionChoices,"Question 3 comments","Java related question",true,1,0,"Explanation3:",0);
var question4 = new Question("questionId4","3 x 3 = 9 ?","t","s",arrayQuestionChoices,"Question 4 comments","Java related question",true,2,0,"Explanation4:",0);

var arrayQuestions1 =[question1,question2];
var arrayQuestions2 =[question3,question4];

var qblock1 = new QuestionBlock("qbId1","Question Block 1",arrayQuestions1,true,"This are Java String related questions","","",true,1,0);
var qblock2 = new QuestionBlock("qbId2","Question Block 2",arrayQuestions2,true,"This are Math related questions","","",true,1,0);
var arrayQuestionBlock = [qblock1,qblock2]

var asm1 = new Assessment("asmId1","Java basic questions",arrayQuestionBlock,true,true,"Java important basic questions","asmComments","asmDesc",true);

debugMsg("Assessment Title:="+asm1.assessmentText);
debugMsg("Number of Question Blocks:="+asm1.getNumberOfBlocks());
debugMsg("Number of Questions:="+asm1.getNumberOfQuestions());
debugMsg("-----");

debugMsg("Array Of Questions:");
debugMsg(arrayQuestions2.sort(compare));
debugMsg("-----");

debugMsg("Array Of Answers:");
debugMsg(arrayQuestionChoices.sort(compare));
debugMsg("-----");

printQuestionBlockTitle();
debugMsg("-----");

printQuestionBlockTitleByID("qbId1");
debugMsg("-----");

printQuestionTitleByID("questionId2");
debugMsg("-----");

printRandomNumber();
debugMsg("-----");

// printAllQuestionTitle();
// debugMsg("-----");

function printRandomNumber(){
	var tmpArrayObj = new Array();
	
	for(i=0;i<100;i++){
		var rndNumber = getCustomizedRandomNum();
		var tmpObj = new TempObj("ID_"+i , rndNumber);
		tmpArrayObj[i] = tmpObj;
	}
	tmpArrayObj.sort(compare);
	
	for(i=0;i<tmpArrayObj.length;i++){
		debugMsg(tmpArrayObj[i].toString());
	}
}

function printQuestionBlockTitle(){
	debugMsg(">>Printing the QuestionBlock Title");
	var colQBlocks = asm1.getQuestionBlocks();
	for(i=0; i<colQBlocks.length; i++){
		var questionBlock = colQBlocks[i];
		debugMsg(questionBlock.qBlockText);
	}
}

function printQuestionTitleByID(id){
	debugMsg(">>Printing the Question Title for ID:="+id);
	var question = asm1.getQuestion(id);
	if(question != null){
		debugMsg(question.questionText);
	}else{
		debugMsg("unable to find the question");
	}
}
function printQuestionBlockTitleByID(id){
	debugMsg(">>Printing the QuestionBlock Title for ID:="+id);
	var questionBlock = asm1.getQuestionBlock(id);
	if(questionBlock != null){
		debugMsg(questionBlock.qBlockText);
	}else{
		debugMsg("unable to find the question block");
	}	
}

function printAllQuestionTitle(){
	debugMsg(">>Printing the Question Title");
	var allQuestions = asm1.getAllQuestions();
	debugMsg("Number of all Questions : ="+ allQuestions.length);

	for(i=0; i<allQuestions.length; i++){
		var question = allQuestions[i];
		debugMsg(question.questionText);
		var answerChoice = question.questionAnswers;
		for(j=0;j<answerChoice.length;j++){
			var answer = answerChoice[j];
			debugMsg((j+1)+ ".) ["+((question.questionType == 's')?"radio":"checkbox")+"]" + answer.answerText);
		}
		debugMsg(" ");
	}
}


function printKeyValueArray(){
	
}