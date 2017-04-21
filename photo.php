<?php
$image_sizes = getimagesize($_FILES['icone']['tmp_name']);
if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";
?>

try
{
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', $pdo_options);
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}


