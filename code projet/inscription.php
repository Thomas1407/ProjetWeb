<?php
session_start();
include 'singletton.php';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>super site</title>
</head>
<body>
<h2>ajouter etudiant ou direction : </h2>
<form action="" method="POST">
	<p><label>Prénom : <input type="text" name="prenom"/></label></p>
	<p><label>Nom : <input type="text" name="nom"/></label></p>
	<p><label>statut : <input type="text" name="type" value="etudiant" /></label></p>
	<p><label>e-mail : <input type="email" name="email"/></label></p>
	<p><label>password : <input type="password" name="password"/></label></p>
	<p><input type="submit" value="subscribe" /></p>
</form>

<?php
$databaseConnection = DbConnection();
if (isset($_POST['prenom']) AND isset($_POST['nom']) AND isset($_POST['type']) AND isset($_POST['email']) AND isset($_POST['password']))
{
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$type = $_POST['type'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$selectUser = $databaseConnection->query('select nom from user where nom = "'.$nom.'" AND prenom = "'.$prenom.'"');
	$resultatNom = $selectUser->fetch();
	if(is_null($resultatNom['nom']))
	{	
		$requeteType = $databaseConnection->query('select id from typeuser where type = "'.$type.'"');
		$selectType = $requeteType->fetch();
		if(isset($selectType[0]))
		{
			if(($selectType['id'] == 1) OR ($selectType['id'] == 3))
			{
				echo($selectType['id']);
				$AjouterLogin = $databaseConnection->prepare("INSERT INTO `user`(`idType`,`Nom`,`prenom`,`email`,`password`) values (?,?,?,?,?);");
				$AjouterLogin->execute(array($selectType['id'],$nom,$prenom,$email,$password));
			}
			else 
			{
				echo('<p> veuillez choisir le bon statut</p>');
			}
		}
		else 
		{
			echo('<p>erreur statut</p>');
		}
	}
	else 
	{
		echo('<p>déjà inscrit</p>');
	}

}

?>

<p>Membre BDE : <a href="bdeInscription.php"> cliquez-ici</a></p></br>

<h2>déjà membre ?</h2>

<form method="POST" action="">
<p><label>e-mail : <input type="email" name="mail"/></label></p>
<p><label>password : <input type="password" name="pass"/></label></p>
<p><input type="submit" name="OK" value="connexion"/></label></p>

<?php
if(isset($_POST['mail']) AND isset($_POST['pass']))
{
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];
	$selectMail = $databaseConnection->query('select nom from user where email = "'.$mail.'"');
	if($selectMail->fetch())
	{
		$selectPass = $databaseConnection->query('select prenom from user where email = "'.$mail.'" AND password = "'.$pass.'"');
		if($selectPass->fetch())
		{
			$selectTypeId = $databaseConnection->query('select idType from user where email = "'.$mail.'" AND password = "'.$pass.'"');
			$resultatTypeId = $selectTypeId->fetch();
			if(($resultatTypeId[0] == 1) or ($resultatTypeId[0] == 2))
			{
				
				echo('<h1> bienvenu '.$mail.' !</h1>');
				echo('<p><a href="acheterProduit.php">Boutique</a></p>
					<p><a href="ListeActivite.php">Liste activite</a></p>
					<p><a href="deconnexion.php">deconnexion</a></p>');
			}
			else
			{
				echo('<h1> bienvenu '.$mail.' !</h1>');
				echo('<p><a href="acheterProduit.php">acheter boutique</a></p>
					<p><a href="Boutique.php">Modifier boutique</a></p>
					<p><a href="deconnexion.php">deconnexion</a></p>');
			}


		}
		else 
		{
			echo('<p> mot de passe incorrect</p>');
		}
	}
	else
	{
		echo('<p> adresse email incorrecte</p>');
	}
}

?>
</form>

</body>
</html>