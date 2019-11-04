<?php

class session{

    protected static $_start = false;


   public static function start(){
           if (self::$_start === true)
           {
               return true;
           }
           session_start();
           self:$_start = false;
           return true;
    }

   public static function set($key, $value=null){
       if (!$key)
       {
           return false;
       }

       if (self::$_start === false)
       {
            self::start() ;
       }
       $_SESSION[$key] = $value;
       return true;
   }

   public static function get($key){
       if (!$key)
       {
           return false;
       }
       if (self::$_start === false)
       {
           self::start();
       }
       return $_SESSION[$key];
   }

   public static function delete($key){
        if (!$key)
        {
            return false;
        }
        else if(!isset($_SESSION[$key]))
        {
            return false;
        }
            unset($_SESSION[$key]) ;
            return true;

   }

   public static function clear(){
        $_SESSION = array();
        return true;
   }

   public static function destory(){
        if (self::$_start === true)
        {
            unset($_SESSION);
            session_destroy();
        }
        return true;
   }
}
