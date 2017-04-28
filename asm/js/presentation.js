var app = angular.module("myApp",[]);

var defaultQuestionsToAsk = 10;
var defaultPassingScore = 60;

var userSelectionQs = new Object();
app.controller("mainCtrl",function($scope,$http){
	$scope.debug = false;
	$scope.showAnswers = true;
	$scope.totalCorrectlyQsAnswered = 0;
	$scope.totalAskedQs = 0;
	$scope.asmFriendlyMssg = "";

	

	$scope.tests = "Angular js";
	var url="scripts/test_app/loadAsm.php?id=1";
	$http.get(url).success(function(response){
		var asmVal = angular.fromJson(response);
		$scope.asm = asmVal;
		var asmObj = getAssessment(asmVal,false); //boolean to select all questions
		$scope.asm = asmObj;
	});
	
	$scope.userSelectedStr ="";
	
	var colAns = new Array();
	$scope.questionChoice = function(val) {
	
		var selectedObj = $("#"+val.qchs.answerId)[0];
		var qId = val.$parent.qtn.questionId;
		var ansId = val.qchs.answerId;
		
		if (qId in userSelectionQs) {
			debugMssg("Key Exists in the queue:="+ qId);
			colAns = userSelectionQs[qId];
		}else{
			colAns = new Array();
		}
		
		if((selectedObj.type == "radio")){
			colAns = new Array();
			if(selectedObj.checked){
				colAns = addToCollectedAnsArray(colAns,ansId);
			}
		}else{ //checkbox
			debugMssg("Checkbox....");
			if(!selectedObj.checked){
				//remove
				if(colAns.indexOf(ansId)>-1){
					debugMssg("Removing the ansId:="+ansId);
					colAns = removeFromCollectedAnsArray(colAns,ansId);
				}
			}else{
				colAns = addToCollectedAnsArray(colAns,ansId);
			}
		}
		
		try{
			userSelectionQs[qId]=colAns;
		}catch(e){
			debugMssg(e)
		}
		
	} // selected question function end
	
	$scope.processSelectedQs = function(){
		var tmpUserSelectedQs = new Object();
		var count = 0;
		angular.forEach(userSelectionQs, function(colAns, keyQId) {
			var colAnsSeltd = userSelectionQs[keyQId];
			if(colAnsSeltd.length == 0){
			}else{
				tmpUserSelectedQs[keyQId] = colAnsSeltd;
				count = count + 1;
			}
		});
		$scope.answeredQs = count;
		userSelectionQs = tmpUserSelectedQs;
	}
	$scope.validateAssessment = function(){
		$scope.processSelectedQs();
		var selectedQs = $scope.answeredQs;
		var askedQs = $scope.asm.getNumOfSelectedQuestions();
		$scope.asmFriendlyMssg = "You have answered "+ selectedQs +" out of "+ askedQs  +" questions. Do you want to continue?";
		debugMssg("You have answered "+ selectedQs +" out of "+ askedQs  + "questions. Do you want to continue?");
		if((askedQs - selectedQs) > 0){
			$("#myModal").modal({
				backdrop: 'static'
				,keyboard: false
			});
		}else{
			$scope.evaluateAssessment();
		}
	}
	
	$scope.evaluateAssessment = function() {
		$("#myModal").modal("hide");
		//asked number of questions to end user.
		$scope.totalAskedQs = $scope.asm.getNumOfSelectedQuestions();
		$scope.totalNumOfCorrectQs = 0;
		var numOfCorrectQs = 0;
		var socredPercent = 0;
		angular.forEach(userSelectionQs, function(colAns, keyQId) {
			//user selected answers
			var colAnsSeltd = userSelectionQs[keyQId];
			//correct answers from source
			var colCorrectAns = $scope.asm.getCorrectAnswers(keyQId);
			
			var giveScore = true;
			//if question is multi choice, the size 
			if(colAnsSeltd.length >= colCorrectAns.length ){
					giveScore = giveScore && true;
			}else{
				giveScore = giveScore && false;
			}
			
			angular.forEach(colAnsSeltd, function(value, keyQ) {
				if(colCorrectAns.indexOf(value)>-1){
					giveScore = giveScore && true;
				}else{
					giveScore = giveScore && false;
				}
			});
			if(giveScore){
				// $scope.totalNumOfCorrectQs = $scope.totalNumOfCorrectQs + 1;
				numOfCorrectQs = numOfCorrectQs + 1;
			}
			// debugMssg(keyQId + " -> " + userSelectionQs[keyQId]);
			// debugMssg("Correct Answers := "+$scope.asm.getCorrectAnswers(keyQId));
			// debugMssg("Question ["+keyQId+"] is correct "+ giveScore);
		});
		$scope.totalNumOfCorrectQs = numOfCorrectQs;
		$scope.totalPassPercent = (($scope.totalNumOfCorrectQs/$scope.totalAskedQs))*100;
		if($scope.totalPassPercent > $scope.asm.getPassingScore()){
			debugMssg("Passed the Assessment");
		}else{
			debugMssg("Failed the Assessment");
		}
		debugMssg("You have scored ("+$scope.totalNumOfCorrectQs+")/"+"("+$scope.totalAskedQs+")"+  $scope.totalPassPercent +"%");
	}

	$scope.printAssessment = function(printableArea){
		var printContent = document.getElementById(printableArea).innerHTML;
		var popupWin = window.open('', '_blank', 'width=300,height=300');
		popupWin.document.open();
		popupWin.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + printContent + '</body></html>');
		popupWin.document.close();
	}
	$scope.printNot = function(){
		if($scope.debug){
			return "displayBlock";
		}else{
			return "displayNone";
		}
	}
});

function addToCollectedAnsArray(colAns, ansId){
	debugMssg("Inside := addToCollectedAnsArray");
	var rtnColAns = new Array();
	angular.forEach(colAns, function(value, keyQ) {
		rtnColAns.push(value);
	});
	rtnColAns.push(ansId);
	return rtnColAns;
}

function removeFromCollectedAnsArray(colAns, ansId){
	debugMssg("Inside := removeFromCollectedAnsArray");
	var rtnColAns = new Array();
	angular.forEach(colAns, function(value, keyQ) {
		//setting as a default false, to check the condition 
		if((value == ansId)){
			//do jack squat....
		}else{
			rtnColAns.push(value);
		}
	});
	return rtnColAns;
}

function getAssessment(asm,allQuestionsFlag){
	var rtnFinalAsmObj;
	var asmQBlocks = getQuestionBlock(asm.qblocks);
	var asmObj = new Assessment(asm.asmid,asm.asmtitle,asmQBlocks,asm.qbtitleflag,asm.qbrandom,asm.asmnote,asm.asmcomment,asm.asmdesc,asm.asmflag);

	console.log("NumOFQuestion to Ask"+(((asm.askNumOfQuestions==null)||(asm.askNumOfQuestions==undefined))?defaultQuestionsToAsk:asm.askNumOfQuestions));
	console.log("Passing Score"+(((asm.passingScore==null)||(asm.passingScore==undefined))?defaultQuestionsToAsk:asm.passingScore));
	
	//set num of questions to be asked.
	asmObj.setAskNumOfQuestions((((asm.askNumOfQuestions==null)||(asm.askNumOfQuestions==undefined))?defaultQuestionsToAsk:asm.askNumOfQuestions));
	//set passing score for the assessment.
	asmObj.setPassingScore((((asm.passingScore==null)||(asm.passingScore==undefined))?defaultQuestionsToAsk:asm.passingScore));
	asmObj.setAllQuestionsFlag(allQuestionsFlag);
	if(asmObj.assessmentQBlockRandomizeFlag == "1"){
		asmObj.resetQuestionBlockOrder();
		asmObj.resetQuestionOrder();
		asmObj.resetAnswerOrder();
	}
	asmObj.resetQuestionSelected();
	rtnFinalAsmObj = new FinalizedAssessment(asmObj);
	return rtnFinalAsmObj.getAsm();
}

function getQuestionBlock(qBlocks){
	var rtnArrayQBlocks = new Array();
	angular.forEach(qBlocks, function(value,key){
		var arrayQs = getQuestions(value.questions);
		var tmpQBlock = new QuestionBlock(value.qbid,value.qbtitle,arrayQs,value.random,value.qbnote,value.qbcomment,value.qbdesc,value.qbflag,value.qborder,value.qbselect);
		rtnArrayQBlocks.push(tmpQBlock);
	});
	return rtnArrayQBlocks;
}

function getQuestions(arrayQs){
	var rtnArrayQs = new Array();
	angular.forEach(arrayQs, function(value,key){
		var arrayAns = getAnswers(value.answers);
		var tmpQ = new Question(value.qid,value.qtitle,value.qsubtitle,value.qtitletype,value.qtype,arrayAns,value.qcomment,value.qdesc,value.qflag,value.qorder,value.qselect,value.qexplanation,value.qrequired);
		rtnArrayQs.push(tmpQ);
	});
	return rtnArrayQs;
}

function getAnswers(arrayAns){
	var rtnArrayAns = new Array();
	angular.forEach(arrayAns, function(value,key){
		var tmpAns = new QuestionChoice(value.ansid,value.anstitle,value.anstitletype,value.anscorrectflag,value.anscomment,value.ansdesc,value.ansflag,value.ansorder,value.ansselect);
		rtnArrayAns.push(tmpAns);
	});
	return rtnArrayAns;
}

function debugMssg(mssg){
	console.log(mssg);
}