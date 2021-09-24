<div id="produits">
<table>
	<tr>
		<td><a href=index.php?uc=gererProduits&categorie=<?php echo$categorie ?>&action=boutonAjouterProduit>
		<img src = "images/ajouter.png" height='50%' alt="icone ajouter" TITLE="Ajouter produit"/></td>
		<td>CLIQUEZ SUR LE + POUR AJOUTER UN PRODUIT</td>
	</tr>
</table>
<?php
foreach($lesProduits as $unProduit) 
{
	$id = $unProduit['PDT_id'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
	$stock = $unProduit['stock'];
  ?>
<table  cellpadding=10 cellspacing=10>  
	<tr> 
			<td><img src="<?php echo $image ?>" alt=image /></td>
			<td><?=$description ?></td>
			 <td><?=$prix." Euros" ?></td>
			 <td><?=$stock." en stock" ?></td>
			 <td><a href=index.php?uc=gererProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=boutonModifierProduit> 
			 <img src="images/modif.png" height='10%' TITLE="Modifier produit"></td></a>
			 <td><a href=index.php?uc=gererProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=boutonSupprimerProduit> 
			 <img src="images/supprimer.png" height='10%' onClick = "return confirm('Etes-vous sûr de supprimer le produit?');" TITLE="Supprimer produit"></td></a>
	</tr>
			
<?php			
}
?>
</table>
</div>
