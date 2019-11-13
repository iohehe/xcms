<?php

class account extends base{
        public function indexAction(){
            $this->session->start();
            $db_user_info = $this->model->getOne('user', 'name', $_SESSION['user_name']);
            $this->view->assign($db_user_info);
            $this->view->display('account');
        }

        public function uploadProfileAction(){
            var_dump($_FILES);
            var_dump($_SERVER['REQUEST_METHOD']);
            if ($_SERVER['REQUEST_METHOD']==='POST'&&$_POST['submit']==='Submit')
            {

                $check_mime = array('image/png','image/jpg','image/gif','image/jpeg');
                if (in_array($_FILES['profile']['type'], $check_mime))
                {
                    echo 'ok';
                }
                else
                {
                    exit('Xcms: profile file type error');
                }

                if ($_FILES['profile']['error']===0)
                {
                   $upload_path = DATA_DIR.'upload/'.$_FILES['profile']['name'];
                   if(!move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path))
                   {
                       exit('Xcms: profile save error');
                   }
                   else
                   {
                       $this->model->upload('user', 'profile', $_FILES['profile']['name'])->where('name', $_SESSION['user_name']);
                   }
                }
                else
                {
                    exit('Xcms: profile upload error');
                }
            }
            else
            {
                exit('Xcms: method error');
            }
        }
}