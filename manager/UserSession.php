<?php

class UserSession
{
	public function __construct()
	{
		if (!isset($_SESSION))
		{
        	session_start();
    	}
		
	}
	public function signIn()
	{
		$_SESSION['user'] = TRUE;
 
	}
	public function logOut()
	{
		$_SESSION['user'] = FALSE;
		session_destroy();
 
	}
	public function isLogged()
	{
		if (isset($_SESSION['user'])) 
        {
       		return $_SESSION['user'];
        }  
       		return FALSE;     
	}
	
}