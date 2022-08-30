<?php
class Mysql {
	public function __construct() {
		//数据库信息
		$mysql = array(
			'type' => 'mysql', //数据库类型
			'host' => 'localhost', //用户地址
			'port' => "3306", //默认端口
			'dbname' => 'log', //数据库表名
			'user' => 'root', //数据库名
			'pass' => '123456'//数据库密码
		);
		//链接数据库
		try {
			$this->pdo = new PDO($mysql['type'] . ":host=" . $mysql['host'] . ";port=" . $mysql['port'] . ";dbname=" . $mysql['dbname'], $mysql['user'], $mysql['pass']);
			$this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "数据库链接成功！";
		} catch(PDOException $exception) {
			$this->error($exception);
		}
	
	}
	//报错的代码
	private function error($exception){
		echo "出错文件：" . $exception -> getFile() . '<br>';
		echo "出错行数：" . $exception -> getLine() . '<br>';
		echo "描述出错：" . $exception -> getMessage();
	}
	//注册
	public function register($root_center){
		$this->root($root_center);
		//查看数据库是否有相同的账户
		try{
			$mysql_user = $this->pdo->query("SELECT id FROM root WHERE user = {$this->user}");
			$fetch = $mysql_user->fetch();
			if(!$fetch){
				//验证码
				if($this->yzm == strtolower($_COOKIE ['yzm'])){
					$this->insert();
					echo '<script>alert("注册成功！");location.href="../html/log.html"</script>';
				}else{
					echo '<script>alert("验证码错误！");history.go(-1);</script>';
					die;
				}
			}
			else echo '<script>alert("已有账户！");history.go(-1);</script>';
			die;
		}catch(PDOException $exception) {
			$this->error($exception);
		}
	}
	//注册用户注册信息放入数据库中
	private function insert(){
		$mysql_cententall = $this->pdo->query("select * from root");
		$fetch = $mysql_cententall->fetchAll();
		$fetch_len = count($fetch) + 1;
		$this->pdo->exec("INSERT INTO root(id,user,pass) VALUES({$fetch_len},'{$this->user}','{$this->pass}')");
	}
	//登录
	public function log($root_center){
		$this->root($root_center);
		$mysql_user = $this->pdo->query("SELECT id FROM root WHERE user = {$this->user}");
		$fetch = $mysql_user->fetch();
		//验证码
		if($this->yzm == strtolower($_COOKIE ['yzm'])){
			if(!$fetch) {
				echo '<script>alert("没有该账户！");location.href="../index.html"</script>'; die;
			}else{
				$mysql_user = $this->pdo->query("SELECT pass FROM root WHERE user = {$this->user}");
				$fetch = $mysql_user->fetch();
				if($this->pass == $fetch['pass']){
					session_start();
					$time = $this->time == ""?0:time() + $this->time;
					setcookie("user",$this->user,$time,'/');
					setcookie("pass",password_hash($this->pass,PASSWORD_BCRYPT),$time,'/');
					echo '<script>alert("登录成功！");location.href="../index.html";</script>';
				}
				else{
					echo '<script>alert("密码错误！");history.go(-1);</script>';
					die;
				}
			}
		}else{
			echo '<script>alert("验证码错误！");history.go(-1);</script>';
			die;
		}
	}
	//退出登录
	public function EXIT($root_center){
		$this->root($root_center);
		session_start();
		setcookie("user","",0,'/');
		setcookie("pass","",0,'/');
		try{
			$this->pdo = null;
			echo '<script>alert("安全退出！");location.href="../index.html";</script>';
			die("安全退出！");
		}catch(Exception $exception){
			$this->error($exception);
		} 
	}
	//获取账户和密码
	private function root($root_center){
		//用户信息
		$this->user = $root_center["user"];
		$this->pass = $root_center["pass"];
		$this->yzm = $root_center["yzm"];
		$this->time = $root_center["time"];
	}
}
?>