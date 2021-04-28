<?php
    // Appel du script de connexion
    require ("connecter.php");

    // On récupère dans des variables les données saisies par l'utilisateur 
    $idVisiteur =$_POST["idVisi"];
    $mois =$_POST["mois"];
	
	$qte1 =$_POST["RQ"];
	$qte2 =$_POST["NQ"];
	$qte3 =$_POST["RNQ"];
	$qte4 =$_POST["KQ"];
	
    // Ecriture de la requête d'insertion en SQL 
    $reqSQL="INSERT INTO fichefrais VALUES ('$idVisiteur','$mois',null,null,null,'CR');";
	$connexion->exec($reqSQL) or die ("erreur dans la requete sql");
	
	$reqSQL1="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','ETP',$qte1);";
	$reqSQL2="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','KM',$qte2);";
	$reqSQL3="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','NUI',$qte3);";
	$reqSQL4="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','REP',$qte4);";

    // Exécution de la requête : on insère les informations du formulaire dans la table 
    $connexion->exec($reqSQL1) or die ("erreur dans la requete sql 1");
	$connexion->exec($reqSQL2) or die ("erreur dans la requete sql 2");
	$connexion->exec($reqSQL3) or die ("erreur dans la requete sql 3");
	$connexion->exec($reqSQL4) or die ("erreur dans la requete sql 4");

    // On affiche le résultat pour le visiteur 
    echo( "Votre affiche pour ce mois a ete saisie");

    // On ferme la connexion 
    $connexion=null;
?> 