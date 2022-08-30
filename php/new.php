<?php
//	try{
//		$pdo = new PDO('mysql:host=localhost;dbname=sll','root','123456');
//		if(!$pdo){
//			throw new Exception;
//		}
//			echo '数据库链接成功！';
//	}
//	catch(Exception $e){
//		echo '出错文件：'.$e->getFile().'<br>';
//		echo '出错行数：'.$e->getLine().'<br>';
//		echo '出错描述：'.$e->getMessage();
//	}
	
//		$drivers = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
//	try{
//		$pdo = new PDO('mysql:host=localhost;dbname=sll','root','123456',$drivers);
//		echo "数据库链接成功！";
//	}
//	catch(Exception $e){
//		echo '出错文件'.$e->getFile().'<br>';
//		echo '出错行数'.$e->getLine().'<br>';
//		echo '出错描述'.$e->getMessage();
//	}

	try{
		$pdo = new PDO('mysql:host=localhost;dbname=sll','root','123456');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		echo "数据库链接成功！";
	}
	catch(Exception $e){
		echo '出错文件'.$e->getFile().'<br>';
		echo '出错行数'.$e->getLine().'<br>';
		echo '出错描述'.$e->getMessage();
	}
?>