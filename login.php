<?php 
	require("connecter.php");
	
	//on recupere les informations pour la connexion
	$uname=$_POST['username'];
	$password=$_POST['password'];
	$fonction=$_POST['fonction'];

	$sql="SELECT login FROM visiteur WHERE nom='$uname'";
	$result = $connexion->query($sql);
	$ligne = $result->fetch();
	$password = $ligne['password'];
	
	if($password!=$motPasseBdd){
		echo "Votre identifiant ou mot de passe est faux! ";
		include('login.html');
		}
		else{
			session_start();
			$_SESSION['connexion']="oui";
			$_SESSION['username']=$uname;
			
			if($fonction=='comptable'){
				header("location:Comptable.php");

			 }else{
				header("location:SaisieForfait.php");
				}   
			}	
		//on libère le jeu d'enregistrement
		$res->closeCursor();
		// on ferme la connexion au SGBD
		$connexion=null;
?>