<?php

class image{
   public function createCaptcha($width=60, $height=24){

       if (!isset($_SESSION))
       {
            session_start();
       }

       // 生成验证码并写入session
       $code = "ABCDEFG1234567";
       $length = 4;
       $captcha_value = '';
       for ($i=0; $i<$length; $i++)
       {
           $char = $code[rand(0, strlen($code)-1)];
           $captcha_value.=$char;
       }
        $_SESSION['captcha'] = strtolower($captcha_value);

       $captcha = imagecreate($width, $height);

       imagecolorallocate($captcha, 255, 255, 255);

       $fontcolor = imagecolorallocate($captcha, rand(0, 200), rand(0, 120), rand(0, 120));

       for ($i = 0; $i < $length; $i++) {
           $fontsize = 5;
           $x = floor($width / $length) * $i + 5;
           $y = rand(0, $height - 15);
           imagechar($captcha, $fontsize, $x, $y, $captcha_value{$i}, $fontcolor);
       }

       $this->outImage($captcha);
   }


   private function outImage($image, $type='png', $file_name = ''){
            header("Content-type: image/". $type);
            $image_fun = 'image'.$type;

            if(empty($file_name))
            {
                $image_fun($image);
            }
            else
            {
                $image_fun($image, $file_name);
            }
            imagedestroy($image);
            exit;
   }
}
