<?php

	/**
	 * 
	 */

	namespace Core;
	use \ReflectionCLass;
	use \ReflectionMethod;
	use Core\Template;

	class Router
	{
		private static $_urls = array();


		public static function dispatch($url){


			if (empty($url)) {
				$url = "index";
			}

			$files = array_diff(scandir(__DIR__.'/../Controllers'), ['.', '..']);
			
			foreach ($files as $file) {
			  	$file = basename($file, '.php');

			  	$RCclassName = new ReflectionCLass('Controllers\\'.$file);

			  	foreach ($RCclassName->getMethods() as $method) {
			  		$RMmethodName = New ReflectionMethod($method->class, $method->name);
			  		$comment =  $RMmethodName->getDocComment();

			  		if(preg_match_all("/@url=(.*)\s/", $comment, $result)){
			  			self::$_urls[trim($result[1][0])]= [$method->class, $method->name];
			  		}
			  	}
			}

			if( isset( self::$_urls['/'.$url] ) ){
				$action = self::$_urls['/'.$url];
				call_user_func_array([$action[0], $action[1]], []);
			}elseif(file_exists(__DIR__.'/../Views/'.$url.'.html')){
				include __DIR__.'/../Views/fragments/doctype.php';
				include __DIR__.'/../Views/fragments/header.php';
				include(__DIR__.'/../Views/'.$url.'.html');
				include __DIR__.'/../Views/fragments/foot.php';
			}elseif(file_exists(__DIR__.'/../Views/'.$url.'.php')){
				Template::render($url);
			}else{
				Template::render('404');
			}
		}		
		
	}