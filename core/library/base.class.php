<?php
class base
{

    protected $view;

    public function __construct(){
        $this->view = $this::loadLibraryClass('view');
        $this->model = $this::loadLibraryClass('model');
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

    // get,post取前过滤
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
}

