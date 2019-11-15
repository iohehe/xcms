<?php
    function _after($string, $flag){

        if (!is_bool(strpos($string, $flag)))
        {
            return substr($string, strpos($string, $flag)+strlen($flag));
        }
        else
        {
            return false;
        }
    }
