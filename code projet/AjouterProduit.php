<?php
session_start();
if (isset($_SESSION['mail']))
{
include 'singletton.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>	
		Ajouter Produit
	</title>


</head>
<body>


<form method="POST" action="">
	<p><label>Nom du produit: <input type="text" name="nom" value="nom" /></label></p>
	<p><label>prix du produit: <input type="double" name="prix" value="2" /></label></p>
	<p><label>image : <input type="text" name="image" value="Capture.jpg"/></label></p>
	<p><label>Quantité en stock : <input type="double" name="stock" value="5" /></label></p>

<?php
$databaseConnection = DbConnection();	
if (isset($_POST['nom']) AND isset($_POST['prix']) AND isset($_POST['image']) AND isset($_POST['stock']))
{
$ajouterProduit = $databaseConnection->prepare("insert into produit (nom,prix,image,stock) values (?,?,?,?)");
$ajouterProduit->execute(array($_POST['nom'],$_POST['prix'],$_POST['image'],$_POST['stock']));	
}
?>


	<p><input type="submit" value="Ajouter article" /></p>
</form>

<p><a href="boutique.php">Boutique</a></p>
<p><a href="AjouterActivite.php">Ajouter activite</a></p>
<?php
}
?>
<p><a href="deconnexion.php">deconnexion</a></p>

</body>
</html>