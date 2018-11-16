<?php

namespace Controllers;
use \Models\Projet as modelProjet;
use \Models\Tache as modelTache;

/**
 * 
 */
class Projet extends Generique
{
	/**
	*
	*@url=/projet/nouveau
	*/
	public static function nouveauProjet(){
	
		if(!isset($_POST['name']) || empty($_POST['name'])){
			$_SESSION['error:Projet'] = "Merci de remplir les champs correctement";
			self::redirect('');
		}
		$date = new \dateTime('NOW');
		$data = [
			'id'				=> NULL,
			'name' 				=> 	filter_var($_POST['name'], 	FILTER_SANITIZE_SPECIAL_CHARS ),
			'ts_creation' 		=> $date->format('Y-m-d H:i:s'),
			'ts_maj' 			=> $date->format('Y-m-d H:i:s'),
			'id_utilisateur' 	=> $_SESSION['user']->id
		];

		$Projet = new modelProjet($data);


		$result = modelProjet::insert($Projet);
		if(is_numeric($result)){
			self::redirect('');
		}else{
			$_SESSION['error:Projet'] = "Une erreur est survenue lors de la création du projet";
			self::redirect('');
		}

	}

	/**
	*
	*@url=/projet
	*/
	public static function projet(){
		if( empty($_POST['id_projet']) && empty($_SESSION['Projet'])){
			$_SESSION['error:Projet'] = "Le projet séléctionné est impossible à trouver";
			self::redirect('');
		}

		if( !isset($_SESSION['Projet']) ||  !($_SESSION['Projet'] instanceOf \Models\Projet)){
			$_SESSION['Projet'] = modelProjet::findOne(['id' => $_POST['id_projet']]);

			if($_SESSION['Projet'] == null){
				$_SESSION['error:Projet'] = "Le projet séléctionné n'est pas reconnu par nos systèmes";
				self::redirect('');
			}
	 
			
		}

		$_SESSION['Taches'] =  modelTache::find(['id_projet' => $_SESSION['Projet']->id]);

		\Core\Template::render('projet'); 

	}

	/**
	*
	*@url=/projet/delete
	*/
	public static function deleteProjet(){
		// DELETE TASK

		$Taches = modelTache::find(['id_projet'=>$_POST['id']]);
		foreach ($Taches as $Tache) {
			modelTache::delete($Tache);
		}
		
		$Projet = modelProjet::findOne(['id'=>$_POST['id']]);
		modelProjet::delete($Projet);
		self::redirect('');
		
	}

	/**
	*
	*@url=/projet/modify
	*/
	public static function modifyUser(){
		if(!isset($_POST['modify'])){
			$_SESSION['projetModify'] = modelProjet::findOne(['id'=>$_POST['id']]);
			\Core\Template::render('projetModify');
			die;
		}
		$date = new \dateTime('NOW');

		$Projet = modelProjet::findOne(['id'=>$_POST['id']]);
		$Projet->ts_maj = $date->format('Y-m-d H:i:s');
		$Projet->name = filter_var($_POST['name'], 	FILTER_SANITIZE_SPECIAL_CHARS );
		$result = $Projet->update($Projet);

		unset($_SESSION['ProjetModify']);
		$_SESSION['Projet'] = $Projet;

		self::redirect('projet');

	}
}