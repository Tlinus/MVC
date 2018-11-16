<?php

namespace Models;
use \Core\Database;
use \PDO;

Class Generique{
	
	public $id = null;

	public function __construct($data = []){
		if($data){
			foreach ($this as $key => $value) {
				$this->$key = isset($data[$key]) ? $data[$key] : NULL;
			}
		}
		
	}

	static function find($param = []){
		$db = Database::connect();
		$stmt = $db->prepare(Database::select(get_called_class(), $param));

		foreach ($param as $key => $value) {
			$stmt->bindValue(':'.$key, $value, gettype($value) === "boolean" ? PDO::PARAM_BOOL : PDO::PARAM_STR);
		}

		$stmt->execute();


		return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}

	static function findOne($param = []){
		$result = self::find($param);
		return count($result) > 0 ? $result[0] : null; 	
	}
	
	static function insert($object){
		$db = Database::connect();
		$stmt = $db->prepare(Database::insert(get_called_class()));

		foreach ($object as $key => $value) {
			$stmt->bindValue(':'.$key, $value, gettype($value) === "boolean" ? PDO::PARAM_BOOL : PDO::PARAM_STR);

		}
		return  $stmt->execute() ? $db->lastInsertId() : $stmt->errorInfo();
		
	}

	static function update($object){
		$db = Database::connect();
		$stmt = $db->prepare(Database::update(get_called_class()));

		foreach ($object as $key => $value) {
			$stmt->bindValue(':'.$key, $value, gettype($value) === "boolean" ? PDO::PARAM_BOOL : PDO::PARAM_STR);

		}

		// var_dump($stmt);
		// die;
		return  $stmt->execute() ? true : $stmt->errorInfo();
	}

	static function updateAttribute($data){
		$db = Database::connect();
		$stmt = $db->prepare(Database::updateAttribute(get_called_class(), $data));

		foreach ($data as $key => $value) {
			$stmt->bindValue(':'.$key, $value, gettype($value) === "boolean" ? PDO::PARAM_BOOL : PDO::PARAM_STR);

		}

		// var_dump($stmt);
		// die;
		return  $stmt->execute() ? true : $stmt->errorInfo();
	}

	static function delete($object){
		$db = Database::connect();
		$stmt = $db->prepare(Database::delete(get_called_class(), $object->id));

		return $stmt->execute() ? true : $stmt->errorInfo();


	}	
}