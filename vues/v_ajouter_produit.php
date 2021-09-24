<?php if(!$_SESSION['connecte']) header("Location: index.php");?>
<div id="ajouter_produit">
<form action = "index.php?uc=gererProduits&action=ajouterProduit" method = "POST">
<table>
	<tr>
		<td>Description</td>
		<td>Prix</td>
		<td>Type de produit</td>
	</tr>
	<tr>
		<td><textarea name = "description" placeholder = "Décrivez votre produit" rows = "6" cols = "25" required></textarea></td>
		<!--<td><input type = "text" name = "description" placeholder = "Décrivez votre produit" size = "100%" required/></td>-->
		<td><input type = "number" name = "prix" placeholder = "10.00" step = "0.01" min = "0" required/></td>
		<td>
		<input type = "radio" name = "categorie" value = "bon" checked = "checked"/> Bonbon<br/>
		<input type = "radio" name = "categorie" value = "car" /> Caramel<br/>
		<input type = "radio" name = "categorie" value = "cho" /> Chocolat<br/>
		</td>
		<td>
			<!--<input type = "image" src = "images/valider.png"/>!-->
			<input type = "submit" value = "Ajouter le produit" style = "width:100%; height:100%"/>
		</td>
	</tr>
</table>
</form>
</div>
