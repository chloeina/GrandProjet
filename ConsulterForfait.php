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
    <title>Consulter</title>
    
    <link href="SaisieForfait.css" rel="stylesheet" type="text/css" />
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
				<a href="SaisieForfait.php" > Nouvelle Saisie </a>
			</li>
		</ul>	
	</div><br/>
	<h1>Consultation des anciennes fiches de remboursement : </h1>
  <h2>Date : <input type="month" name="consultationdate"> </h2>
<br><br>
<h3><li>2020</li></h3>
<br><br>
<h3><li>2019</li></h3>
<br><br>
<h3><li>2018</li></h3>
<br><br>
<h3><li>2017</li></h3>
<br><br>
<h3><li>2016</li></h3>
<br><br>
<h3><li>2015</li></h3>

  </body>
</html>