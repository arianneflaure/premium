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

class mdr extends entity {
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	public function getAutocaristes() {
		$req = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar' LIMIT 0, 10";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	public function getrecent() {
		$req = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar' LIMIT 0, 3";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	public function getNbAutocariste() {
		$requete = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar';";
		return $this->countResult($requete);
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

     	public function active($id){
		
		$mdr= mysql_real_escape_string(htmlspecialchars($_POST['mdr_id']));
		
		if ($_POST['valid']==1)
		{
		
		$req = "UPDATE  $this->table  SET valid = 0 WHERE mdr_id = '$mdr';";
	   // var_dump($_POST['mdr_id']); die;
		$this->sql($req);
		}
		else if ($_POST['valid']==0){
		$re = "UPDATE  $this->table  SET valid = 1 WHERE mdr_id = '$mdr;'";
		//var_dump($re); die;
		$this->sql($re);
		}
	}
	
public function pagination() {
	
	//$sql = "SELECT COUNT(*) AS nb FROM $this->table";
	$sql = "SELECT count(*)  FROM $this->table";
	return $this->mysql_fetch_row($sql);

	
	}
	public function page($min) {
	
	//$sql = "SELECT COUNT(*) AS nb FROM $this->table";
	$sql = "SELECT * FROM $this->table LIMIT $min , 10 ";
	return $this->mysql_fetch_array($sql);

	
	}
	
public static function createTable($query , $number_of_rows_per_page , $page_uri , $paramsArray=null){
// Préparation de la requête selon le tableau de paramètres.
if(!empty($paramsArray)){
// la chaine ne contient pas déjà une clause where
if (!stripos($query , 'where'))
$query = $query.' where 1=1 ';
// Parcours du tableau des paramètres et construction de la requête complète
foreach($paramsArray as $paramsArray_key=>$paramsArray_value){
$query = $query.' and '.$paramsArray_key.' = :'.$paramsArray_key; 
}
}
// Préparation à la création du système de pagination
// Compter le nombre de lignes à extraire
$query = strtolower($query);
$query_array = explode("from",$query);
$query_for_number_of_rows = 'select count(*) from '.$query_array[1];
$connexion = Connexion::getInstance();

$requete = $connexion->prepare($query_for_number_of_rows);
foreach($paramsArray as $paramsArray_key=>$paramsArray_value){
$requete->bindValue(':'.$paramsArray_key,$paramsArray_value);
}
if($requete->execute()){
$donnes_number_of_rows = $requete->fetch();
$total_number_of_rows  = $donnes_number_of_rows[0];
}
// Nombre de pages
$number_of_pages = ceil($total_number_of_rows/$number_of_rows_per_page);
// On cherche dans quel page on est
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe on affiche la page correspondante 
{
    $actual_page=intval($_GET['page']);
    
    if($actual_page > $number_of_pages) // Si la valeur de $actual_page (le numéro de la page) est plus grande que $numebr_of_pages on affiche la dernière page
    {
         $actual_page = $number_of_pages;
    }
}
else // Sinon
{
    $actual_page = 1; // La page actuelle est la n°1    
}
// On calcul la première entrée à lire
$first_row_in_page = ($actual_page-1)*$number_of_rows_per_page; 
// Récupération des enregistrements à afficher dans la page actuelle.
$query = $query.' LIMIT '.$first_row_in_page.' , '.$number_of_rows_per_page;
$connexion = Connexion::getInstance();

$requete = $connexion->prepare($query);
foreach($paramsArray as $paramsArray_key=>$paramsArray_value){
$requete->bindValue(':'.$paramsArray_key,$paramsArray_value);
}
if($requete->execute())
{
$donnees = $requete->fetchAll();
// Formation des clés du tableau à afficher : liste des champs sélectionnées dans la requete.
$first_row_donnees = $donnees[0];
foreach($first_row_donnees as $row_cle=>$row_valeur) 
{
if(gettype($row_cle)!='integer')
{
$tab_keys[] = $row_cle;
}
}
foreach ($donnees as $row_donnees){
foreach ($tab_keys as $tab_keys_value){
//echo $tab_keys_value.'<br/>';
$tab_values_row[$tab_keys_value] = $row_donnees[$tab_keys_value];
}
$tab_values[] = $tab_values_row;
}
;

	
	}
	
	}
	}
	
?>