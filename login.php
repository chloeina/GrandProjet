<?php
ob_start();
// Appel du script de connexion au serveur et à la base de données
	require("connecter.php"); 

// On récupère les données saisies dans le formulaire
	$username = $_POST["username"];
	$mdpSaisi = $_POST["password"];
	//$profession = $_POST["profession"];

// On récupère dans la base de données le mot de passe qui correspond au nom saisi par le visiteur
	$sql = "select mdp from visiteur where login= '$username'";
	$result = $connexion ->query($sql);
	$ligne = $result ->fetch();
	$motPasseBdd = $ligne['mdp'];
	
	//TESTS
	// On récupère dans la base de données la profession qui correspond au nom saisi par le visiteur
	$sql2 = "select profession from visiteur where login= '$username'";
	$result2 = $connexion ->query($sql2);
	$ligne2 = $result2 ->fetch();
	$profession = $ligne2['profession'];
	//END TESTS
	//IT WORKS

	// On vérifie que le mot de passe saisi est identique à celui enregistré dans la base de données

	if  ($mdpSaisi!=$motPasseBdd)
	// Le mot de passe est différent de celui de la base utilisateur
	{
		//TEST //include('login.html');
		echo 'Votre saisie est erronée, veuillez recommencer...'; 

		// On inclut le formulaire d'identification (index.html)
		include('login.html');

		// On quitte le script courant sans effectuer les éventuelles instructions qui suivent
		exit; 
	}
	else
	// Le mot de passe saisi correspond à celui de la base utilisateur
	{
		if($profession == 'visiteur'){
			
			header("location:saisieForfait.html");
		ob_end_flush();
		// On quitte le script courant sans effectuer les éventuelles  instructions qui suivent
		exit;
		
		}else{
			
			header("location:Comptable.html");
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