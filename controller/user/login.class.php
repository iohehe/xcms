<?php

class login extends Base{
    public function indexAction(){
        if (isset($_POST)&&$_POST['submit']!='')
        {
            if (!isset($_SESSION))
            {
                session_start();
            }

            if (!$_POST['captcha']=='')
            {

                exit("Xcms: please input the captcha.");
            }
            if ($_POST['captcha'] != $_SESSION['captcha'])
            {
                $user = $_POST['username'];
                $pwd = $_POST['password'];
                if ($user&&$pwd)
                {
                    $db_user_info = $this->model->getOne('user', 'name', $user);

                    if (!$db_user_info)
                    {
                        echo('<br />Xcms: No user or wrong password<br />');
                    }
                    else
                    {
                        if ($pwd === $db_user_info['password'])
                        {
                            echo "login success";
                        }
                        else
                        {
                            echo('<br />Xcms: No user or wrong password<br />');
                        }
                    }
                }
            }
            else
            {
                exit("Xcms: captcha wrong");
            }


        }
        else
        {
            exit("Xcms: empty form");
        }

        include $this->view->display('login');
    }

    public function captchaAction(){
        $image = self::loadLibraryClass('image');
        $width = $_GET['width'];
        $height = $_GET['height'];
        $image->createCaptcha($width, $height);
    }
}