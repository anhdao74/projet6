<?php

class Autoload
{
	 public function getClass($classname)
	{
		if (file_exists($file = 'controller' . '/' . $classname . '.php'))
		{
			require $file;
			$controller = new $classname;
			return $controller;
		}

		if (file_exists($file = 'manager' . '/' . $classname . '.php'))
		{
			require $file;
			$manager = new $classname;
			return $manager;
		}
		if (file_exists($file = 'view' . '/' . $classname . '.phtml')) 
		{
			require $file;
			$view = new $classname;
			return $view;
		}
	}

	public function register()
	{
		spl_autoload_register([$this, 'getClass']);
	}
}

spl_autoload_register();
