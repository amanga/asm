<?php
	include_once "include/Assessment.php";
	include_once "include/QuestionBlock.php";
	include_once "include/Question.php";
	include_once "include/Answer.php";
	
	function readAssessment($xmlStr){
		$asmId = "JAVA_1";
		$asmTitle = "Basic Java Question";
		$asmQBlocks = array();
		$asmQBlockTitleFlag = false;
		$asmQBlockRandomizeFlag = false;
		$asmNoteInfo = "Assessment Important information";
		$asmComment = "Assessment Comment";
		$asmDescription = "Assessment Description";
		$asmFlag = true;
		
		$asm = null;
		$xmlDoc=new DomDocument('1.0');
		// $xmlStr=getFileData($fPath);
		if(!empty($xmlStr)){
			if($xmlDoc->loadXML($xmlStr)){
				$xPath=new DOMXPath($xmlDoc);
				$nqNode=$xPath->query("root",$xmlDoc);
				if($nqNode->length>0){
					$asmId = $nqNode->item(0)->getAttribute("id");
					$asmQBlockTitleFlag = $nqNode->item(0)->getAttribute("qbtitleflag");
					$asmQBlockRandomizeFlag = $nqNode->item(0)->getAttribute("qbrandomflag");
					$asmFlag = $nqNode->item(0)->getAttribute("flag");
					$asmTitle = $nqNode->item(0)->getElementsByTagName("title")->item(0)->nodeValue;					
					if($nqNode->item(0)->getElementsByTagName("note")->length>0){
						$asmNoteInfo = $nqNode->item(0)->getElementsByTagName("note")->item(0)->nodeValue;
					}					
					if($nqNode->item(0)->getElementsByTagName("comment")->length>0){
						$asmComment = $nqNode->item(0)->getElementsByTagName("comment")->item(0)->nodeValue;
					}					
					if($nqNode->item(0)->getElementsByTagName("description")->length>0){
						$asmDescription = $nqNode->item(0)->getElementsByTagName("description")->item(0)->nodeValue;
					}
					
					$asmQBlocks = readQuestionBlocks($xmlDoc,$asmQBlockRandomizeFlag);
					
					$asm = new Assessment($asmId,$asmTitle,$asmQBlocks,$asmQBlockTitleFlag,$asmQBlockRandomizeFlag,$asmNoteInfo,$asmComment,$asmDescription,$asmFlag);
				}else{
					echo "Invalid file schema.";
				}
			}
		}
		return $asm;
	}	
		
	function readQuestionBlocks($xmlDoc,$_qbRandomizeFlag){
		$rtnQBlockArray = array();
		
		$qbId = "";
		$qbTitle = "";
		$qbQuestions = array();
		$qbRandomizeFlag ="";
		$qbNoteInfo = "";
		$qbComment = "";
		$qbDesc = "";
		$qbFlag = "";
		$qbOrder = "";
		$qbSelected = "";
				
		$xPath=new DOMXPath($xmlDoc);
		$nqNode=$xPath->query("root/questionblocks/questionblock",$xmlDoc);
		if($nqNode->length>0){
			$qbRandomizeFlag = $_qbRandomizeFlag;
			foreach($nqNode as $nodeItem){
				$qbId = $nodeItem->getAttribute("id");
				$qbFlag = $nodeItem->getAttribute("flag");
				$qbOrder = $nodeItem->getAttribute("order");
				$qbSelected = $nodeItem->getAttribute("selected");
				$qRequired = "0";
				
				$qbTitle = $nodeItem->getElementsByTagName("title")->item(0)->nodeValue;
				if($nodeItem->getElementsByTagName("note")->length>0){
					$qbNoteInfo = $nodeItem->getElementsByTagName("note")->item(0)->nodeValue;
				}					
				if($nodeItem->getElementsByTagName("comment")->length>0){
					$qbComment = $nodeItem->getElementsByTagName("comment")->item(0)->nodeValue;
				}					
				if($nodeItem->getElementsByTagName("description")->length>0){
					$qbDesc = $nodeItem->getElementsByTagName("description")->item(0)->nodeValue;
				}
				// echo "<b>Question Block Id[".$qbId."] :=".$qbTitle."</b><br/>";
				$qbQuestions = readQuestions($xmlDoc,$qbId);
								
				$tmpQBlock = new QuestionBlock($qbId,$qbTitle,$qbQuestions,$qbRandomizeFlag,$qbNoteInfo,$qbComment,$qbDesc,$qbFlag,$qbOrder,$qbSelected,$qRequired);
				array_push($rtnQBlockArray,$tmpQBlock);
			}
		}
		return $rtnQBlockArray;
	}
	
	function readQuestions($_xmlDoc,$_qBlockId){
		$rtnQuestions = array();
		$qId = "";  //attribute
		$qTitle = "";
		$qSubTitle = "";
		$qTitleType = "";  //attribute
		$qType = "";  //attribute
		$qAnswers = array();
		$qComment = "";
		$qDesc = "";
		$qFlag = ""; //attribute
		$qOrder = "";  //attribute
		$qSelected = "";  //attribute
		$qExplanation = "";
		
		$xPath=new DOMXPath($_xmlDoc);
		$nqNodes=$xPath->query("root/questionblocks/questionblock[@id='".$_qBlockId."']/questions/question",$_xmlDoc);
		if($nqNodes->length>0){
			foreach($nqNodes as $qNode){
				$qId = $qNode->getAttribute("id");
				$qTitle = $qNode->getElementsByTagName("title")->item(0)->nodeValue;
				$qSubTitle = $qNode->getElementsByTagName("subtitle")->item(0)->nodeValue;
				$qTitleType = "text";
				$qType = $qNode->getAttribute("type");
				$qFlag = $qNode->getAttribute("flag");
				$qOrder = $qNode->getAttribute("order");
				$qSelected = $qNode->getAttribute("selected");
				$qSelected = "0";
				$qRequired = "0";
				
				if($qNode->getElementsByTagName("explanation")->length>0){
					$qExplanation = $qNode->getElementsByTagName("explanation")->item(0)->nodeValue;
				}					
				if($qNode->getElementsByTagName("comment")->length>0){
					$qComment = $qNode->getElementsByTagName("comment")->item(0)->nodeValue;
				}					
				if($qNode->getElementsByTagName("description")->length>0){
					$qDesc = $qNode->getElementsByTagName("description")->item(0)->nodeValue;
				}
				// echo "Question Id[".$qId."] :=<p><b>".$qTitle."</b></p><p>".$qSubTitle."</p><br/>";
				$qAnswers = readAnswer($_xmlDoc,$_qBlockId,$qId);
				$tmpQuestion = new Question($qId,$qTitle,$qSubTitle,$qTitleType,$qType,$qAnswers,$qComment,$qDesc,$qFlag,$qOrder,$qSelected,$qExplanation,$qRequired);
				array_push($rtnQuestions, $tmpQuestion);
			}
		}
		return $rtnQuestions;
	}
	
	function  readAnswer($_xmlDoc,$_qBlockId,$_qId){
		$rtnAnswers = array();
		$qcId = "";
		$qcTitle = "";
		$qcTitleType = "";
		$qcCorrectFlag = "";
		$qcComment = "";
		$qcDesc = "";
		$qcFlag = "";
		$qcOrder = "";
		$qcSelected = "";
		
		$xPath=new DOMXPath($_xmlDoc);		
		$nqNodes=$xPath->query("root/questionblocks/questionblock[@id='".$_qBlockId."']/questions/question[@id='".$_qId."']/answers/answer",$_xmlDoc);
		if($nqNodes->length>0){
			foreach($nqNodes as $aNode){
				$qcId = $aNode->getAttribute("id");
				$qcOrder = $aNode->getAttribute("order");
				$qcSelected = $aNode->getAttribute("selected");
				$qcCorrectFlag = $aNode->getAttribute("correct");
				
				$qcFlag = "1";
				$qcTitleType = "text";
				
				$qcTitle = $aNode->getElementsByTagName("title")->item(0)->nodeValue;
				
				if($aNode->getElementsByTagName("comment")->length>0){
					$qcComment = $aNode->getElementsByTagName("comment")->item(0)->nodeValue;
				}					
				if($aNode->getElementsByTagName("description")->length>0){
					$qcDesc = $aNode->getElementsByTagName("description")->item(0)->nodeValue;
				}
				// echo "Answer Id[".$qcId."_".(($qcCorrectFlag=="1")?"Y":"N")."] :=".$qcTitle."<br/>";
				$tmpAnswer = new Answer($qcId,$qcTitle,$qcTitleType,$qcCorrectFlag,$qcComment,$qcDesc,$qcFlag,$qcOrder,$qcSelected);
				array_push($rtnAnswers,$tmpAnswer);
			}
		}
		return $rtnAnswers;
	}
	
	function getFileData($fPath){
		return file_get_contents($fPath);
	}
	
	$fPath = "xml/java_sample.xml";
	$xmlStr=getFileData($fPath);
	if(!empty($xmlStr)){
		$asm = readAssessment($xmlStr);
	}
	/* echo $asm->getId()."<br/>";
	echo $asm->getTItle()."<br/>"; */
	echo json_encode($asm);
?>