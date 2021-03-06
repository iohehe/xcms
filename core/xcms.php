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
define('USER_MODEL_DIR', XCMS.'model/user/');


/**
 * Class xcms
 */
class xcms{

    // 初始化需要加载的资源放在这
    private static function init(){
        # base是初始化是加载一次请求所需的基本资源
        require_once(LIBRARY_DIR.'base.class.php');
        # common.php是一堆供全局使用工具函数
        require_once ('common.php');
    }

    public static function run(){
        self::init();

        # 选择控制器和方法
		$controller = trim(isset($_GET['c'])?$_GET['c']:'index');
		$action = trim(isset($_GET['a'])?$_GET['a']:'index');

		# 加载所需的资源
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

	// 加载配置文件
	public static function loadConfig($filename='common'){
	    $config_file_path = DATA_DIR.'config/'.$filename.'.config.php';
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
