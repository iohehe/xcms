<?php
class index extends base{

	public function indexAction(){
	    $this->view->assign('user_name',$_SESSION['user_name']);
        $this->view->display('index');
	}

	public function sayhelloAction(){
	    echo 'hello';
    }
}
