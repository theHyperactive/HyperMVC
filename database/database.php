<?php

class Database {
	
	protected static $db;
	protected static $host;
	protected static $dbname;
	protected static $username;
	protected static $password;
	protected static $port;
	
	static function set_connection($host, $dbname, $username, $password, $port = 3306){
		self::$host = $host;
		self::$dbname = $dbname;
		self::$username = $username;
		self::$password = $password;
		self::$port = $port;
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
//Database::set_connection('localhost', 'rest', 'root', '');

