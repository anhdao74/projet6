<?php

class Manager
{
	protected $pdo;

	public function __construct()
	{
		$this->pdo = Db::getConnexionPDO();
	}
}