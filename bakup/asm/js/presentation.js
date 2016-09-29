var app = angular.module("myApp",[]);

var userSelectionQs = new Object();
app.controller("mainCtrl",function($scope,$http){
	$scope.debug = true;
	$scope.tests = "Angular js";
	var url="scripts/test.php";
	$http.get(url).success(function(response){
		var asmVal = angular.fromJson(response);
		asmVal.askNumOfQuestions = 5;
		$scope.asm = asmVal;
		var asmObj = getAssessment(asmVal,false);		
		$scope.asm = asmObj;
	});
	$scope.userSelectedStr ="";
	
	var colAns = new Array();
	$scope.questionChoice = function(val) {
	
		var selectedObj = $("#"+val.qchs.answerId)[0];
		var qId = val.$parent.qtn.questionId;
		var ansId = val.qchs.answerId;
		
		if (qId in userSelectionQs) {
			console.log("Key Exists in the queue:="+ qId);
			colAns = userSelectionQs[qId];
		}else{
			colAns = new Array();
		}
		
		if((selectedObj.type == "radio")){
			console.log("Radio....");
			colAns = new Array();
			if(selectedObj.checked){
				colAns = addToCollectedAnsArray(colAns,ansId);
			}
		}else{ //checkbox
			console.log("Checkbox....");
			if(!selectedObj.checked){
				//remove
				if(colAns.indexOf(ansId)>-1){
					console.log("Removing the ansId:="+ansId);
					colAns = removeFromoCollectedAnsArray(colAns,ansId);
				}
			}else{
				colAns = addToCollectedAnsArray(colAns,ansId);
			}
		}
		
		try{
			userSelectionQs[qId]=colAns;
		}catch(e){
			console.log(e)
		}
		
	} // selected question function end
	$scope.answeredQs = 0;
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
		var askedQs = $scope.asm.askNumOfQuestions;
		if((askedQs - selectedQs) > 0){
			console.log("You have answered "+(askedQs-selectedQs)+" out of "+ selectedQs+". Do you want to continue?");
		}else{
			console.log("Submit the assessment");
		}
	}
	$scope.evaluateAssessment = function() {
		$scope.validateAssessment();
		angular.forEach(userSelectionQs, function(colAns, keyQId) {
			var colAnsSeltd = userSelectionQs[keyQId];
			console.log(keyQId + " -> " + userSelectionQs[keyQId]);
		});
	}
});

function addToCollectedAnsArray(colAns, ansId){
	console.log("Inside := addToCollectedAnsArray");
	var rtnColAns = new Array();
	angular.forEach(colAns, function(value, keyQ) {
		rtnColAns.push(value);
	});
	rtnColAns.push(ansId);
	return rtnColAns;
}

function removeFromoCollectedAnsArray(colAns, ansId){
	console.log("Inside := removeFromoCollectedAnsArray");
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
	asmObj.askNumOfQuestions = asm.askNumOfQuestions;
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