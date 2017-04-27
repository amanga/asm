<?php
	include_once "../dao/AssessmentDao.php";
	
	$asmDao = new AssessmentDao();
	$asm = $asmDao->getAsm(1);
	echo json_encode($asm);

	
?>