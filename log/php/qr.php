<?php
class start {
	function __construct() {
		if (!extension_loaded("gd")) {
			die("加载失败");
		}
	}

	private function chek() {
		if ($this -> type == "line") {
			//验证码为干扰线
			$this -> creat();
			$this -> line();
		} else if ($this -> type == "pixle") {
			//验证码为干扰点
			$this -> creat();
			$this -> pixle();
		} else {
			//验证码为干扰线和干扰点
			$this -> creat();
			$this -> pixle_line();
		}
	}

	//创建图层
	private function creat() {
		$this -> img = imagecreate(200, 50);
		$this -> color = imagecolorallocate($this -> img, 255, 255, 255);
		$this -> font();
	}

	//文字
	public function font() {
		$font = "abcdefghijk1234567890ABCDEFGHIJK";
		$fimail = array();
		for ($i = 0; $i < 4; $i++) {
			$rand = mt_rand(0, strlen($font));
			array_unshift($fimail, $font[$rand]);
		}
		$this -> fimail = implode('', $fimail);
	}

	//循环创建干扰线和干扰点
	private function f($judge) {
		for ($i = 0; $i < 200; $i++) {
			$x = mt_rand(0, 200);
			$y = mt_rand(0, 100);
			$red = rand(0, 255);
			$blue = rand(0, 255);
			$green = rand(0, 255);
			$color = imagecolorallocate($this -> img, $red, $green, $blue);
			if ($judge == "pixle") {
				imagesetpixel($this -> img, $x, $y, $color);
			} else if ($judge == "line") {
				$x2 = mt_rand(0, 200);
				$y2 = mt_rand(0, 100);
				imageline($this -> img, $x, $y, $x2, $y2, $color);
			} else {
				imagesetpixel($this -> img, $x + 20, $y + 20, $color);
				$x2 = mt_rand(0, 200);
				$y2 = mt_rand(0, 100);
				imageline($this -> img, $x, $y, $x2, $y2, $color);
			}
		}
		$ttf = realpath("../fontfile/font.ttf");
		imagettftext($this -> img, 32, 0, 50, 40, $color, $ttf, $this -> fimail);
	}

	//点
	private function pixle() {
		$this -> f("pixle");
		$this -> fabu();
	}

	//线
	private function line() {
		$this -> f("line");
		$this -> fabu();
	}

	//点线
	private function pixle_line() {
		$this -> f("pixle_line");
		$this -> fabu();
	}

	//发布
	private function fabu() {
		header("content-type:image/png");
		imagepng($this -> img);
		imagedestroy($this -> img);
	}

	public function eveone($type) {
		$this -> type = $type;
		$this -> chek();
	}

	public function text() {
		return $this -> fimail;
	}

}
	$start = new start();
	$start->eveone("pixle");
	setcookie('yzm',$start->text());
?>