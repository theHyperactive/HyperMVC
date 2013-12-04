<?php

class Database {
	
	protected static $db;
	protected static $host;
	protected static $dbname;
	protected static $username;
	protected static $password;
	protected static $port;
	
	static function set_connection(){
		$root = realpath($_SERVER["DOCUMENT_ROOT"]).'/';
		require($root.'config/database.php');		
		self::$host = $database['host'];
		self::$dbname = $database['database_name'];
		self::$username = $database['username'];
		self::$password = $database['password'];
		self::$port = $database['port'];
	}

	static function connect(){
		$dsn = 'mysql:host='.self::$host.';dbname='.self::$dbname.';port='.self::$port;
		if (self::$db == null) {
			self::$db = new PDO($dsn, self::$username, self::$password);
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$db;
	}	
}


# Set Database details based on config
Database::set_connection();
