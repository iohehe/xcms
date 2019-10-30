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
}

