<?php
	$root = $_POST["root_yzm"];
	session_start();
	echo $root."123";
	echo $_SESSION['code'];
	if($root == $_SESSION['code']){
		echo '登录成功！';
	}
	else{
		echo "登录失败！";
	}
?>