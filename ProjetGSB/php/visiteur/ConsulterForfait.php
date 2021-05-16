<?php
	session_start();
	if($_SESSION['connexion']!='oui')
	{
		header("location:../../html/login.html");
	}
	else{
	
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Consulter</title>
    
    <link href="../../css/" rel="stylesheet" type="text/css" />
  </head>
  
  <body>

		<b>
			<?php
		echo "<h3>Vous êtes bien connecté ".$_SESSION['lastname']." ".$_SESSION['firstname']."</h3>";
		echo "<br><h3>Nous sommes le ".$_SESSION['dateJour']."</h3>";
		$id = $_SESSION['id'];
		}
		?>
		</b>.<br/>
	   <div class="zone-btns">
			
					<a href="../quitterUtilisateur.php" target="_top" id="deconnexion">Deconnexion</a>
				
					<a href="SaisieForfait.php" > Nouvelle Saisie </a>
				
		</div><br/>
		<h1 id="titre">Consultation des anciennes fiches de remboursement : </h1>
		<div class="form-consult">
		<form action="ConsulterForfait.php" method="post" name="consulterforfait">
			<p>
		
			Month
			<select class="mois" name="consultDate">
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
			<p>
	<div class="disp-FF">
	<table border="2" cellpadding="5">
		<tr>
			<caption><h2 id="sous-titre">Frais forfaitaires</h2></caption>
		</tr>
		<tr>
		<th> Repas de midi </th> <th> Nuitée </th> <th> Repas du soir plus Nuitée </th> <th> KM </th> 
		</tr>
		<tr align="center">
			<?php
			include('../connecter.php');
			 
			 $consultDate = "";
			if(isset($_POST["submit"])){
				/*$id = $_POST["visiteur"];*/
				$consultDate = $_POST["consultDate"];
				
				//store the value of idVisiteur between pages
				/*$_SESSION["idVisiteur"] = $id;*/
				$_SESSION["date"] = $consultDate;
			}

			// PARTIE REPAS DE MIDI
			$reqSQL1 = "select * from lignefraisforfait, fichefrais where lignefraisforfait.idVisiteur=fichefrais.idVisiteur and lignefraisforfait.idVisiteur = '$id' and idFraisForfait = 'REP' and lignefraisforfait.mois = '$consultDate' and idEtat in('CL', 'CR')";
				//execute la requete
				$result1 = $connexion->query($reqSQL1);
				//on ne peut pas acceder a $result sans la methode fetch()
				$ligne1 = $result1->fetch();
				$preRpm = $ligne1["quantite"];
				$rpm = $preRpm*25;
				
					if($ligne1 == false and isset($_POST["submit"])){
						echo "Pas de fiche en cours de saisie pour ce mois ou elle a ete deja rembousee";
					}
				
				$result1 ->closeCursor();
			//echo $rpm;

			// PARTIE NUITEE
			$reqSQL2 = "select * from lignefraisforfait, fichefrais where lignefraisforfait.idVisiteur=fichefrais.idVisiteur and lignefraisforfait.idVisiteur = '$id' and idFraisForfait = 'NUI' and lignefraisforfait.mois = '$consultDate' and idEtat in('CL', 'CR')";
				//execute la requete
				$result2 = $connexion->query($reqSQL2);
				//on ne peut pas acceder a $result sans la methode fetch()
				$ligne2 = $result2->fetch();
				$preNui = $ligne2["quantite"];
				$nui = $preNui*80;
				
					
				
				$result2 ->closeCursor();
				
			//PARTIE ETAPE
			$reqSQL3 = "select * from lignefraisforfait, fichefrais where lignefraisforfait.idVisiteur=fichefrais.idVisiteur and lignefraisforfait.idVisiteur = '$id' and idFraisForfait = 'ETP' and lignefraisforfait.mois = '$consultDate' and idEtat in('CL', 'CR')";
				//execute la requete
				$result3 = $connexion->query($reqSQL3);
				//on ne peut pas acceder a $result sans la methode fetch()
				$ligne3 = $result3->fetch();
				$preRsn = $ligne3["quantite"];
				$rsn = $preRsn*110;
				
					
				
				$result3 ->closeCursor();
				
			//PARTIE KM
			$reqSQL4 = "select * from lignefraisforfait, fichefrais where lignefraisforfait.idVisiteur=fichefrais.idVisiteur and lignefraisforfait.idVisiteur = '$id' and idFraisForfait = 'KM' and lignefraisforfait.mois = '$consultDate' and idEtat in('CL', 'CR')";
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


		</tr>
	</table><br/>
	</div>
			</p>
			<p>
	<div class="disp-HF">
	<table border="2" cellpadding="2" cellpadding="5">
		<tr>
			<caption><h2 id="sous-titre">Hors forfait</h2></caption>
		</tr>
		<tr>
			<th>Date</th><th>Libellé </th><th>Montant</th>
		</tr>
		<tr align="center">

			<!-- 1st td -->
			<td width="150">
				<?php
				include('../connecter.php');

				//$id = $_POST["visiteur"];

				// PARTIE DATE
				$reqSQL5 = "select * from lignefraishorsforfait where idVisiteur = '$id' and mois = '$consultDate'";
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

			</td>
			<!-- 2nd td -->
			<td width="130">
				<?php
				include('../connecter.php');

				//$id = $_POST["visiteur"];

				// PARTIE DATE
				$reqSQL6 = "select * from lignefraishorsforfait where idVisiteur = '$id' and mois = '$consultDate'";
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

			</td>
			<!-- 3rd td -->
			<td width="130">
				<?php

				// PARTIE DATE
				$cpt = 0;// sert a afficher le nb d'apparition des btns radio
				$reqSQL7 = "select * from lignefraishorsforfait where idVisiteur = '$id' and mois = '$consultDate'";
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
			</td>
		</tr>
	</table>
	</div>
	</p>

		<div class="plus">
		<?php

		// PARTIE DATE
		$reqSQL8 = "select * from fichefrais where idVisiteur = '$id' and mois = '$consultDate'";
			//execute la requete
			$result8 = $connexion->query($reqSQL8);
			//on ne peut pas acceder a $result sans la methode fetch()
			$ligne8 = $result8->fetch();
			$nbJus = $ligne8["nbJustificatifs"];
			$result8 ->closeCursor();
		?>
		<h3>Nb Justificatifs:</h3> <input type="text" class="zone" size="12" name="Njbh" value="<?php echo $nbJus ?>" disabled="disabled"/>
		<?php
		$reqSQL9 = "select * from fichefrais where idVisiteur = '$id' and mois = '$consultDate'";
			//execute la requete
			$result9 = $connexion->query($reqSQL9);
			//on ne peut pas acceder a $result sans la methode fetch()
			$ligne9 = $result9->fetch();
			$etat = $ligne9["idEtat"];
			$result9 ->closeCursor();
		?>
		<h3>Etat:</h3> <input type="text" class="zone" size="12" name="Etat" value="<?php echo $etat ?>" disabled="disabled"/>


		<p>
		<input type="submit" name="submit" id="btn"/> <input type="reset" id="btn"/>
		</div>
		</p>
		</form>
		</div>
	</body>
</html>
