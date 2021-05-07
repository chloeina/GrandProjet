<?php
session_start();
if($_SESSION['connexion']!='oui')
{
header("location:login.html");
}else


//NOTES TO SELF:
// NE PAS OUBLIER DE NE CONSULTER QUE LA FICHE DU MOIS EN COURS...
// DEMANDER COMMENT ILS GARDERONT LES INFOS SUR LA MEME PAGE






?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Comptable</title>
<link href="Comptable.css" rel="stylesheet" type="text/css"/>

</head>

<body>
Vous êtes bien connecté
<b>
<?php
echo $_SESSION['username'];
?>
</b>.<br/>

<a href="quitterUtilisateur.php" target="_top">Deconnexion</a>

  <h1> Validation des frais </h1>
<br/>
<form  action="Comptable.php" method="post">
<p>
Choisir un visiteur :
<select name="visiteur">
<option value="*">---Choisir un visiteur--</option>
<?php
require("connecter.php");
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

?>
</select>
Date 
<select name="consultDate">
	<option value="1" selected>Janvier</option>
	<option value="2">Fevrier</option>
	<option value="3">Mars</option>
	<option value="4">Avril</option>
	<option value="5">Mai</option>
	<option value="6">Juin</option>
	<option value="7">Juillet</option>
	<option value="8">Août</option>
	<option value="9">Septembre</option>
	<option value="10">Octobre</option>
	<option value="11">Novembre</option>
	<option value="12">Decembre</option>
</select>
</p>
<br/>
<p>
<table border="2" cellpadding="2" cellpadding="5">
<tr>
<caption><h2>Frais forfaitaires</h2></caption>
</tr>
<tr>
<th> Repas de midi </th> <th> Nuitée </th> <th> Repas du soir plus Nuitée </th> <th> KM </th> <th> Situation </th> <!--<th> Nb justificatifs </th>-->
</tr>
<tr align="center">
<?php
include('connecter.php');

//if(isset($_POST["consultDate"])){
	//$consultDate = $_POST["consultDate"];
	//echo $consultDate;
//}
$consultDate = "";
 
if(isset($_POST["submit"])){
	$id = $_POST["visiteur"];
	$consultDate = $_POST["consultDate"];
}

// PARTIE REPAS DE MIDI
$reqSQL1 = "select `lignefraisforfait`.* from lignefraisforfait, fichefrais where `lignefraisforfait`.idVisiteur = '$id' and idFraisForfait = 'REP' and `lignefraisforfait`.mois = '$consultDate' and idEtat <> 'VA' and `fichefrais`.idVisiteur = `lignefraisforfait`.idVisiteur";
	//execute la requete
	$result1 = $connexion->query($reqSQL1);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne1 = $result1->fetch();
	$preRpm = $ligne1["quantite"];
	$rpm = $preRpm*25;
	
	$result1 ->closeCursor();
//echo $rpm;

// PARTIE NUITEE
$reqSQL2 = "select * from lignefraisforfait where idVisiteur = '$id' and idFraisForfait = 'NUI'";
	//execute la requete
	$result2 = $connexion->query($reqSQL2);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne2 = $result2->fetch();
	$preNui = $ligne2["quantite"];
	$nui = $preNui*80;
	
	$result2 ->closeCursor();
	
//PARTIE ETAPE
$reqSQL3 = "select * from lignefraisforfait where idVisiteur = '$id' and idFraisForfait = 'ETP'";
	//execute la requete
	$result3 = $connexion->query($reqSQL3);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne3 = $result3->fetch();
	$preRsn = $ligne3["quantite"];
	$rsn = $preRsn*110;
	
	$result3 ->closeCursor();
	
//PARTIE KM
$reqSQL4 = "select * from lignefraisforfait where idVisiteur = '$id' and idFraisForfait = 'KM'";
	//execute la requete
	$result4 = $connexion->query($reqSQL4);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne4 = $result4->fetch();
	$preKms = $ligne4["quantite"];
	$kms = $preKms*0.62;
	
	$result4 ->closeCursor();
?>
<td width="130"> <input type="text" size="12" name="Rpm" value="<?php echo $rpm ?>" disabled="disabled"/> </td>
<td width="130"> <input type="text" size="12" name="Nui" value="<?php echo $nui ?>" disabled="disabled"/> </td>
<td width="165"> <input type="text" size="20" name="Rsn" value="<?php echo $rsn ?>" disabled="disabled"/> </td>
<td width="130"> <input type="text" size="12" name="kms" value="<?php echo $kms ?>" disabled="disabled"/> </td>
<td width="170">
<input type="radio" name="FFRadio" value="CL"/>SC
<input type="radio" name="FFRadio" value="CR"/>SEC
<input type="radio" name="FFRadio" value="RB"/>R
<input type="radio" name="FFRadio" value="VA"/>V
</td>
<!--<td>
<input type="text" class="zone" size="12" name="Nbjf"/>
</td>-->

</tr>
</table><br/>
</p>
<p>
<table border="2" cellpadding="2" cellpadding="5">
<tr>
<caption><h2>Hors forfait</h2></caption>
</tr>
<tr>
<th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th>
</tr>
<tr align="center">
<!--?php
include('connecter.php');

$id = $_POST["visiteur"];

// PARTIE DATE
$reqSQL5 = "select * from lignefraishorsforfait where idVisiteur = '$id'";
	//execute la requete
	$result5 = $connexion->query($reqSQL5);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne5 = $result5->fetch();
	$dat = $ligne5["date"];
	
	$compt = 0;
	while($ligne5!=false){
		$dat = $ligne5["date"];
		$compt = $compt+1;
		//on gere une ligne dans la liste deroulante
		echo '<br><input type="date" size="12" name="dat<?php echo $compt ?>" value="$dat"/>';
		//lecture de la ligne suivante dans le jeu d'enregistrements
		$ligne5 = $result5->fetch();
	}

?>-->
<!-- 1st td -->
<td width="150">
<?php
include('connecter.php');

//$id = $_POST["visiteur"];

// PARTIE DATE
$reqSQL5 = "select * from lignefraishorsforfait where idVisiteur = '$id'";
	//execute la requete
	$result5 = $connexion->query($reqSQL5);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne5 = $result5->fetch();
	
	while($ligne5 != false){
		$dat = $ligne5["date"];
		echo "<input type=\"date\" name=\"Lib\" value=\"".$dat."\" disabled=\"disabled\"/><br><br>";
		$ligne5 = $result5->fetch();
	}
	$result5 ->closeCursor();
?>
<!--<input type="date" size="12" name="Dat" value=""/>-->
</td>
<!-- 2nd td -->
<td width="130">
<?php
include('connecter.php');

//$id = $_POST["visiteur"];

// PARTIE DATE
$reqSQL6 = "select * from lignefraishorsforfait where idVisiteur = '$id'";
	//execute la requete
	$result6 = $connexion->query($reqSQL6);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne6 = $result6->fetch();
	while($ligne6 != false){
		$lib = $ligne6["libelle"];
		echo "<input type=\"text\" size=\"12\" name=\"Lib\" value=\"".$lib."\" disabled=\"disabled\"/><br><br>";
		$ligne6 = $result6->fetch();
	}
	$result6 ->closeCursor();
?>
<!--<input type="text" size="12" name="Lib" value=""/>-->
</td>
<!-- 3rd td -->
<td width="130">
<?php
include('connecter.php');

//$id = $_POST["visiteur"];

// PARTIE DATE
$cpt = 0;
$reqSQL7 = "select * from lignefraishorsforfait where idVisiteur = '$id'";
	//execute la requete
	$result7 = $connexion->query($reqSQL7);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne7 = $result7->fetch();
	while($ligne7 != false){
		$mont = $ligne7["montant"];
		echo "<input type=\"text\" size=\"12\" name=\"Lib\" value=\"".$mont."\" disabled=\"disabled\"/><br><br>";
		$ligne7 = $result7->fetch();
		
		$cpt = $cpt+1;
	}
	//echo $cpt;
	$result7 ->closeCursor();
?>
<!--<input type="text" size="12" name="Mont" value=""/>-->
</td>
<!-- 4th td -->
<td width="165">
<!--<select size="3" name="Sith">
<option value="E">Enregistré</option>
<option value="V">Validé</option>
<option value="R">Remboursé</option>
</select>-->
<?php
include('connecter.php');

$name = 0;
// PARTIE SITUATION
for($i=0; $i<$cpt; $i=$i+1){
	$name = $name + 100;
	echo "<input type=\"radio\" name=\"".$name."\" value=\"CL\"/>SC";
	echo "<input type=\"radio\" name=\"".$name."\" value=\"CR\"/>SEC";
	echo "<input type=\"radio\" name=\"".$name."\" value=\"RB\"/>R";
	echo "<input type=\"radio\" name=\"".$name."\" value=\"VA\"/>V";
	echo "<br>";
	echo "<br>";
}
?>
</td>


</tr>

</table>
</p>

<?php
include('connecter.php');

//$id = $_POST["visiteur"];

// PARTIE DATE
$reqSQL8 = "select * from fichefrais where idVisiteur = '$id'";
	//execute la requete
	$result8 = $connexion->query($reqSQL8);
	//on ne peut pas acceder a $result sans la methode fetch()
	$ligne8 = $result8->fetch();
	$nbJus = $ligne8["nbJustificatifs"];
	$result8 ->closeCursor();
?>
Nb Justificatifs: <input type="text" class="zone" size="12" name="Njbh" value="<?php echo $nbJus ?>" disabled="disabled"/>

<p>
<input type="submit" name="submit" class="btn"/> <input type="reset" class="btn"/>
</p>
</form>
</body>
</html>

<?php
  echo"Vous êtes bien sur la page de comptable";
 
?>
