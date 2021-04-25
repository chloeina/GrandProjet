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
				<a href="SaisieForfait.php" > Saisie des frais </a>
			</li>
		</ul>	
	</div><br/>
	<form action="SaisieHorsForfait.php" method="post" name="saisiehorsforfait">
		<table border="2" cellpadding="2" cellpadding="5">
			<tr>
				<caption>Hors forfait</caption>
			</tr>
			<tr>
				<th>Date</th><th>Libellé</th><th>Montant</th><!--<th> Justificatifs </th>-->
			</tr>
			<tr align="center">
			
				<td width="100" ><input type="text" size="12" name="Dat"/></td>
				<td width="220"><input type="text" size="30" name="Lib"/></td> 
				<td width="90"> <input type="text" size="10" name="Mont"/></td>
				<!--<td><input type="text" class="zone" size="6" name="Njbh"/></td>	 -->
			</tr>
		</table>	<br/>
		<div>
			<input type="reset" name="Annuler" /><input type="submit" name="Envoyer" />
		</div><br/>
	</form>
</body>
</html>
<?php
	
	echo"Vous etes bien sur la page de frais hors forfait";
	//mettre ici les infos pour la base de données
?>