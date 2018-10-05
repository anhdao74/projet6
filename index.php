<?php
require_once('Autoload.php');

$autoload = new Autoload;
$autoload->register();

$routeur = new Routeur;

$action = $routeur->getAction();

call_user_func($action);