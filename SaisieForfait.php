<?php
	session_start();
	if($_SESSION['connexion']!='oui')
	{
		header("location:login.html");
	}
	else

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Saisie</title>
	<link href="SaisieForfait.css" rel="stylesheet" type="text/css" />
	
	<SCRIPT LANGUAGE="JavaScript">
		var maintenant=new Date();
		var mois=maintenant.getMonth()+1;
		var an=maintenant.getFullYear();
		document.write("Nous sommes le ",mois,"/",an,".");
	</SCRIPT>
</head>

<body>
	Vous êtes bien connecté 
	<b>
		<?php
		echo $_SESSION['username'];
		?>
	</b>.<br/>
		<div>
			<ul>
				<li>
					<a href="quitterUtilisateur.php" target="_top" class="deco">Deconnexion</a>
				</li>
				<li>
					<a href="ConsulterForfait.php" > Consultation des saisies </a>
				</li>
			</ul>	
		</div><br/>
		
	<h1> Saisis des frais </h1>
	<form action="saisie.php" method="post" name="saisieforfait">
		<table border="2" cellpadding="2" cellpadding="5">
			<tr>
				<caption>Etat des frais forfaitaires</caption>
			</tr>
			<tr align="center">
				<th> Frais forfaitaires </th> <th> Repas midi </th> <th> Nuitée </th><th> Repas soir plus nuitée </th> <th> Kilomètres </th> 
			</tr>
			<tr align="center">
				<th> Montant </th>
				<td width="90" ><input type="text" size="10" name="RQ"/></td>
				<td width="90"><input type="text" size="10" name="NQ"/></td> 
				<td width="90"> <input type="text" size="10" name="RNQ"/></td>
				<td width="90"> <input type="text" size="10" name="KQ"/></td>
			</tr>

		</table><br/>
		
		<table border="2" cellpadding="2" cellpadding="5">
			<tr>
				<caption> Frais hors forfait </caption>
			</tr>
			<tr align="center">
				<th>Ajouter des frais hors forfait </th> 
				<td width="90" ><a href="SaisieHorsForfait.php">Ajouter</a></td>
			</tr>
		</table><br/>
		<div>		
			<input type="reset" class="btn"/><input type="submit" class="btn"/>
		</div><br/>
	</form>
</body>
</html>
