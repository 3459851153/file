<?php
	if(isset($_COOKIE['user'])){
		echo "<span>欢迎您！<b>".$_COOKIE['user']."</b></span><a href='php/mian.php?check=EXIT'>退出登录</a>";
	}else{
		echo "<a href='html/log.html'>登录</a>&nbsp;&nbsp;<a href='html/register.html'>注册</a>";
	}
?>