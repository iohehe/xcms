<?php
class view{

    public $view_dir;
    public $_data = array();


    public function __construct()
    {
       $this->user_view_dir = TEMPLATE_DIR.'user/';
       $this->user_compile_dir = DATA_DIR.'user_tpl_cache/';
    }


    public function display($file_name=null){
        // load the assign data
       if (!empty($this->_data))
       {
           //TODO: Unknow the extract cant register the variable
           $data = array('a'=>'aaa', 'b'=>'bbb');
           extract($data,EXTR_PREFIX_SAME, 'data');
           $this->_data = array();
       }

       // load the static template
       if ($file_name == null)
       {
           $file_name = 'header.html';
       }

       $compile_file = $this->user_compile_dir.$file_name.'.cache.php';

        if (is_file($this->user_view_dir.$file_name))
       {
           $view_content = $this->loadViewContent($this->user_view_dir.$file_name);
           // a cache here(which has be compiled)
           $this->createCompilerFile($compile_file, $view_content);
       }
       else
       {
           exit('Xcms: template is not exist');
       }

       // key
       include($compile_file);
    }


    protected function loadViewContent($file_name){
        $view_content = file_get_contents($file_name);
        return $this->handleViewFile($view_content);
    }


    protected function handleViewFile($view_content){
            // you can achieve a template module like smarty
            $regex_array = array(
                '/{xcms-\$(.+?)}/is'
            );

            $replace_array = array(
                "<?php echo \$\\1;?>"
            );

            return preg_replace($regex_array ,$replace_array ,$view_content);
    }


    protected function createCompilerFile($compile_file, $view_content){
        $dir_name = dirname($compile_file);
        if (is_dir($dir_name))
        {
            file_put_contents($compile_file, $view_content, LOCK_EX);
        }
        else
        {
            exit('xcms: no this directory');
        }
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

}