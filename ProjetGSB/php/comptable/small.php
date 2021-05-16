<?php

session_start();

include('../connecter.php');

$situation = $_POST["situation"];
$id = $_SESSION["idVisiteur"];
$date = $_SESSION["date"];
$SQL = "update fichefrais set idEtat='$situation' where idVisiteur = '$id' and mois = '$date'";
$connexion->query($SQL) or die ("Erreur dans la requete SQL");


?>
