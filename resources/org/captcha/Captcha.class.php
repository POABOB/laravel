<?php

class Captcha{

	//照片
	private $img;
	//寬
	private $width = 100;
	//高
	private $height = 40;
	//照片顏色
	private $bgColor = '#ffffff';
	//驗證碼
	public $code;
	//驗證碼的擷取字串
	private $captchaStr = '1234567890abcdefghijklmnopqrstuvwxyz';
	//驗證碼長度
	private $captchaLen = 5;
	//字型
	private $font;
	//字體大小
	private $fontSize = 26;
	//字體顏色
	private $fontColor='';
	public function __constructor(){
	}
	public function make(){
		if(empty($this->font))
		{
			$this->font = __DIR__.'/consolaz.ttf';
		}
		//產生驗證碼
		$this->create();

		header("Content-type:image/png");
		ImagePNG($this->img);
		ImageDestroy($this->img);
		exit;
	}
	//設定驗證碼
	public function font($font){
		$this->font = $font;
		return $this;
	}

	public function fontSize($fontSize){
		$this->fontSize = $fontSize;
		return $this;
	}

	public function fontColor($fontColor){
		$this->fontColor = $fontColor;
		return $this;
	}

	public function width($width){
		$this->width = $width;
		return $this;
	}

	public function height($height){
		$this->height = $height;
		return $this;
	}

	public function bgColor($bgColor){
		$this->bgColor = $bgColor;
		return $this;
	}

	public function captchaLen($captchaLen){
		$this->captchaLen = $captchaLen;
		return $this;
	}


	public function createCaptcha(){
		$captcha='';
		//跑captcha的長度次數
		for($i = 0; $i < $this->captchaLen; $i++){
			//從0~該長度的最後一個
			$captcha .= $this->captchaStr[mt_rand(0, strLen($this->captchaStr) - 1)];
		}
		//轉成大寫
		$this->code = strtoupper($captcha);
		$_SESSION['code'] = $this->code;
		
	}

	//把產生好的驗證碼存入SESSION
	public function get(){
		if(isset($_SESSION['code']))
			return $_SESSION['code'];
	}

	public function create(){
		$this->createCaptcha();
		$this->img = ImageCreate($this->width, $this->height);

		$color_bg = ImageColorAllocate($this->img,255,255,255);
		$color_white = ImageColorAllocate($this->img,0,0,0); 

		return imagestring($this->img,$this->fontSize,rand(10,25),rand(10,25), $this->code ,$color_white);

	}

}