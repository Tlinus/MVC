<?php

namespace Models;

/**
 * 
 */
class Tache extends Generique
{
	
	public $id;
	public $name;
	public $ts_creation;	
	public $ts_maj;	
	public $commentaire;
	public $id_projet;	
	public $etat;
}