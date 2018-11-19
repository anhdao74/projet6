<?php

class FlashMessageSession
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
        session_start();
        }
		
    }
    
    public function setFlash($message)
    {
        $_SESSION['flash'] = $message;
    }
    
    public function showFlash()
    {
        echo $_SESSION['flash']; 
        unset($_SESSION['flash']);
        $_SESSION['flash'] = false;
    }
    
    public function asMessage()
    {
        if (isset($_SESSION['flash'])) {
            return $_SESSION['flash'];
        } else {
            return false;
	}
    }
}