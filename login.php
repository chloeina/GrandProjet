<?php 
ob_start();
require("connecter.php");


$uname=$_POST['username'];
$password=$_POST['password'];
    
$sql="SELECT login FROM visiteur WHERE nom='$uname'";
$result = $connexion->query($sql);
$ligne = $result->fetch();
$password = $ligne['password'];
$profession=$_POST['profession'];
	
if($password!=$motPasseBdd){
   
     echo " Votre identifiant ou mot de passe est faux! ";
 	include('index.html');
    exit;
    }
    else{
	   
	  if($profession=='visiteur'){
       	header("location:Gestion.html");
		ob_end_flush();
		exit;
	 }else{
	 	header("location:Comptable.html");
		ob_end_flush();
		exit;
		}   
		
}
//on libère le jeu d'enregistrement
	$res->closeCursor();
	// on ferme la connexion au SGBD
	$connexion=null;
?>
