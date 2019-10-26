<?php


class base
{

    public function __construct()
    {
    }

    public function assign($key, $value=null)
    {
        if (!$key)
        {
            return false;
        }
        else if(is_array($key))
        {
            foreach($key as $k=>$v)
            {
                $this->_options[$k] = $v;
            }
        }
        else
        {
            $this->_options[$key] = $value;
        }
        }


}

