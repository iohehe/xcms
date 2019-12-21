<?php
class base
{

    protected $view;
    protected $model;

    public function __construct(){
        $this->view = $this::loadLibraryClass('view');
        $thist->model = $this::loadLibraryClass('model');
        $this->session = $this::loadLibraryClass('session');
    }

    public static function loadLibraryClass($classname, $init=1){
            static $loaded_classes = array();
            $key = md5($classname);

            if (isset($loaded_classes[$key]))
            {
                return $loaded_classes[$key];
            }

            if(is_file(LIBRARY_DIR.$classname.'.class.php'))
            {
                include(LIBRARY_DIR.$classname.'.class.php');
                $name = $classname;

                if($init)
                {
                    $loaded_classes[$key]  = new $classname;
                }
                else
                {
                    $loaded_classes[$key] = true;
                }
                return $loaded_classes[$key];
            }
            else
            {
                return false;
            }
    }

    public function loadModelClass($model){
        if (is_file(USER))
    }

    /**
     * 如果要实现全局过滤， 那么在这儿实现了。
     * @param $string
     * @return string|null
     */
    public static function get($string){
        if (!isset($_GET[$string]))
        {
            return null;
        }
        if (!is_array($_GET[$string]))
        {
            return trim($_GET[$string]);
        }
        return null;
    }

    public static function post($string){
        if (!isset($_POST[$string]))
        {
            return null;
        }
        if (!is_array($_POST[$string]))
        {
            return trim($_POST[$string]);
        }
        else
        {
            return $_POST[$string];
        }
    }

    // 所有提示信息
    public static function showMessage($msg)
    {
        echo $msg;
        exit;
    }

    // 跳转
    public function jumpAction($msg, $url=NLL, $wait=3){
        echo "<!DOCTYPE><html><head><meta http-equiv='Refresh' content='".$wait."; URL=".$url."' </head>";
        echo "<meta http-equiv='Content-Type'content='text/html; charset=utf-8'>";
        echo '<h4>Login Success</h4>';
        exit();
    }
}

