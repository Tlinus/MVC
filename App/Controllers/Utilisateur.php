<?php

namespace Controllers;
use \Models\Utilisateur as modelUtilisateur;

class	Utilisateur extends Generique{
	/**
	*
	*@url=/utilisateur/register
	*/
	public static function register(){

		if(	!isset($_POST['firstName']) 
			|| !isset($_POST['lastName']) 
			|| !isset($_POST['login']) 
			|| !isset($_POST['password']) 
			|| empty($_POST['firstName']) 
			|| empty($_POST['lastName']) 
			|| empty($_POST['login'])
			|| empty($_POST['password'])
		){
			$_SESSION['error:register'] = "Merci de remplir les champs correctement";
			self::redirect('register');
		}
		// je récupere les infos post
		$data = [
			'firstName' 	=> 	filter_var($_POST['firstName'], 	FILTER_SANITIZE_SPECIAL_CHARS ),
			'lastName' 		=>	filter_var($_POST['lastName'], 		FILTER_SANITIZE_SPECIAL_CHARS ),
			'login'			=> 	filter_var($_POST['login'], 		FILTER_SANITIZE_SPECIAL_CHARS ),
			'password' 		=> 	filter_var($_POST['password'], 		FILTER_SANITIZE_SPECIAL_CHARS )
		];



		//je traite les données
		if(!modelUtilisateur::findOne(['login' => $data['login']])){
			$user = new modelUtilisateur([
				'firstName' 	=> 	$data['firstName'],
				'lastName' 		=>	$data['lastName'],
				'login'			=> 	$data['login'],
				'password' 		=> 	$data['password']
			]);
			// je crée mon utilisateur
			$user->id = modelUtilisateur::insert($user);
			$_SESSION['user'] = $user;
			

		}else{
			
			$_SESSION['error:register'] = "L'utilisateur est déja inscrit";
			self::redirect('register');
		}
		
		
		self::redirect('');
	}

	/**
	*
	*@url=/utilisateur/delete
	*/
	public static function deleteUser(){
		modelUtilisateur::delete($_SESSION['user']);
		\Core\Session::destroy();
		self::redirect('register');

	}
	
	/**
	*
	*@url=/utilisateur/login
	*/
	public static function login(){

		if(	!isset($_POST['login']) 
			|| !isset($_POST['password']) 
			|| empty($_POST['login'])
			|| empty($_POST['password'])
		){
			$_SESSION['error_login'] = "Merci de remplir les champs correctement";
			self::redirect('login');
		} 
		$data = [
			'login'			=> 	filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS ),
			'password' 		=> 	filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS )
		];

		$user = modelUtilisateur::findOne(['login'=>$data['login']]);

		if($user == null){
			$_SESSION['error_login'] = "Le login que vous avez entré ne nous est pas connu";
			self::redirect('login');
		}

		if($user->password == $data['password']){
			$_SESSION['user'] = $user;
			self::redirect('');
		}else{
			$_SESSION['error_login'] = "Le mot de passe entré n'est pas correct.";
			self::redirect('login');
		}


	}

	/**
	*
	*@url=/utilisateur/modify
	*/
	public static function modifyUser(){
		$user = $_SESSION['user'];

		if(	!isset($_POST['firstName']) 
			|| !isset($_POST['lastName']) 
			|| !isset($_POST['login']) 
			|| !isset($_POST['password']) 
			|| empty($_POST['firstName']) 
			|| empty($_POST['lastName']) 
			|| empty($_POST['login'])
			|| empty($_POST['password'])
		){
			$_SESSION['error_modify'] = "Merci de remplir les champs correctement";
			self::redirect('modify');
		}
		// je récupere les infos post
		$data = [
			'firstName' 	=> 	filter_var($_POST['firstName'], FILTER_SANITIZE_SPECIAL_CHARS ),
			'lastName' 		=>	filter_var($_POST['lastName'], FILTER_SANITIZE_SPECIAL_CHARS ),
			'login'			=> 	filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS ),
			'password' 		=> 	filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS )
		];

			$user = new modelUtilisateur([
				'id' 			=>	$_SESSION['user']->id,
				'firstName' 	=> 	$data['firstName'],
				'lastName' 		=>	$data['lastName'],
				'login'			=> 	$_SESSION['user']->login,
				'password' 		=> 	$data['password']
			]);
			// je crée mon utilisateur
			if(!modelUtilisateur::update($user)){
				$_SESSION['error_modify'] = "Une Erreur s'est produite lors de la modification des données, merci de contacter un administrateur";
				self::redirect('modify');
			}else{
				$_SESSION['user'] = $user;
			}
		
		
		self::redirect('');
	}
		
}