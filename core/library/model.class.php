<?php


class model
{
    protected $_conn = null;

    public function __construct(){
        $db_config = xcms::loadConfig('database');
        self::connect($db_config);
    }

    public static function connect($config){
        if (!is_array($config))
        {
           exit('Xcms: no database config file');
        }
        $db_host = trim($config['host']);
        $db_user = trim($config['db_user']);
        $db_pwd = trim($config['db_pwd']);
        $db_port = trim($config['db_port']);
        $db_name = trim($config['db_name']);
        $db_prefix = trim($config['db_prefix']);

        @ $_conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
        if(mysqli_connect_errno())
        {
            exit('Xcms: error to connect');
        }

    }

}