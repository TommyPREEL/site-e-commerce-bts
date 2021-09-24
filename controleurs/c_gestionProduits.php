<!-- Controleur pour ajouter/modifier/supprimer les produits disponibles EN TANT QU'ADMINISTRATEUR du site dans le site Vanille -->
<?php
if(!$_SESSION['connecte'])
	header("Location: index.php");
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirCategories':
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories_admin.php");
		break;
	}
	case 'voirProduits':
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories_admin.php");
  		$categorie = $_REQUEST['categorie'];
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits_admin.php");
		break;
	}
	case 'boutonAjouterProduit':
	{
		include("vues/v_ajouter_produit.php");
		break;
	}
	case 'boutonModifierProduit':
	{
		$description = "";
		$categorie = "";
		$prix = 0.00;
		$stock = 0;
		$idProduit = $_REQUEST['produit'];
		$categ = $_REQUEST['categorie'];
		switch($categ)
		{
			case 'cho' : 
			{
				$categorie = "Chocolat";
				break;
			}
			case 'bon':
			{
				$categorie = "Bonbon";
				break;
			}
			case 'car':
			{
				$categorie = "Caramel";
				break;
			}
		}
		$info = $pdo->getInfosProduit($idProduit);
		$description = $info["description"];
		$prix = $info["prix"];
		$stock = $info["stock"];
		include("vues/v_modifier_produit.php");
		break;
	}
	case 'boutonSupprimerProduit':
	{
		$idProduit = $_REQUEST['produit'];
		$categ = $_REQUEST['categorie'];
		if($pdo->SupprimerProduit($idProduit))
			$message = "Le produit a bien été supprimé !";
		else
			$message = "Le produit est en commande, impossible de le supprimer";
		header("Refresh: 1;index.php?uc=gererProduits&action=voirProduits&categorie=".$categ."");
		include("vues/v_message.php");
		break;
	}
	case 'ajouterProduit':
	{
		$categorie = $_POST['categorie'];	
		$description = $_POST['description'];
		$prix = $_POST['prix'];
		$id = $pdo->getDernierProduitDeCategorie($categorie);
		$pdo->ajouterProduit($description,$prix,$categorie, $id);
		$message = "Votre produit a bien été ajouté !";
		header("Refresh: 1;index.php?uc=gererProduits&action=voirProduits&categorie=".$categorie."");
		include("vues/v_message.php");
		break;
	}
	case 'modifierProduit':
	{
		$description = $_POST["description"];
		$prix = $_POST["prix"];
		$stock = $_POST["stock"];
		$idProduit = $_REQUEST["produit"];
		$categorie = $_REQUEST["categorie"];
		$pdo->modifierProduit($idProduit,$description,$prix,$stock);
		$message = "Votre produit a bien été modifié !";
		header("Refresh: 1;index.php?uc=gererProduits&action=voirProduits&categorie=".$categorie."");
		include("vues/v_message.php");
		break;
	}
}
?>