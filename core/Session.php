<?php

namespace app\core;

class Session
{
    //to identify flash messages so that they can be marked to be removed
    protected const FLASH_KEY = 'flash_message';

    /**
     * constructor
     */
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];      //get session variables where marked as flash key
        foreach($flashMessages as $key => &$flashMessage){      //for all the flash key messages
            //Mark this message to be removed at end of request
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;            //then set this array as the session flash key array
    }

    /** 
     * set a new flash message
     * @param(session var key, message)
    */
    public function setFlash(string $key, string $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $message,
            'remove' => false       //false till request runs once
        ];
    }

    /**
     * returns corresponding session flash message
     * @param session var key
     * @return value of key
     */
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * remove the marked session variables and update array
     */
    public function __destruct()
    {
        //Iterate marked and remove 'em
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage){
            if($flashMessage['remove'] == true){        //returns whether remove property of variable is true
                unset($flashMessages[$key]);            //remove if true
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;    //update session flash messages array
    }

    /** 
     * set a new session variable
    */
    public function set( $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /** 
     * get value of given session variable key
    */
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * remove given session variable
     */
    public function remove($key)
    {
        unset($_SERVER[$key]);
    }
}
?>