<?php
	echo '<pre>';
	require("data.php");
	require('base.php');
	$start = new database($root);
	$center = "
		SELECT `name` FROM `one` where `name` = '123';
	";
	$start->root("select",$center);
?>