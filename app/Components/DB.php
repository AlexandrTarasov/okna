<?php

namespace AppComp;

use PDO;

class DB 
{
	static $conf = [
		'host'     => DB_HOSTNAME,
		'dbname'   => DB_DATABASE,
		'user'     => DB_USERNAME,
		'password' => DB_PASSWORD,
	];
	protected $db;

	public function __construct()
	{
		$this->db = new PDO("mysql:host=".self::$conf['host'].";dbname=".self::$conf['dbname'].";charset=utf8",self::$conf['user'], self::$conf['password']);	
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $this->db;
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function lastId()
	{
		return $this->db->lastInsertId();
	}

	public function update($sql)
	{	
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount() ?? false;

	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}
}
