<?php
session_start();
if($_SESSION['connexion']!='oui')
{
header("location:../../html/login.html");
}else{

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Comptable</title>
<link href="../../css/Comptable.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<b>
<?php
	echo "Vous êtes bien connecté ".$_SESSION['lastname']." ".$_SESSION['firstname'];
	echo "<br>Nous sommes le ".$_SESSION['date'];
	}
?>
</b>.<br/>

<a href="../quitterUtilisateur.php" target="_top">Deconnexion</a>

  <h1> Validation des frais </h1>
<br/>
<form  action="Comptable.php" method="post">
<p>
Choisir un visiteur :
<select name="visiteur">
<option value="*">--Choisir un visiteur--</option>
<?php
require("../connecter.php");
$reqSQL = "select id, nom, prenom from visiteur where profession='visiteur'";
// Exécute la requête
$result=$connexion->query($reqSQL);
// Lecture de la premiere ligne du jeu d'enregistrements
$ligne = $result->fetch();

// Tant qu'on n'a pas atteint la fin du jeu d'enregistrements, on boucle
while ($ligne!= false)
{ // On stocke les données de la classe dans des variables
$id= $ligne['id'];
$nom= $ligne ["nom"];
$pre= $ligne["prenom"];
// On génère une ligne dans la liste déroulante
echo "<option value='$id'>$nom $pre</option>";
// Lecture de la ligne suivante dans le jeu d'enregistrements
$ligne = $result->fetch();
}

//store the value of idVisiteur between pages
$_
?>
</select>
Month
<select name="consultDate">
	<option value="01" selected>Janvier</option>
	<option value="02">Fevrier</option>
	<option value="03">Mars</option>
	<option value="04">Avril</option>
	<option value="05">Mai</option>
	<option value="06">Juin</option>
	<option value="07">Juillet</option>
	<option value="08">Août</option>
	<option value="09">Septembre</option>
	<option value="10">Octobre</option>
	<option value="11">Novembre</option>
	<option value="12">Decembre</option>
</select>
</p>
<br/>
<p>



<table border="2" cellpadding="5">
<tr>
<caption><h2>Frais forfaitaires</h2></caption>
</tr>
<tr>
<th> Repas de midi </th> <th> Nuitée </th> <th> Repas du soir plus Nuitée </th> <th> KM </th> <!--<th> Nb justificatifs </th>-->
</tr>
<tr align="center">

<td width="130"> <input type="text" size="12" name="Rpm" value="<?php echo $rpm ?>" disabled="disabled"/> </td>
<td width="130"> <input type="text" size="12" name="Nui" value="<?php echo $nui ?>" disabled="disabled"/> </td>
<td width="165"> <input type="text" size="20" name="Rsn" value="<?php echo $rsn ?>" disabled="disabled"/> </td>
<td width="130"> <input type="text" size="12" name="kms" value="<?php echo $kms ?>" disabled="disabled"/> </td>


</tr>
</table><br/>
</p>

<table>
<th> Situation </th>
<td width="185">

<input type="radio" name="situation" value="RB"/>RB
<input type="radio" name="situation" value="VA" checked />VA
</td>

</table>

<p>
<table border="2" cellpadding="2" cellpadding="5">
<tr>
<caption><h2>Hors forfait</h2></caption>
</tr>
<tr>
<th>Date</th><th>Libellé </th><th>Montant</th>
</tr>
<tr align="center">

<!-- 1st td -->
<td width="150">

</td>
<!-- 2nd td -->
<td width="130">

</td>
<!-- 3rd td -->
<td width="130">

</td>
</tr>
</table>
</p>

Nb Justificatifs: <input type="text" class="zone" size="12" name="Njbh" value="<?php echo $nbJus ?>" disabled="disabled"/>

<p>
<input type="submit" name="submit" class="btn"/> <input type="reset" class="btn"/>
</p>
</form>
</body>
</html>
