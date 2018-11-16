<?php

	namespace Controllers;
	use \Models\Tache as modelTache;
	use \Models\Projet as modelProjet;

	/**
	 * 
	 */
	class Tache extends Generique
	{
		/**
		*
		*@url=/tache/ajouter
		*/
		public static function add(){
			if(empty($_POST['name']) || empty($_POST['commentaire'])){
				$_SESSION['error:Tache'] = "Merci de remplir les champs correctement";
				self::redirect('projet');
			}

			$date = new \dateTime('NOW');
			$data = [
				'id'=> null,	
				'name'=> filter_var($_POST['name'], 	FILTER_SANITIZE_SPECIAL_CHARS ),	
				'ts_creation'=> $date->format('Y-m-d H:i:s'),	
				'ts_maj'=> $date->format('Y-m-d H:i:s'),
				'date_fin' => ('0000-00-00 00:00:00'),	
				'commentaire'=> filter_var($_POST['commentaire'], 	FILTER_SANITIZE_SPECIAL_CHARS ),	
				'id_projet'=> $_POST['id_projet'],	
				'etat'=> 0
			];

			$Tache = new modelTache($data);


			$result = modelTache::insert($Tache);
			if(is_numeric($result)){
				self::redirect('projet');
			}else{
				echo $result;
				$_SESSION['error:Projet'] = "Une erreur est survenue lors de la création du projet";
				self::redirect('');
			}
		}
		
		/**
		*
		*@url=/tache/undone
		*/
		
		public static function undone(){
			$id = $_POST['id']; $date = new \dateTime('NOW');
			$Tache = new modelTache(['id'=>$id, 'etat'=>'0', 'ts_maj'=>$date->format('Y-m-d H:i:s')]);
			$result = $Tache->updateAttribute(['id'=>$id, 'etat'=>'0', 'ts_maj'=>$date->format('Y-m-d H:i:s')]);

			if(!$result){
				$_SESSION['error:Tache'] = "Désolé le service à rencontrer une erreur, l'action n'a pas pu etre enregistré";
				self::redirect('projet');
			}

			$Projet = new modelProjet(['id'=>$_POST['id_projet']]);
			$result = $Projet->updateAttribute(['id'=>$_POST['id_projet'], 'ts_maj'=>$date->format('Y-m-d H:i:s')]);

			self::redirect('projet');



		}
		/**
		*
		*@url=/tache/done
		*/
		
		public static function done(){
			$id = $_POST['id']; $date = new \dateTime('NOW');
			$Tache = new modelTache(['id'=>$id, 'etat'=>'1', 'ts_maj'=>$date->format('Y-m-d H:i:s')]);
			$result = $Tache->updateAttribute(['id'=>$id, 'etat'=>'1', 'ts_maj'=>$date->format('Y-m-d H:i:s')]);

			if(!$result){
				$_SESSION['error:Tache'] = "Désolé le service à rencontrer une erreur, l'action n'a pas pu etre enregistré";
				self::redirect('projet');
			}

			$Projet = new modelProjet(['id'=>$_POST['id_projet']]);
			$result = $Projet->updateAttribute(['id'=>$_POST['id_projet'], 'ts_maj'=>$date->format('Y-m-d H:i:s')]);

			self::redirect('projet');

		}

		/**
		*
		*@url=/tache/delete
		*/
		public static function delete(){
			$Tache = modelTache::findOne(['id'=>$_POST['id']]);
			modelTache::delete($Tache);
			self::redirect('projet');
		}
		
		/**
		*
		*@url=/tache/modify
		*/
		public static function modify(){
			if(!isset($_POST['modify'])){
				$_SESSION['TacheModify'] = modelTache::findOne(['id'=>$_POST['id']]);
				\Core\Template::render('tacheModify');
				die;
			}
			$date = new \dateTime('NOW');

			$Tache = modelTache::findOne(['id'=>$_POST['id']]);
			$Tache->ts_maj = $date->format('Y-m-d H:i:s');
			$Tache->commentaire = filter_var($_POST['commentaire'], 	FILTER_SANITIZE_SPECIAL_CHARS );
			$Tache->name = filter_var($_POST['name'], 	FILTER_SANITIZE_SPECIAL_CHARS );

			$result = $Tache->update($Tache);

			unset($_SESSION['TacheModify']);

			self::redirect('projet');

		}
	}