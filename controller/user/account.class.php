<?php

class account extends base{

    public function indexAction(){
            $db_user_info = $this->model->getOne('user', 'name', $_SESSION['user_name']);
            $this->view->assign($db_user_info);
            $this->view->display('account');
        }

        public function uploadProfileAction(){
            if ($_SERVER['REQUEST_METHOD']==='POST'&&$_POST['submit']==='Submit')
            {

                $check_mime = array('image/png','image/jpg','image/gif','image/jpeg');

                if (!in_array($_FILES['profile']['type'], $check_mime))
                {
                    exit('Xcms: profile file type error');
                }

                if ($_FILES['profile']['error']===0)
                {
                   $ext_type = _after($_FILES['profile']['name'],'.');
                   $profile_name = date("Yms").rand(100,999).'.'.$ext_type;
                   $upload_path = DATA_DIR.'upload/'.$profile_name;
                   if(!move_uploaded_file($_FILES['profile']['tmp_name'], $upload_path))
                   {
                       exit('Xcms: profile save error');
                   }
                   else
                   {
                       $user_name = $_SESSION['user_name'];
                       $condition = "WHERE `user`.`name`='$user_name'";
                       $this->model->upload('user', 'profile', $profile_name, $condition);
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