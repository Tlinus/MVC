<?php

namespace Core;

class Autoloader{
	public static function register(){
		spl_autoload_register([__CLASS__, 'autoload']);
	}	

	public static function autoload($classname){
		$filename = __DIR__.'/../'.str_replace('\\', '/', $classname).'.php';

		if (file_exists($filename)) {
			require_once $filename;
		}
	}
}