<?php
session_start();
if(isset($_SESSION['mail']))
{
include ('singletton.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ajouter activite</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
    
    <form action="" method="POST">
        <label>Nom</label> : <input type="varchar" name="nom" /><br />
        <label>Durée</label> : <input type="text" name="duree"  /><br />
        <label>Prix</label> : <input type="double" min="0" name="prix"  /><br />
        <label>Lieu</label> : <input type="text" name="lieu"  /><br />
        <label>Date</label> : <input type="text" name="date" /><br />
        <label>lienFB</label> : <input type="text"  value="https://www.facebook.com/bdecesirouen/?ref=bookmarks" name="lienFB" /><br />
        <label>Description</label> : <input type="text" name="description" /><br />
        <input type="submit" value="Envoyer" />

<?php

        $databaseConnection = DbConnection();
if (isset($_POST['nom']) AND isset($_POST['duree']) AND isset($_POST['prix']) AND isset($_POST['lieu']) AND isset($_POST['date']) AND isset($_POST['lienFB']) AND isset($_POST['description']))
{
    $nom = $_POST['nom'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];
    $lieu = $_POST['lieu'];
    $dates = $_POST['date'];
    $lienFB = $_POST['lienFB'];
    $description = $_POST['description'];
    $selectActivite = $databaseConnection->query('SELECT nom from Activite where nom = "'.$nom.'"');
    $resultatActivite = $selectActivite->fetch();
    if(is_null($resultatActivite[0]))
    {
        $AjouterActivite = $databaseConnection->prepare("INSERT INTO activite ( Nom,duree,nombreParticipants,prix,lieu,dates,lienFB,description,nombreVotes) VALUES(?,?,0,?,?,?,?,?,0)");
     $AjouterActivite->execute(array($nom,$duree,$prix,$lieu,$dates,$lienFB,$description)); 
    }
    else 
    {
        echo('<p>une activité du même nom existe déjà</p>');
    }  
}
}
?>
    </form>
<p><a href="ListeActivite.php">Liste activite</a></p>
<p><a href="deconnexion.php">deconnexion</a></p>
    </body>
</html>