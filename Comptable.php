<?php
	session_start();
	if($_SESSION['connexion']!='oui')
	{
		header("location:login.html");
	}
	else

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
	<p><a href="quitterUtilisateur.php" target="_top">Deconnexion</a></p>
  <h1> Validation des frais </h1>
<br/>
	<form  action="Comptable.php" method="post">
		<p>
			<label for="visiteur-select">Choisir le visiteur</label>
				<select name="choix" id="visiteur-select">
					<option value="1" name="choix">VIGNAL Léa</option>
					<option value="2" name="choix">HABIB Hinda</option>
					<option value="3" name="choix">HENRY Chloé</option>
				</select> 

			Date <input type="month" name="consultationdate"> 
		</p>
		<br/>
		<p>
			<table border="2" cellpadding="2" cellpadding="5">
				<tr>
					<caption><h2>Frais forfaitaires</h2></caption>
				</tr>
				<tr>
					<th> Repas de midi </th> <th> Nuitée </th> <th> Repas du soir plus Nuitée </th> <th> KM </th> <th> Situation </th> <th> Nb justificatifs </th>
				</tr>
				<tr align="center">
					<td width="100" ><input type="text" size="12" name="Rpm"/></td>
					<td width="220"><input type="text" size="30" name="Nui"/></td> 
					<td width="90"> <input type="text" size="10" name="Rsn"/></td>
					<td width="90"> <input type="text" size="10" name="kms"/></td>
					<td width="80"> 
						<select size="4" name="Sitf">
							<option value="E">Enregistré</option>
							<option value="V">Validé</option>
							<option value="R">Remboursé</option>
						</select>
					</td>
					<td>
						<input type="text" class="zone" size="6" name="Nbjf"/>
					</td>		

				</tr>
			</table><br/>
		</p>
		<p>
			<table border="2" cellpadding="2" cellpadding="5">
				<tr>
					<caption><h2>Hors forfait</h2></caption>
				</tr>
				<tr>
					<th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th><th> Nb justificatifs </th>
				</tr>
				<tr align="center"><td width="100" ><input type="text" size="12" name="Dat"/></td>
					<td width="220"><input type="text" size="30" name="Lib"/></td> 
					<td width="90"> <input type="text" size="10" name="Mont"/></td>
					<td width="80"> 
						<select size="3" name="Sith">
							<option value="E">Enregistré</option>
							<option value="V">Validé</option>
							<option value="R">Remboursé</option>
						</select>
					</td>
					<td>
						<input type="text" class="zone" size="6" name="Njbh"/>
					</td>	
				</tr>
				
			</table>		
		</p>	
		<p>
			<input class="zone" type="reset" /><input type="submit">
		</p>
	</form>
</body>
</html>

<?php
  // Définir le nouveau fuseau horaire
  //date_default_timezone_set('Europe/Paris');
  //$date = date(' m-y');
  //echo $date."<BR />";

  echo"Vous avez choisi : ";
  $choix=$_POST["choix"];
  switch($choix)
  {
	  case "1" : $choix;
	  
				break;
   	  case "2" : $choix;
				break;
	  case "3" : $choix;
				break;
  }
  echo"$choix"; 
  
?>
