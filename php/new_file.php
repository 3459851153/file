<?php
	include './Verification code.php';
	$start = new start();
	$start->eveone("pixle");
	session_start();
	$_SESSION["code"] = $start->fimail;
	return $code = $staet->code();
?>