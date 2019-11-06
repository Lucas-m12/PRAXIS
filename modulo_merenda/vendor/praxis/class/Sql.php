<?php 
namespace Praxis;

use \PDO;

header('Content-Type: text/html; charset=utf-8');


class Sql extends PDO {

	private $conn;

	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=EDUCAPELA", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statement, $key, $value);

		}

	}

	private function setParam($statement, $key, $value){

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()){

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function lastId($rawQuery, $params = array()){

		$this->conn->beginTransaction();

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		$id = $this->conn->lastInsertId();

		$this->conn->commit();

		return $id;

	}

}

 ?>