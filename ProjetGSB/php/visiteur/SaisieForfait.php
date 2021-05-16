<?php
	session_start();
	if($_SESSION['connexion']!='oui')
	{
		header("location:../../html/login.html");
	}
	else{

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Saisie</title>
	<link href="../../css/" rel="stylesheet" type="text/css" />
</head>

<body>
	<b>
		<?php
	echo "<h3>Vous êtes bien connecté ".$_SESSION['lastname']." ".$_SESSION['firstname']."</h3>";
	echo "<br><h3>Nous sommes le ".$_SESSION['dateJour']."</h3>";
	}
?>
	</b>.<br/>
		<div class="zone-btns">
			
					<a href="../quitterUtilisateur.php" target="_top" id="deconnexion">Deconnexion</a>
				
					<a href="ConsulterForfait.php" id="autres-btns"> Consultation des saisies </a>
					
		</div><br/>
		
	<h1 id="titre"> Saisis des frais </h1>
	<div class="form">
	<form action="Saisie.php" method="post" name="saisieforfait">
		<div class="form-FF">
		<table border="2" cellpadding="2" cellpadding="5">
		
			<tr>
				<caption><h2 id="sous-titre">Etat des frais forfaitaires</h2></caption>
			</tr>
			<tr align="center">
				<th> Frais forfaitaires </th> <th> Repas midi </th> <th> Nuitée </th><th> Repas soir plus nuitée </th> <th> Kilomètres </th> 
			</tr>
			<tr align="center">
				<th> Quantité </th>
				<td width="90" ><input type="number" size="3" name="RQ" min="0" max="31"/></td>
				<td width="90"><input type="number" size="3" name="NQ" min="0" max="31"/></td> 
				<td width="90"> <input type="number" size="3" name="RNQ" min="0" max="31"/></td>
				<td width="90"> <input type="number" size="3" name="KQ" min="0"/></td>
			</tr>

		</table><br/>
		</div>
		<div class="table-HF">
		<table border="2" cellpadding="2" cellpadding="5">
			<tr>
				<caption> <h2 id="sous-titre">Frais hors forfait </caption>
			</tr>
			<tr align="center">
				<th>Ajouter des frais hors forfait </th> 
				<td width="90" ><a href="SaisieHorsForfait.php">Ajouter</a></td>
			</tr>
		</table><br/>
		</div>
			<input type="reset" id="btn"/><input type="submit" id="btn"/>
		<br/>
	</form>
	</div>
</body>
</html>
