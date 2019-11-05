<?php

class login extends Base{
    public function indexAction(){
        if ($_POST['submit'])
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->db->setTableName('user');
        }

       include $this->view->display('login');
    }
}