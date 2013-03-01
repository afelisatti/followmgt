<?php
	require_once('define.php');
	
	$follow = new followmgt();
	if (!$follow->callback()) {
		echo 'ERROR';
	} else {
		header('Location: followback.php');
	}
?>