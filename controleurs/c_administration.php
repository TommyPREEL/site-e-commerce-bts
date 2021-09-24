<?php
// Gestion de l'administration du site Vanille
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirFormulaire':
	{
		include("vues/v_formulaire_connexion.php");
		break;
	}
	case 'connexion':
	{
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		if($pdo->connexion($login, $mdp))
		{
			$lignes = $pdo->getInfosAdmin($login,$mdp);
			$nom = $lignes["nom_admin"];
			$prenom = $lignes["prenom_admin"];
			AffectAdmin($nom,$prenom);
			$message = "Connexion etablie !";
			header("Refresh: 1;index.php");
		}
		else
		{
			$message = "Identifiants incorrects !";
			header("Refresh: 1;index.php?uc=administration&action=voirFormulaire");
		}
		include("vues/v_message.php");
		break;
	}
	case 'deconnexion':
	{
		deconnexion();
		$message = "Administrateur déconnecté avec succès !";
		include("vues/v_message.php");
		header("Refresh: 1;index.php");
		break;
	}
}
?>


