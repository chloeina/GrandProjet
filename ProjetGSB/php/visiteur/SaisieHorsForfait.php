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
	<script type="text/javascript">
	function verifChamps()
	{
		if (document.getElementById('Dat').value=='' 
		|| document.getElementById('Lib').value=='' 
		|| document.getElementById('Mont').value==''
           )
		{
			alert("Veuillez remplir tous les champs");
			return false;
		}
		else
		{
			return true;
		}
	}
</script>
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
		
				<a href="quitterUtilisateur.php" target="_top" id="deconnexion">Deconnexion</a>
			
				<a href="SaisieForfait.php" > Saisie des frais </a>
				
	</div><br/>
	<h1 id="titre"> Saisie des frais hors forfait </h1>
	<div class="form-HF">
	<form action="SaisieHF.php" method="post" name="saisiehorsforfait" onSubmit="return verifChamps()">
	
		<table border="2" cellpadding="2" cellpadding="5">
			<tr>
				<caption><h2 id="sous-titre">Hors forfait</h2></caption>
			</tr>
			<tr>
				<th>Date</th><th>Libellé</th><th>Montant</th><th> Justificatifs </th>
			</tr>
			<tr align="center">
			
				<td width="100" ><input type="date" size="12" name="Dat" id="Dat"/></td>
				<td width="220"><input type="text" size="30" name="Lib" id="Lib"/></td> 
				<td width="90"> <input type="number" size="10" name="Mont" id="Mont" min="0" /></td>
				<td><input type="checkbox" name="NbJus" value=1 /></td>
			</tr>
		</table>	<br/>
		
			<input type="reset" name="Annuler" id="btn"/><input type="submit" name="Envoyer" id="btn"/>
		<br/>
	</form>
	</div>
</body>
</html>
