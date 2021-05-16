<?php
ob_start();
// Appel du script de connexion au serveur et à la base de données
	require("connecter.php"); 

// On récupère les données saisies dans le formulaire
	$username = $_POST["username"];
	$mdpSaisi = $_POST["password"];
	//$profession = $_POST["profession"];

	$sql = "select mdp from visiteur where login= '$username'";
	$result = $connexion ->query($sql);
	$ligne = $result ->fetch();
	$motPasseBdd = $ligne['mdp'];
	
	//recup profession visiteur
	$sql2 = "select profession from visiteur where login= '$username'";
	$result2 = $connexion ->query($sql2);
	$ligne2 = $result2 ->fetch();
	$profession = $ligne2['profession'];
	//END TESTS
	//IT WORKS
	
	//recup nom et prenom visiteur
	$sql3 = "select nom, prenom from visiteur where login= '$username'";
	$result3 = $connexion ->query($sql3);
	$ligne3 = $result3 ->fetch();
	$lastname = $ligne3['nom'];
	$firstname = $ligne3['prenom'];

	// recupere ID visiteur
	$sql4 = "select id from visiteur where login= '$username'";
	$result4 = $connexion ->query($sql4);
	$ligne4 = $result4 ->fetch();
	$idVisiteur = $ligne4['id'];

	// On vérifie que le mot de passe saisi est identique à celui enregistré dans la base de données

	if  ($mdpSaisi!=$motPasseBdd)
	// Le mot de passe est différent de celui de la base utilisateur
	{
		//TEST //include('login.html');
		echo "<h2>Votre saisie est erronée, veuillez recommencer...</h2>"; 

		// On inclut le formulaire d'identification (index.html)
		include('../html/login.html');

		// On quitte le script courant sans effectuer les éventuelles instructions qui suivent
		exit; 
	}
	else
	// Le mot de passe saisi correspond à celui de la base utilisateur
	{
		session_start();
			$_SESSION['connexion']="oui";
			$_SESSION['username'] = $username;
			$_SESSION['dateJour'] = date('d-m-Y');
			$_SESSION['dateMois'] = date('m');
			$_SESSION['lastname'] = $lastname;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['id'] = $idVisiteur;
			$mm = date('m');
			$mos=(int)$mm;
			$mois= (string)$mos;
			$_SESSION['mois'] = $mois;
		
		if($profession == 'visiteur'){
			
			header("location:visiteur/saisieForfait.php");
		ob_end_flush();
		// On quitte le script courant sans effectuer les éventuelles  instructions qui suivent
		exit;
		
		}else{
			
			header("location:comptable/Comptable.php");
		ob_end_flush();
		// On quitte le script courant sans effectuer les éventuelles  instructions qui suivent
		exit;
		
		}
		
	}
	
	//on libère le jeu d'enregistrement
	$result ->closeCursor(); 
	// on ferme la connexion au SGBD
	$connexion = null;


?>
