<?php


class model
{
    protected $_conn = null;
    protected $table_name = null;


    public function __construct(){
        $db_config = xcms::loadConfig('database');
        $this->connect($db_config);
    }

    public function connect($config){
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

        @ $this->_conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
        if(mysqli_connect_errno())
        {
            exit('Xcms: error to connect');
        }
    }


    public function getOne($table_name, $key, $value=null){
        $sql = "select * from $table_name where $key='$value'";
        $result = mysqli_query($this->_conn, $sql);
        $num = mysqli_num_rows($result);
        for ($i=0; $i<$num; $i++)
        {
            $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }

    public function upload($table_name, $key, $value, $condition=null){
        $sql = "UPDATE `$table_name` SET `$key`='$value' $condition";
        if(mysqli_query($this->_conn, $sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}