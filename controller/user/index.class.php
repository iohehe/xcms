<?php
class index extends base{

	public function indexAction(){
	    if (isset($_GET['id']))
        {
            $id = (int)($_GET['id']);
        }
	    else
	    {
            $this->view->display('index');
        }
	}

	public function sayhelloAction(){
	    echo 'hello';
    }
}
