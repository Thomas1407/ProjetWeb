<?php
session_start();
if(isset($_POST['mail']))
{
	$_SESSION['mail'] = $_POST['mail'];
}
include 'singletton.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title></title>
</head>
<body>
<h2>ajouter membre bde : </h2>
<form action="" method="POST">
	<p><label>Prénom : <input type="text" name="prenom"/></label></p>
	<p><label>Nom : <input type="text" name="nom"/></label></p>
	<p><label>e-mail : <input type="email" name="email"/></label></p>
	<p><label>password : <input type="password" name="password"/></label></p>
	<p><label>role : <input type="text" name="role"/></label></p>
	<p><input type="submit" value="subscribe" /></p>
</form>

<?php
$databaseConnection = DbConnection();
if (isset($_POST['prenom']) AND isset($_POST['nom'])  AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['role']))
{
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	$selectUser = $databaseConnection->query('select nom from user where nom = "'.$nom.'" AND prenom = "'.$prenom.'"');
	$resultatNom = $selectUser->fetch();
	if(is_null($resultatNom['nom']))
	{	
		$selectRole = $databaseConnection->query('select id from role where role = "'.$role.'"');
		$resultatRole = $selectRole->fetch();
		if(isset($resultatRole[0]))
		{
			$roleId = $resultatRole[0];
			$selectMembre = $databaseConnection->query('SELECT idUser from MembreBde where idrole = "'.$roleId.'"');
			$resultatMembre = $selectMembre->fetch();
			if (is_null($resultatMembre[0]))
			{
				$AjouterLogin = $databaseConnection->prepare("INSERT INTO `user`(`idType`,`Nom`,`prenom`,`email`,`password`) values (2,?,?,?,?);");
				$AjouterLogin->execute(array($nom,$prenom,$email,$password));
				$selectUserId = $databaseConnection->query('SELECT id from user where email = "'.$email.'"');
				$resultatUserId = $selectUserId->fetch();
				$userId = $resultatUserId[0];
				$AjouterMembre = $databaseConnection->prepare('INSERT INTO membrebde (idUser,idRole) values (?,?)');
				$AjouterMembre->execute(array($userId,$roleId));
			}
			else
			{
				echo('<p> ce role est déjà pris ! <p>');
			}
		}
		else
		{
			echo ('<p> ce role n existe pas !</p>');
		}

	}
	else
	{
		echo('déjà inscrit !');
	}
}


?>
<h2>déjà inscrit ? </h2>
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
		$selectType = $databaseConnection->query('select idType from user where email = "'.$mail.'"');
		$resultatType = $selectType->fetch();
		if($resultatType[0] == 2)
		{
			$selectPass = $databaseConnection->query('select prenom from user where email = "'.$mail.'" AND password = "'.$pass.'"');
			$resultatPrenom = $selectPass->fetch();
			if(isset($resultatPrenom[0]))
			{
				$prenomUser = $resultatPrenom[0];
				echo('<h1> bienvenu '.$prenomUser.' !</h1>');
				echo('<p><a href="ajouterProduit.php">Ajouter produit</a></p>
					<p><a href="boutique.php">Boutique</a></p>
					<p><a href="ListeActivite.php">Liste activite</a></p>
					<p><a href="AjouterActivite.php">Ajouter activite</a></p>
					<p><a href="deconnexion.php">deconnexion</a></p>');


			}
			else 
			{
				echo('<p> mot de passe incorrect</p>');
			}
		}
		else
		{
			echo('<p> accès refusé</p>');
		}
	}
	else
	{
		echo('<p> adresse email incorrecte</p>');
	}
}
?>
</body>
</html>