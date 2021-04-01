<html>
<?php 

include();

if(isset($_POST['submit'])){
    
    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="select * from loginform where user='".$uname."'AND Pass='".$password."' limit 1";
    
    $result=$connexion->query($sql);
    
    if($connexion->rowCount($result)>0){
        //rediriger vers la page v ou c
		echo "c'est fait";
    }
    else{
        echo " Votre identifiant ou mot de passe est faux! ";
        exit();
    }
        
}
?>
</html>
