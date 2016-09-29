var app = angular.module("myApp",[]);
app.controller("mainCtrl",function($scope,$http){
	
	var arrayVal = getArrayKeyValPair();
	angular.forEach(arrayVal, function(value, keyQ) {
		console.log(keyQ+" --> "+value);
	});
		
});
function getArrayKeyValPair(){
	var rtnArrayAns = new Object();
	for(i=0; i<10;i++){
		console.log(i);
		rtnArrayAns["Key_"+i] = "Value_"+i;
	}
	console.log("Length := "+rtnArrayAns.length);
	return rtnArrayAns;
}

