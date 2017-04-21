<?php
session_start();
include ('singletton.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Activite</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>

<?php
$databaseConnection = DbConnection();
    $selectActivite = $databaseConnection->query('SELECT * from Activite');
    while($resultatActivite = $selectActivite->fetch())
    {
        $id = $resultatActivite[0];
        $nom = $resultatActivite[1];
        $duree = $resultatActivite[2];
        $prix = $resultatActivite[3];
        $nombreParticipants = $resultatActivite[4];
        $lieu = $resultatActivite[5];
        $dates = $resultatActivite[6];
        $lienFB = $resultatActivite[7];
        $description = $resultatActivite[8];
        $nombreVotes = $resultatActivite[9];
        echo('<p>Activité : '.$nom.'</p>');
        echo('<p>Durée : '.$duree.'</p>');
        echo('<p>prix : '.$prix.'</p>');
        echo('<p>nombreParticipants : '.$nombreParticipants.'</p>');
        echo('<p>lieu : '.$lieu.'</p>');
        echo('<p>date : '.$dates.'</p>');
        echo('<p><a href="'.$lienFB.'">lienFB</a></p>');
        echo('<p>description : '.$description.'</p>');
        
        
        echo ('<form method="post" action="">
        <input type="submit" value="j aime">');
        $AjouterNombreVotes = $databaseConnection->prepare('UPDATE activite set nombreVotes = (nombreVotes + 1) where nom = ?');
        $AjouterNombreVotes->execute(array($nom));
        echo('</form>');
        echo('<p>nombre de votes : '.$nombreVotes.'</p>');
        echo ('-----------------------------------------------------------------------------------------------------------------------');

    }

?>
    </form>
<p><a href="AjouterActivite.php">Ajouter activite</a></p>
<p><a href="deconnexion.php">deconnexion</a></p>
    </body>
</html>