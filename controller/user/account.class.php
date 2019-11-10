<?php

class account extends base{
        public function indexAction(){
            $this->session->start();
            $db_user_info = $this->model->getOne('user', 'name', $_SESSION['user_name']);
            $this->view->assign($db_user_info);
            $this->view->display('account');
        }
}