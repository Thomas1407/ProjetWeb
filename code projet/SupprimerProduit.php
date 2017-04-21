<?php
include 'singletton.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Supprimer produit</title>
</head>
<body>
<form method="post" action="">
<input type="text" name="nom" value="nom">
<input type="submit" name="SUPP" value="Supprimer">
<?php
$databaseConnection = DbConnection();	
if (isset($_POST['nom']))
{
	$nom = $_POST['nom'];
	$requeteSelect = $databaseConnection->query("select idProduit from produit where nom = '".$nom."'");
	$selectProduit = $requeteSelect->fetch();
	
	if(isset($selectProduit[0]))
	{
		$supprimerProduit = $databaseConnection->prepare("delete from produit where nom = ?");
		$supprimerProduit->execute(array($_POST['nom']));
	}
}

?>	

</form>

<p><a href="boutique.php">Boutique</a></p>
</body>
</html>