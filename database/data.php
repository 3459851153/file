<?php
	class database{
		public $pdo;
		public function __construct($e){
			try{
				$this->pdo = new PDO($e['type'] . ':host=' . $e['host'] . ';port=' . $e['port'] . ';dbname=' . $e['dbname'],$e['user'],$e['pass']);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				echo "数据库链接成功!";
			}
			catch(PDOException $exception){
				$this->error($exception);
			}
		}
		private function error($exception){
			echo "错误文件：" . $exception->getFile().'<br>';
			echo "错误文件：" . $exception->getLine().'<br>';
			echo "错误文件：" . $exception->getMessage();
		}
		private function fun($fun,$center){
			switch ($fun) {
				case 'insert_delete_update':
					$this->insert_delete_update($center);
					break;
				case 'select':
					$this->select($center);
					break;
				
				default:
					echo '只有增删改（insert_delete_update），查（select）；两个功能！';
					break;
			}
		}
		//增-删-改(insert_delete_update)
		private function insert_delete_update($center){
			try{
				$this->pdo->exec($center);
			}
			catch(PDOException $exception){
				$this->error($exception);
			}
		}
		//查(select)
		private function select($center){
			try{
				$query = $this->pdo->query($center);
				$fetch = $query->fetchAll();
				print_r($fetch);
				if(!$fetch) throw new PDOException("不存在！");
			}
			catch(PDOException $exception){
				$this->error($exception);
			}
		}
		public function root($type,$center){
			$this->fun($type,$center);
		}
	}
?>