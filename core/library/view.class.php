<?php
class view{

    public $view_dir;
    public $_data = array();


    public function __construct()
    {
       $this->user_view_dir = TEMPLATE_DIR.'user/';
       $this->user_compile_dir = DATA_DIR.'user_tpl_cache/';
    }

    /**
     * 模版生成
     * @param null $file_name
     */
    public function display($file_name=null){
        // load the assign data
       if (!empty($this->_data))
       {
           extract($this->_data,EXTR_PREFIX_SAME, 'data');

       }

       // load the static template
       if ($file_name == null)
       {
           exit('Xcms: No input template');
       }

       $template_file_path = $this->user_view_dir.$file_name.'.html';
       $compile_file_path = $this->user_compile_dir.$file_name.'.cache.php';

        if (is_file($template_file_path))
       {
           $view_content = $this->loadViewContent($template_file_path);
           // a cache here(which has be compiled)
           $this->createCompilerFile($compile_file_path, $view_content);
       }
       else
       {
           exit('Xcms: template is not exist');
       }

       // key
       include($compile_file_path);
    }


    /**
     * 加载页面模板内容
     * @param $file_name
     * @return string|string[]|null
     */
    protected function loadViewContent($file_name){
        $view_content = file_get_contents($file_name);
        return $this->handleViewFile($view_content);
    }


    /**
     * 对模板内容的处理
     * @param $view_content
     * @return string|string[]|null
     */
    protected function handleViewFile($view_content){
            // 此处进行模板内容替换规则编写
            // like jinja2
            $regex_array = array(
                '#{{ \$(.+?) }}#is',
                '#{{ if\s+(.+?)\s? }}#is',
                '#{{ else }}#is',
                '#{{ endif }}#is',
                '#{{ route_for\((.*)\/(.*)\) }}#is'
            );

            $replace_array = array(
                "<?php echo \$\\1; ?>",
                "<?php if \\1 { ?>",
                "<?php }else{ ?>",
                "<?php } ?>",
                "index.php?c=\\1&a=\\2"
            );

            return preg_replace($regex_array ,$replace_array ,$view_content);
    }

    /**
     * 根据模板内容在指定位置创建替换好的前端文件
     * @param $compile_file
     * @param $view_content
     */
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


    /**
     * 赋值模板变量
     * @param $key
     * @param null $value
     * @return bool
     */
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