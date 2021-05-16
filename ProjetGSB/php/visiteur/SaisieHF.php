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
		<a href="../quitterUtilisateur.php" > Deconnexion </a><br/>

	</body>
</html>
<?php
	// Appel du script de connexion
    require ("../connecter.php");
	
	$idVisiteur = $_SESSION['id'];
    //$mm = date('m');
	//$mos=(int)$mm;
	$mois= $_SESSION['mois'];
	//(string)$mos;
	
	$libelle = $_POST["Lib"];
	$date = $_POST["Dat"];
	$montant = $_POST["Mont"];
	$nbJus = 0;
	$nbJus = $_POST["NbJus"];
	
	 $reqSQL="INSERT INTO lignefraishorsforfait VALUES ('','$idVisiteur','$mois','$libelle','$date',$montant);";
	$connexion->exec($reqSQL) or die ("erreur dans la requete sql");
	
	if($nbJus != 0){
		
		$reqSQL2="update fichefrais set nbJustificatifs = (nbJustificatifs+$nbJus) where idVisiteur = '$idVisiteur' and mois = '$mois';";
		$connexion->query($reqSQL2) or die ("erreur dans la requete sql 2");
	}
	
	echo( "Votre saisie a bien été prise en compte"."<br>");
	
    // On ferme la connexion 
    $connexion=null;
?>
