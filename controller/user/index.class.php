<?php
class index extends base{


	public function indexAction(){
       $this->view->display('index');
	}

	public function sayhelloAction(){
	    echo 'hello';
    }
}
