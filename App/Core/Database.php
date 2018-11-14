<?php

namespace Core;

use \ReflectionClass;
use \ReflectionProperty;

class Database{

	private static $_instance = null;

	public static function connect(){

		if(!self::$_instance){
			try{
				self::$_instance = new \PDO('mysql:dbname=cw21mvc;host=127.0.0.1', 'root', '');
			}catch(Exception $e){
				echo "Connexion Mysql échoué : ".$e->getMessage();
				die;
			}
		}

		return self::$_instance;
	}

	public static function insert($namespace){
		// Model\Utilisateur
		$table = explode('\\', $namespace);
		// [Model, Utilisateur]
		$table = end($table);
		//Utilisateur
		$sql = "INSERT INTO `$table` ";
		$reflect  = new ReflectionClass($namespace);

		//ReflectionProperty::IS_PUBLIC 	(0000 0001)
		//ReflectionProperty::IS_PROTECTED	(0000 0010)
		//ReflectionProperty::IS_PRIVATE	(0000 0100)
		//$reflect->getProperties 			(0000 0111)

		foreach ($reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE) as $key => $value) {

			$property[] 		=	"`".$value->name."`";
			$propertyBind[] 	=	":".$value->name;
		}

		$sql .= "(".join(',', $property).") VALUES (".join(',', $propertyBind).");";

		return $sql;
	}

	public static function update($namespace){
		// Model\Utilisateur
		$table = explode('\\', $namespace);
		// [Model, Utilisateur]
		$table = end($table);
		//Utilisateur

		$sql = "UPDATE `$table` SET ";

		$reflect  = new ReflectionClass($namespace);

		//ReflectionProperty::IS_PUBLIC 	(0000 0001)
		//ReflectionProperty::IS_PROTECTED	(0000 0010)
		//ReflectionProperty::IS_PRIVATE	(0000 0100)
		//$reflect->getProperties 			(0000 0111)

		foreach ($reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE) as $key => $value) {
			if($value->name != 'id'){
				$sql .= "`".$value->name."` = :".$value->name.", " ;
			}
		}
		$sql = trim($sql);
		$sql = rtrim($sql, ',');
		$sql .= " WHERE id = :id ;"; 

		return $sql;

	}

	public static function delete($namespace, $id){
		// Model\Utilisateur
		$table = explode('\\', $namespace);
		// [Model, Utilisateur]
		$table = end($table);
		//Utilisateur

		$sql = "DELETE FROM `$table` ";

		$sql .= "WHERE id = $id ;"; 

		return $sql;
	}

	public static function select($namespace, $filter = []){
		// Model\Utilisateur
		$table = explode('\\', $namespace);
		// [Model, Utilisateur]
		$table = end($table);
		//Utilisateur

		$sql = "SELECT * FROM `$table` ";
		if(count($filter) > 0){
			$count = 0;
			foreach ($filter as $key => $value) {
				if($count == 0){
					$sql .= " WHERE `$key` = :$key ";
				}else{
					$sql .= " AND `$key` = :$key ";
				}
				$count ++;
			}
		}

		return $sql;

	}

}