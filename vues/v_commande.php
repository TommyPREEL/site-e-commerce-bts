﻿<div id="creationCommande">
<form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
   <fieldset>
     <legend>Commande</legend>
		<p>
			<label for="nom">Nom Prénom*</label>
			<input id="nom" type="text" name="nom" value="<?=$nom ?>" size="30" maxlength="45" required>
		</p>
		<p>
			<label for="ville">Ville*</label>
			<input id="ville" type="text" name="ville" value="<?=$ville ?>" size="30" maxlength="45" required>
		</p>
		<p>
			<label for="mail">Adresse mail*</label>
			<input id="mail" type="text" name="mail" value="<?=$mail ?>" size="30" maxlength="45" required>
		</p>
		<p>
			<label for="rue">Rue*</label>
			 <input id="rue" type="text" name="rue" value="<?=$rue ?>" size="30" maxlength="45" required>
		</p>
		<p>
         <label for="cp">Code postal*</label>
         <input id="cp" type="text" name="cp" value="<?=$cp ?>" size="5" maxlength="5" required>
      </p>
	  	<p>
         <input type="submit" value="Valider" name="valider">
</form>
		 <form method="POST" action="index.php?uc=gererPanier&action=annulerCommande">
		 <input type="image" src = "./images/AnnulerPanier.png" value="Annuler">
      </p>
		</form>
</div>





