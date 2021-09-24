<?php
/**
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application Vanille
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoVanille qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author PREEL Tommy
 * @version 1.0
 */

class PdoVanille
{   		
      	private static $monPdo;
		private static $monPdoVanille = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoVanille::$monPdo = new PDO('mysql:host=127.0.0.1;dbname=preelt', 'root', 'root'); 
			PdoVanille::$monPdo->query("SET CHARACTER SET utf8");
/**
 * Destructeur public, appelé quand un objet n'a plus de référence
 */
	}
	public function __destruct(){
		PdoVanille::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdoVanille = PdoVanille::getPdoVanille();
 * @return l'unique objet de la classe PdoVanille
 */
	public  static function getPdoVanille()
	{
		if(PdoVanille::$monPdoVanille == null)
		{
			PdoVanille::$monPdoVanille= new PdoVanille();
		}
		return PdoVanille::$monPdoVanille;  
	}
/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return le tableau associatif des catégories 
*/
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau associatif  
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="select * from produit where idCategorie = '$idCategorie'";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}

/**
 * Retourne un tableau avec l'id du dernier produit de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau
*/

	public function getDernierProduitDeCategorie($idCategorie)
	{
	    $req="select MAX(PDT_id) from produit where idCategorie = '$idCategorie'";
		$res = PdoVanille::$monPdo->query($req);
		$idDernierProd = $res->fetchColumn();
		return $idDernierProd;
	}

/**
 * Retourne les infos du produit sous forme de tableau de
 * l'id du produit passé en argument
 * 
 * @param $idProduit
 * @return un tableau
*/

	public function getInfosProduit($idProduit)
	{
	    $req="select * from produit where PDT_id = '$idProduit'";
		$res = PdoVanille::$monPdo->query($req);
		$lignes = $res->fetch();
		return $lignes;
	}

/**
 * Retourne un booleen si le produit
 * a été supprimé
 * Verification si le produit n'est pas en commande
 * Sinon, suppression impossible
 * 
 * @param $idProduit
 * @return un booleen
*/

	public function supprimerProduit($idProduit)
	{
		$ok = false;
	    $req= "select idProduit from contenir where idProduit = '$idProduit'";
		$res = PdoVanille::$monPdo->query($req);
		$nblignes = $res->rowCount();
		if($nblignes == 0)
		{
			$req2 = "delete from produit where PDT_id = '$idProduit'";
			$res2 = PdoVanille::$monPdo->exec($req2);
			$ok = true;
		}
		return $ok;
	}

/**
 * Retourne les produits concernés par le tableau des idProduits passés en argument
 *
 * @param $desIdProduit tableau d'idProduits
 * @return un tableau associatif 
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produit where PDT_id = '$unIdProduit'";
				$res = PdoVanille::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
/**
 * Création d'une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $nom 
 * @param $rue
 * @param $cp
 * @param $ville
 * @param $mail
 * @param $lesIdProduit
 * @return 
*/
	public function creerCommande($nom,$rue,$cp,$ville,$mail,$lesIdProduit)
	{
		$commandeCree = false;
		$stockNonNul = true;
		$req = "select max(CDE_id) as maxi from commande";
		$res = PdoVanille::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		$date = date('Y/m/d');
		foreach($lesIdProduit as $prod)
		{
			$reqNonNul = "select * from produit where PDT_id = '$prod'";
			$resNonNul = PdoVanille::$monPdo->query($reqNonNul);
			$lignes = $resNonNul->fetch();
			$stock = $lignes['stock'];
			if($stock <= 0)
				$stockNonNul = false;
		}
		if($stockNonNul)
		{
			$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
			$res = PdoVanille::$monPdo->exec($req);
			foreach($lesIdProduit as $unProd)
			{
				$reqstock = "update produit set stock = stock-1 where pdt_id = '$unProd'";
				$resstock = PdoVanille::$monPdo->exec($reqstock);
				$reqcont = "insert into contenir values ('$idCommande','$unProd')";
				$rescont = PdoVanille::$monPdo->exec($reqcont);
			}
			$commandeCree = true;
		}	
		return $commandeCree;
	}
	
/** Création d'un produit
 *
 * Création d'un produit à partir d'une description, de son prix et de sa catégorie
 * @param $description
 * @param $prix
 * @param @categorie
 */
	public function ajouterProduit($description, $prix, $categorie, $id)
	{
		switch($categorie)
		{
			case 'cho' : 
			{
				$identifiant = "CH";
				$lienImage = "images/chocolats/choco";
				break;
			}
			case 'bon':
			{
				$identifiant = "BO";
				$lienImage = "images/bonbons/bonbon";
				break;
			}
			case 'car':
			{
				$identifiant = "CA";
				$lienImage = "images/caramels/caramel";
				break;
			}
		}
		$prix = number_format($prix,2,'.','');
		$dernierNumProd = substr($id, 2);
		$numProduit = (int)$dernierNumProd + 1;
		$lienImage = "$lienImage"."$numProduit.png";
		if($numProduit < 10)
			$numProduit = "0".(string)$numProduit;
		$idProduit = "$identifiant"."$numProduit";
		$req = "insert into produit values ('$idProduit','$description','$prix','$lienImage','$categorie',0)";
		$res = PdoVanille::$monPdo->exec($req);
	}
/** Modification d'un produit
 *
 * Met à jour le produit avec les nouvelles valeurs
 * passé en paramètres
 * @param @idProduit
 * @param $description
 * @param $prix
 * @param @stock

 */

	public function modifierProduit($idProduit,$description,$prix,$stock)
	{
		$prix = number_format($prix,2,'.','');
		$req = "update produit set description = '$description', prix = $prix, stock = $stock where PDT_id = '$idProduit'";
		$res = PdoVanille::$monPdo->exec($req);
	}
/**
 * Connexion de l'administrateur
 * @param $login
 * @param $mdp
 * @return $adminConnect, un booleen qui confirme ou non la connexion
*/
function connexion($login, $mdp)
{
	$adminConnect = false;
	$nom = "";
	$prenom = "";
	$req = "select * from administrateur where login = '$login' AND mdp = '$mdp'";
	$res = PdoVanille::$monPdo->query($req);
	$lignes = $res->fetchAll();
	if($res->rowCount() == 1)
	{
		$adminConnect = true;
	}
	return $adminConnect;
}
/**
 * Retourne les infos de l'admin avec
 * le login et le mdp passé en argument
 * 
 * @param $login
 * @param $mdp
 * @return un tableau
*/

	public function getInfosAdmin($login, $mdp)
	{
	    $req="select * from administrateur where login = '$login' AND mdp = '$mdp'";
		$res = PdoVanille::$monPdo->query($req);
		$lignes = $res->fetch();
		return $lignes;
	}
}
?>