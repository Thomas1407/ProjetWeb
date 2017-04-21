<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Site du BDE</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
    
    <form action="" method="POST">
        <p>
        <label>Nom</label> : <input type="varchar" name="nom" /><br />

        <label>Durée</label> : <input type="time" name="duree"  /><br />

        <label>Prix</label> : <input type="number" min="0" name="prix"  /><br />

        <label>Lieu</label> : <input type="text" name="lieu"  /><br />

        <label>Date</label> : <input type="date" name="date" /><br />

        <label>lienFB</label> : <input type="url"  value="http://" name="lienFB" /><br />
        
        <label>Description</label> : <input type="text" name="description" /><br />


        <input type="submit" value="Envoyer" />




        <?php

        //Récupérer activités
        $bdd = new PDO('mysql:host=localhost;dbname=webproject;', 'root', '');

        $reponse = $bdd->query('SELECT nom, contenu FROM activite ORDER BY id DESC LIMIT 0, 10');

        


        

        


        //Ajout activité
        $bdd = new PDO('mysql:host=localhost;dbname=webproject;', 'root', '');
        if (isset($_POST['nom']) AND isset($_POST['duree']) AND isset($_POST['prix']) AND isset($_POST['lieu']) AND isset($_POST['date']) AND isset($_POST['lienFB']) AND isset($_POST['description']))
         {
            echo ('activite ajoutee');
            $stmt = $bdd->prepare("CALL ajouteractivite (?,?,?,?,?,?,?)");
            $stmt->execute(array($_POST['nom'],$_POST['duree'], $_POST['prix'], $_POST['lieu'], $_POST['date'], $_POST['lienFB'], $_POST['description']));


        }


        ?>

    </p>
    </form>

    </body>
</html>