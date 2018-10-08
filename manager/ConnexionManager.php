<?php

class ConnexionManager extends Manager
{
	function verifModel($login, $pass)
	{
	    $req=$this ->pdo->prepare('SELECT id,login, pass FROM users WHERE login= :login AND pass= :pass');
	    $req ->execute(array('login'=>$login, 'pass'=>$pass));
	    $user = $req->fetch();
	    return $user;
	}
}