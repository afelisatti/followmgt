<?php

	require_once('define.php');

	$elem = $_GET["elem"];

	$fmgt = new followmgt();
	
	if (!$fmgt->carryOn()){
		echo "ERROR";
	}
	$res = $fmgt->follow($elem);

	echo json_encode($res);
?>