<?php
// Gestion du Panier du site Vanille

$action = $_REQUEST['action'];
switch($action)
{
	case 'voirPanier':
	{
		$n= nbProduitsDuPanier();
		if($n >0)
		{
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			$message = "Voici votre Panier";
			include ("vues/v_message.php");
			include("vues/v_panier.php");
		}
		else
		{
			$message = "Panier vide !";
			include ("vues/v_message.php");
		}
		break;
	}
	
	case 'passerCommande':
	    $n= nbProduitsDuPanier();
		if($n>0)
		{
			$nom ='';$rue='';$cp='';$ville ='';$mail='';
			include ("vues/v_commande.php");
		}
		else
		{
			$message = "Panier vide !";
			include ("vues/v_message.php");
		}
		break;
	case 'confirmerCommande':
	{
		$nom =$_REQUEST['nom'];$rue=$_REQUEST['rue'];$cp=$_REQUEST['cp'];$ville=$_REQUEST['ville'];$mail=$_REQUEST['mail'];
	 	$msgErreurs = getErreursSaisieCommande($cp);
		if (count($msgErreurs)!=0)
		{
			include ("vues/v_erreurs.php");
			include ("vues/v_commande.php");
		}
		else
		{
			$lesIdProduit = getLesIdProduitsDuPanier();
			if($pdo->creerCommande($nom,$rue,$cp,$ville,$mail,$lesIdProduit))
			{
				$message = "Commande enregistrée !";
				supprimerPanier();
				header('Refresh: 1; index.php?uc=voirProduits&action=voirCategories');
			}
			else
			{
				$message = "Le produit commandé n'est pas en stock !";
				header('Refresh: 1;index.php?uc=gererPanier&action=voirPanier');
			}
			include ("vues/v_message.php");
		}
		
		break;
	}
	case 'annulerCommande'	:
	{
		supprimerPanier();
		header('Location: index.php?uc=gererPanier&action=voirPanier');
		exit();// on redirige et exit pour ne pas exécuter le reste du code de la page !
		break;
	}
	case 'supprimerPanier' :
       { supprimerPanier();
        header('Location: index.php?uc=gererPanier&action=voirPanier');
        exit();// on redirige et exit pour ne pas exécuter le reste du code de la page !
		break;
	   }
	case 'supprimerUnProduit' :
	{
        $idProduit = $_REQUEST['produit'];
		var_dump($idProduit);
        retirerDuPanier($idProduit);
		$n= nbProduitsDuPanier();
		if($n==0)
		{
			$message = "Panier vide !";
			include ("vues/v_message.php");
		break;
		}
		
        $desIdProduit = getLesIdProduitsDuPanier();
        $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
        include("vues/v_panier.php");
        break;
	}  
}


?>


