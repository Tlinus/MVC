<?php

namespace Core;
	
/**
 * 
 */
class Template
{
	private static $_viewPath = __DIR__.'/../Views/';

	private static $_extension = '.php';

	public static function render($path){
		if (file_exists(self::$_viewPath.$path.self::$_extension)) {
			require_once self::$_viewPath.$path.self::$_extension;
		}
	}
	
}