<?php
//Entrance
define('IN_XCMS', true);
/**
 * Set Constants
 */
define('DATA_DIR', XCMS.'data/');
define('TEMPLATE_DIR', XCMS.'template/');
define('LIBRARY_DIR', XCMS.'core/library/');
define('USER_CONTROLLER_DIR', XCMS.'controller/user/');


/**
 * Class xcms
 */
class xcms{
    // this may be cool
    private static function init(){
        require_once(LIBRARY_DIR.'base.class.php');
    }

    public static function run(){
        self::init();

		$controller = trim(isset($_GET['c'])?$_GET['c']:'index');
		$action = trim(isset($_GET['a'])?$_GET['a']:'index');

		if (is_file(USER_CONTROLLER_DIR.$controller.'.class.php'))
		{
			include(USER_CONTROLLER_DIR.$controller.'.class.php');
			$object = new $controller();
			if(method_exists($controller, $action.'Action'))
			{
			    // in here you can not write link $object->$action.'Action'();
                // when do that the $action will be converted to a string type not a variable.
			    $action  = $action.'Action';
				$object->$action();
			}
			else
			{
				exit('xcms: Action not found');	
			}
		}
		else
		{
		    echo $controller;
			exit('xcms: Controller not found');
		}
	}

	public static function loadConfig($filename='common'){
	    $config_file_path = DATA_DIR.'config/'.$filename.'.php';
	    if (is_file($config_file_path))
        {
            $config = include($config_file_path);
            return $config;
        }
	    else
        {
            return null;
        }

	}
}
