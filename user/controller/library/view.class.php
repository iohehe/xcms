<?php
if (!defined('IN_XCMS')) exit(1);

class view{

    public $view_dir;
    public $_data = array();

    public function __construct()
    {
       $this->view_dir = TEMPLATE_DIR;
    }

    public function assign($key, $value=null){
        if (!$key)
        {
            return false;
        }
        else if(is_array($key))
        {
            foreach($key as $k=>$v)
            {
                $this->_data[$k] = $v;
            }
        }
        else
        {
           $this->_data[$key]  =  $value;
        }

        return true;
    }


    public function display($file_name=null){
        // load the assign data
       if (!empty($this->_data))
       {
           extract($this->_data, EXTR_PREFIX_SAME, 'data');
           $this->_data = array();
       }

       if (is_file($this->view_dir.$file_name))
       {
           $view_content = $this->loadViewContent($this->view_dir.$file_name);
           // a cache here(which has be compiled)
           $this->createCompilerFile();
       }
       else
       {
           exit('Xcms: template is not exist');
       }
    }

    protected function loadViewContent($file_name){
        $view_content = file__get_contents($file_name);
        return $this->handleViewFile($view_content);
    }

    protected function handleViewFile($view_content){
            // you can achieve a template module like smarty
            return $view_content;
    }

    protected function createCompilerFile($view_content){

    }
}