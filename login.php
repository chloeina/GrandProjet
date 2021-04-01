<html>
<?php 

include(connecter.php);


    
$uname=$_POST['username'];
$password=$_POST['password'];
    
$sql="SELECT login FROM utilisateurs WHERE nom='$uname'";
$result = $connexion->query($sql);
$ligne = $result->fetch();
$password = $ligne['password'];

$sqlr="SELECT fonction FROM utilisateurs";
$result = $connexion->query($sql);
$ligne = $result->fetch();
$fonction = $ligne['fonction'];
	
if($password!=$motPasseBdd){
   
     echo " Votre identifiant ou mot de passe est faux! ";
 	include('login.html');
    exit;
    }
    else{
	   
	  if($fonction==0){
       		header("location:Gestion.html");
		ob_end_flush();
		exit;
	 }else{
	 	header("location:Comptable.html");
		ob_end_flush();
		exit;
		}   
}
?>
</html>
