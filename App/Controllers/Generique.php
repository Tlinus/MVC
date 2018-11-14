<?php

namespace Controllers;
/**
 * 
 */
class Generique
{
	/**
    * Method de mon controller pour faire des test
    *
	*/
	public static function redirect($url){
		header('Location: /mvccours/'.$url);
		die;
	}
}