<?php
/**
 * Classe de gestion des entites
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

abstract class entite extends bd {
	
	protected $table;
	/**  Variable pour les donn�es surcharg�es.  */
    private $data = array();

    /**  La surcharge n'est pas utilis�e sur les propri�t�s d�clar�es.  */
    public $declared = 1;
	 /**  La surcharge n'est lanc�e que lorsque l'on acc�de � la classe depuis l'ext�rieur.  */
    private $hidden = 2;

    public function __set($name, $value) {
       // echo "D�finition de '$name' � la valeur '$value'\n";
        $this->$name = $value;
    }

    public function __get($name) {
       // echo "R�cup�ration de '$name'\n";
        //if (array_key_exists($name, $this->data)) {
            //return $this->data[$name];
            return $this->$name;
        //}

        $trace = debug_backtrace();
        trigger_error(
            'Propri�t� non-d�finie via __get(): ' . $name .
            ' dans ' . $trace[0]['file'] .
            ' � la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    /**  Depuis PHP 5.1.0  */
    public function __isset($name) {
        //echo "Est-ce que '$name' est d�fini ?\n";
        return isset($this->$name);
    }

    /**  Depuis PHP 5.1.0  */
    public function __unset($name) {
        //echo "Effacement de '$name'\n";
        unset($this->$name);
    }
	public function __construct($table = null) {
		parent::__construct();
		if(is_null($table))
			return 'Table nom specifiee pour ' . __CLASS__;
		$this->setTableName($table);
	}
	
	protected function setTableName($tableName) {
		$this->table = $tableName;
	}
	
	public function getAllFields() {
		$fieldList = array();
		$req = "SHOW FIELDS FROM $this->table";
		$res = $this->select($req);
		foreach($res as $f)
			$fieldList[] = $f->Field;
		return $fieldList;
	}
	
	/** Methode de sauvegarde ou de mise a jour d'un enregistrement */
	public function saveRecord($post, $exceptions = null) {
		if($exceptions)
			if(is_array($exceptions))
				foreach($exceptions as $e)
					unset($post[$e]);
		isset($post['mdr_id']) ? $this->updateRecord($post) : $this->newRecord($post);
	}
	
	/** Methode de sauvegarde d'un nouvel enregistrement */
	protected function newRecord($post) {
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		$query = $this->buildInsertQuery($this->data, $this->table);
		//var_dump($query); die;
		$this->insert($query);
	}
	
	/** Methode de mise a jour d'un enregistrement */
	protected function updateRecord($post) {
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		$query = $this->buildUpdateQuery($this->data, $this->table, $post['mdr_id']);
		//var_dump($query); die;
	    
		$this->update($query);
	}
	
	public function getRecord($id){
		$req = "SELECT * FROM $this->table WHERE mdr_id = '$id' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	
	public function getName($id, $table, $field = null) {
		if($id == '' || is_null($id))
			return '';
		//
		if(is_null($field))
			$req = "SELECT nombre FROM $table WHERE mdr_id = '$id' LIMIT 1";
		else
			$req = "SELECT $field as nombre FROM $table WHERE mdr_id = '$id' LIMIT 1";
		//var_dump($req); 
		$res = $this->select($req);
		return $res[0]->nombre;
	}
	
	public function log() {
		$req = "INSERT INTO ";
	}
	
	public function getAllRecords($track = false, $motif = null) {
		$req = "SELECT * FROM $this->table";
		$motif = is_null($motif) ? "Displays the records for $this->table" : $motif;
		//var_dump($motif); die;
		if($track == false || ($track == false && is_null($motif)))
			$res = $this->select($req);
		else
			$res = $this->select($req, $motif);
		return $res;
	}
	
	public function delRecord($id) {
		$id = is_array($id) ? $id['mdr_id'] : $id;
		$req = "SET FOREIGN_KEY_CHECKS=0; DELETE FROM $this->table WHERE mdr_id = '$id';";
		//var_dump($req); die;
		$this->sql($req);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>