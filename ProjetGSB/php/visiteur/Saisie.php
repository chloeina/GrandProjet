<?php
	session_start();
	if($_SESSION['connexion']!='oui')
	{
		header("location:../../html/login.html");
	}
	else

?>
<html>
	<head>
	<link href="../../css/SaisieForfait.css" rel="stylesheet" type="text/css" />
	</head>

	<body>

		Pour revenir sur la saisie des frais forfait cliquez sur le lien 
		<a href="SaisieForfait.php" > Saisie des forfaits </a><br/>

		Pour enregistrer des frais hors forfait cliquez sur ce lien 
		<a href="SaisieHorsForfait.php" > Saisie des frais hors forfaits </a><br/>

		Pour vous déconnecter cliquez ici 
		<a href="quitterUtilisateur.php" > Deconnexion </a><br/>

	</body>
</html>
<?php
    // Appel du script de connexion
    require ("../connecter.php");

    // On récupère dans des variables les données saisies par l'utilisateur 
    $idVisiteur = $_SESSION['id'];
    //$mm = date('m');
	//$mos=(int)$mm;
	$mois= $_SESSION['mois'];
	//(string)$mos;
	
	$qte1 =$_POST["RQ"];
	$qte2 =$_POST["NQ"];
	$qte3 =$_POST["RNQ"];
	$qte4 =$_POST["KQ"];
	
	
	//TESTS
	$reqTEST = "select * from fichefrais where idVisiteur = '$idVisiteur' and mois = '$mois'";
	$result = $connexion->query($reqTEST);
	$ligne = $result->fetch();
	if($ligne != false){
			$reqSQL1="update lignefraisforfait set quantite = (quantite+$qte1) where idFraisForfait = 'ETP' and idVisiteur = '$idVisiteur' and mois = '$mois';";
			$reqSQL2="update lignefraisforfait set quantite = (quantite+$qte2) where idFraisForfait = 'KM' and idVisiteur = '$idVisiteur' and mois = '$mois';";
			$reqSQL3="update lignefraisforfait set quantite = (quantite+$qte3) where idFraisForfait = 'NUI' and idVisiteur = '$idVisiteur' and mois = '$mois';";
			$reqSQL4="update lignefraisforfait set quantite = (quantite+$qte4) where idFraisForfait = 'REP' and idVisiteur = '$idVisiteur' and mois = '$mois';";

	}else{
		// Ecriture de la requête d'insertion en SQL 
    $reqSQL="INSERT INTO fichefrais VALUES ('$idVisiteur','$mois',0,null,null,'CR');";
	$connexion->exec($reqSQL) or die ("erreur dans la requete sql");
	
	$reqSQL1="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','ETP',$qte1);";
	$reqSQL2="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','KM',$qte2);";
	$reqSQL3="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','NUI',$qte3);";
	$reqSQL4="INSERT INTO lignefraisforfait VALUES ('$idVisiteur','$mois','REP',$qte4);";
	}

    // Exécution de la requête : on insère les informations du formulaire dans la table 
    $connexion->exec($reqSQL1) or die ("erreur dans la requete sql 1");
	$connexion->exec($reqSQL2) or die ("erreur dans la requete sql 2");
	$connexion->exec($reqSQL3) or die ("erreur dans la requete sql 3");
	$connexion->exec($reqSQL4) or die ("erreur dans la requete sql 4");

    // On affiche le résultat pour le visiteur 
    echo("Votre fiche pour ce mois a ete saisie");

    // On ferme la connexion 
    $connexion=null;
?> 
