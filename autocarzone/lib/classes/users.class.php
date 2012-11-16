<?php
@session_start();
/**
 * Classe de gestion des provinces
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Patient
 * @license		GNU General Public License
 */

class users extends entity {
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	
	
	
	public function __destruct() {
		parent::__destruct();
	}
	
	public function getRecord($id){
		//$req = "SELECT * FROM $this->table WHERE $this->id = '$id' LIMIT 1";
		$req = "SELECT * FROM $this->table WHERE mdr_id = '$id' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	public function getStatut($id){
		//$req = "SELECT * FROM $this->table WHERE $this->id = '$id' LIMIT 1";
		$reqt = "SELECT etat FROM $this->table WHERE fiche_id = '$id' ";
		$re = $this->select($reqt);
		return $re[0];
	}

	}
	
	
?>