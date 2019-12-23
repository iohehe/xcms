<?php
class base
{

    protected $view;
    protected $model;

    public function __construct(){
        $this->view = $this::loadLibraryClass('view');
        $this->model = $this::loadLibraryClass('model');
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

    /**
     * 这里是第一版的model层，构思根据table从具体表的model加载baseModel
     * @param $model
     */
    public function model($model)
    {
        $class_path = USER_MODEL_DIR . $model . '.model.class.php';
        var_dump($class_path);
        if (is_file($class_path)) {
            include($class_path);
            $class_name = $model."Model";
            $load_model = new $class_name;
            return $load_model;
        }
        else
        {
            return null;
        }

    }

    /**
     * 如果要实现全局过滤， 那么在这儿实现了。
     * 注： 全局过滤其实不是一种健壮的开发模式， 因为一旦全局过滤用户的输入就被系统污染了。 可以通过伪全局或者局部过滤
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

