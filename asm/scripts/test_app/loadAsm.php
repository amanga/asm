<?php
	include_once "../dao/AssessmentDao.php";
	
	$asmID = $_GET['id'];
	$asmDao = new AssessmentDao();
	$asm = $asmDao->getAsm($asmID);
	echo json_encode($asm);

	
?>