<?php

class PDOConnection {
	private static $dbhost = "127.0.0.1";
	private static $dbname = "gestiondegastos";
	private static $dbuser = "mvcuser";
	private static $dbpass = "1234";
	private static $db_singleton = null;

	public static function getInstance() {
		if (self::$db_singleton == null) {
			self::$db_singleton = new PDO(
			"mysql:host=".self::$dbhost.";dbname=".self::$dbname.";charset=utf8", 
			self::$dbuser,
			self::$dbpass,
			array( 
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			)
		);
	}
	return self::$db_singleton;
}
}
