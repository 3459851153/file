<?php
    class blog{
        public $post;
        public $content;
        public function __construct()
        {
            $this->post = $_POST["state"];
            try{
                if($this->post == 1){
                    $this->a();
                }else if($this->post > 1){
                    $this->all();
                }else{
                    throw new Exception("state值不能为负数或为零！");
                }
            }catch(Exception $e){
                $this->error($e);
            }
        }
        private function error($e){
            echo "出错文件：" . $e -> getFile() . '<br>';
		    echo "出错行数：" . $e -> getLine() . '<br>';
		    echo "描述出错：" . $e -> getMessage();
        }
        private function a(){
            $json_flie = json_decode(file_get_contents("smzdm.json"));
            $this->content = json_encode($json_flie[rand(0,count($json_flie))]);
            print_r($this->content);
        }
        private function all(){
            $all_arr = array();
            $json_flie = json_decode(file_get_contents("smzdm.json"));
            for($i=0;$i<$this->post;$i++){
                array_push($all_arr,$json_flie[rand(0,count($json_flie))]);
            }
            print_r(json_encode($all_arr));
        }
    }
    $blog = new blog();
?>