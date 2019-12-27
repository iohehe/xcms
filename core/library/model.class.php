<?php


class model
{
    protected $_conn = null;
    protected $table_name = null;

    public $table = '';
    public $limit = '';
    public $where = '';
    public $sql='';


    public function __construct(){
        $db_config = xcms::loadConfig('database');
        $this->connect($db_config);
    }

    # 居然可以拿到了子类的table_name属性。
    public function find($case){
        echo "<br />";
        $this->where = $case;
        return $this->getOne();
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

    public function table($table_name){
       $this->table = '`'.$table_name.'`';
       return $this;
    }

    public function limit($str){
       $this->limit =  'limit '.$str;
       return $this;
    }

    public function where($key, $value){
       $this->where = 'where '. $key.'='."'".$value."'";
       return $this;
    }

    public function getOne($case){
        #$sql = "select * from $table_name where $key='$value'";
        $this->limit('0, 1');
        $this->sql = "select * from `{$this->table_name}` where {$this->where} {$this->limit};";
        $result = mysqli_query($this->_conn, $this->sql);
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