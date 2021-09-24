<div id="modifier_produit">
<form action = "index.php?uc=gererProduits&categorie=<?php echo $categ?>&action=modifierProduit&produit=<?php echo $idProduit?>" method = "POST">
<table>
	<tr>
		<td>Description</td>
		<td>Prix</td>
		<td>Type de produit</td>
		<td>Stock</td>
	</tr>
	<tr>
		<td><textarea name = "description" rows = "6" cols = "25"required><?php echo $description;?></textarea></td>
		<!--<td><input type = "text" name = "description" placeholder = "Décrivez votre produit" size = "100%" required/></td>-->
		<td><input type = "number" name = "prix" step = "0.01" min = "0" value = "<?php echo $prix;?>" required /></td>
		<td>
			<label><?php echo $categorie;?></label>
		</td>
		<td>
			<input type = "number" step = "1" min = "0" name = "stock" value = "<?php echo $stock;?>" required/>
		</td>
		<td>
			<!--<input type = "image" src = "images/valider.png"/>!-->
			<input type = "submit" value = "Modifier le produit" style = "width:100%; height:100%"/>
		</td>
	</tr>
</table>
</form>
</div>
