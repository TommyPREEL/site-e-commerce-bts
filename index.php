<?php
//Controleur Principal du site Vanille 2019
session_start();
require_once("util/fonctions.inc.php");
require_once("util/class.pdoVanille.inc.php");
include("vues/v_entete.php") ;
include("vues/v_bandeau.php") ;

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];
/* Création d'une instance d'accès à la base de données */
$pdo = PdoVanille::getPdoVanille();	 
switch($uc)
{
	case 'accueil':
		{include("vues/v_accueil.php");break;}
	case 'voirProduits' :
		{include("controleurs/c_voirProduits.php");break;}
	case 'gererPanier' :
		{include("controleurs/c_gestionPanier.php");break;}
	case 'gererProduits' :
		{include("controleurs/c_gestionProduits.php");break;}
	case 'administration' :
		{include("controleurs/c_administration.php");break;}
}
include("vues/v_pied.php") ;
?>

