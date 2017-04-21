<?php
session_start();
if(isset($_SESSION['prenom'])){
echo($_SESSION['prenom']);
}
include 'singletton.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$databaseConnection = DbConnection();
$requeteSelect = $databaseConnection->query("select * from produit");
$i = 1;

while ($listeProduit = $requeteSelect->fetch())
{
echo ('<p> Nom article :'. $listeProduit[$i].'</p>');
echo('<p>prix :' . $listeProduit[$i + 1] . '</p>');
echo('<p>stock restant :' . $listeProduit[$i + 3] . '</p>');
echo('<p><img src="'.$listeProduit[$i + 2].'"</p>');
}
?>
<form method="POST" action="">
<input type="text" name="nom" value="nom">
<input type="submit" name="acheter" value="acheter">
<?php
if(isset($_POST['nom'])){
	$nom = $_POST['nom'];
	$requeteSelect = $databaseConnection->query("select stock from produit where nom = '".$nom."'");
	$selectProduit = $requeteSelect->fetch();
	
	if(isset($selectProduit[0]))
	{
		if($selectProduit[0] > 1){
		$acheterProduit = $databaseConnection->prepare("update produit set stock = stock - 1 where nom = ?");
		$acheterProduit->execute(array($_POST['nom']));	
		}
		else{
			$supprimerProduit = $databaseConnection->prepare("delete from produit where nom = ?");
		$supprimerProduit->execute(array($_POST['nom']));
	}		
	}
	else{
		echo("         ce produit n'est pas disponible actuellement");
	}
}

?>
</form>
<p><a href="ListeActivite.php">Liste activite</a></p>
<p><a href="deconnexion.php">deconnexion</a></p>
</body>
</html>