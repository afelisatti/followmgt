<?php

	require_once('define.php');
	
	$follow = new followmgt();
	
	if (!$follow->begin()){
		echo "ERROR";
	}

?>
