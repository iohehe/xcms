<?php
class index extends base{


	public function indexAction(){
	    $this->view->assign('template_name','heheda');
		$this->view->display();
	}

}
