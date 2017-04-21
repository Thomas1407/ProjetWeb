<?php
session_start();
if (isset($_SESSION['mail']))
{
include 'singletton.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>boutique cesi</title>
</head>
<?php
$databaseConnection = DbConnection();
$requeteSelect = $databaseConnection->query("select * from produit");
$i = 1;

while ($listeProduit = $requeteSelect->fetch())
{
echo $listeProduit[$i];
echo('<p><img src="'.$listeProduit[$i + 2].'"</p></br>');
}

?>

<form method="post" action="">
<input type="text" name="nom" value="nom">
<input type="submit" name="SUPP" value="Supprimer">
<?php
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

<p><a href="AjouterProduit.php" target="_blank">Ajouter produit</a></p>
<?php
}
?>
<p><a href="AjouterActivite.php">Ajouter activite</a></p>
<p><a href="deconnexion.php">deconnexion</a></p>
</body>
</html>










