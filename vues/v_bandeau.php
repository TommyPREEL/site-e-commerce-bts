<div id="bandeau">
<!-- Images En-tête -->
<img src="images/Vanille.png"	alt="Boutique en ligne Vanille" title="Boutique en ligne Vanille" width="900" height="300" />
</div>
<!--  Menu haut-->

<ul id="menu">
	<li><a href="index.php?uc=accueil"> Accueil </a></li>
	<li><a href="index.php?uc=voirProduits&action=voirCategories"> Voir le catalogue </a></li>
	<li><a href="index.php?uc=gererPanier&action=voirPanier"> Voir votre panier </a></li>
	<?php
	initAdmin();
	if($_SESSION["connecte"] == true)
	{
		echo '<li><a href="index.php?uc=gererProduits&action=voirCategories"> Gerer les produits </a></li>';
		echo '<li>Bonjour '.$_SESSION["nom_admin"].' '.$_SESSION["prenom_admin"].'<a href="index.php?uc=administration&action=deconnexion"> <br>Se deconnecter </a></li>';
	}
	else
	{
		echo '<li><a href="index.php?uc=administration&action=voirFormulaire"> Se connecter </a></li>';
	}
	?>
</ul>
