<?php

class login extends Base{
    public function indexAction(){
        if ($_POST['submit'])
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

        include $this->view->display('login');
    }
}