<ul id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['CAT_id'];
	$libCategorie = $uneCategorie['libelle'];
  ?>
	<li>
		<a href=index.php?uc=gererProduits&categorie=<?=$idCategorie ?>&action=voirProduits><?=$libCategorie ?></a>
	</li>
<?php
}
?>
</ul>
