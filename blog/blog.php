<?php
    class start{
        public $pdo;
        public function __construct(){
             //数据库信息
            $mysql = array(
                'type' => 'mysql', //数据库类型
                'host' => 'localhost', //用户地址
                'port' => "3306", //默认端口
                'dbname' => 'blog', //数据库表名
                'user' => 'root', //数据库名
                'pass' => '123456'//数据库密码
            );
            //链接数据库
            try {
                $this->pdo = new PDO($mysql['type'] . ":host=" . $mysql['host'] . ";port=" . $mysql['port'] . ";dbname=" . $mysql['dbname'], $mysql['user'], $mysql['pass']);
                $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($_GET['type'] == 'insert') {$this->insert();}
                else  $this->blog_a();
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
        //创建博客内容(渲染博客文章内容)
        private function blog_a(){
            try{
                $blog_query = $this->pdo->query("select * from `blog`");
                $blog_fetch = $blog_query->fetchAll();
                for($i = 0;$i<count($blog_fetch);$i++){
                    echo "<dt><span id='date'>{$blog_fetch[$i]['time']}</span>
                         <p id='center'>{$blog_fetch[$i]['text']}</p></dt>";
               };
            }catch(PDOException $exceptio){
                $this->error($exceptio);
            }
        }
        //用户发布文章（插入数据库）
        private function insert(){
            //查看文章个数id
            $blog_query = $this->pdo->query("select `id` from `blog`");
            $blog_fetch_count = count($blog_query->fetchAll()) + 1;
            try{
                $main = $_POST["article"] ==""?"[空]":$_POST["article"];
                $this->pdo->exec("insert into blog(id,time,`text`) values({$blog_fetch_count},current_date,'{$main['article']}')");
                $this->blog_a();//再次渲染
            }catch(PDOException $exceptio){
                $this->error($exceptio);
            }
        }
    }
$start = new start();
?>