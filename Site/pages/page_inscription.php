<?php



if (isset($_POST["forminscription"])) {
		$pseudo= htmlspecialchars($_POST["pseudo"]);
		$mail= htmlspecialchars($_POST["mail"]);
		$mail2= htmlspecialchars($_POST["mail2"]);
		$mdp= sha1($_POST["mdp"]);
		$mdp2= sha1($_POST["mdp2"]);

		$pseudoleght = strlen($pseudo);

	if (!empty($_POST["pseudo"]) AND !empty($_POST["mail"] )AND !empty($_POST["mail2"]  )AND !empty($_POST["mdp"] )AND !empty($_POST["mdp2"] )) {
		/* C'est plus sécurisé de passer les reponses en variable HP */

		/* TEST LONGUEUR PSEUDO */
		if ($pseudoleght<=255) 
		{$reqpseudo= $bdd->prepare("SELECT * From membres WHERE pseudo = ?");
					$reqpseudo ->execute(array($pseudo));
					$pseudoexist = $reqpseudo ->rowCount();
					if ($pseudoexist ==0) {
						/* TEST MEME ADRESSE MAIL */
						if ($mail==$mail2)  
						{
							/* TEST FORMAT ADRESSE EMAIL */
							if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
								# code...
								/* TEST SI ADRESSE EXISTE DEJA */
								$reqmail= $bdd->prepare("SELECT * From membres WHERE mail = ?");
								$reqmail ->execute(array($mail));
								$mailexist = $reqmail ->rowCount();
								if ($mailexist ==0) {
									# code...
								
										/* TEST DES 2 MOTS DE PASSES */
										if ($mdp==$mdp2) 
										{
											$sql = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES (?, ?, ?)");
											$sql->execute(array(
											    $pseudo, $mail, $mdp));
											$erreur = "Votre compte a bien été créé !";
											header("Location: connexion.php");

										}

										else
										{$erreur = "Vos mots de passe ne correspondent pas !";}
								}
								else
								{
									$erreur = "Adresse mail deja utilisée ! ";
								}
							}
							else
							{$erreur = "Votre adresse mail n'est pas valide";}

						}
						else
						{$erreur = "Vos 2 Emails ne correspondent pas !";}
				}else
				{$erreur = "Pseudo deja utilisé !";}
		}
		else
		{
			$erreur = "Votre pseudo ne doit pas depasser 255 caractères";
		}
	}
	/* TEST SI TOUT LES CHAMPS SONT COMPLETES */
	else
	{
		$erreur = "Tout les champs doivent être completés !";
	}

	;}




?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"></meta>
<link rel="stylesheet" href="../style/cssinscription.css" />
<link rel="stylesheet" href="../style/slider.css" /> 
<center><img id="logoIMIE" src="../images/LogoIMIE.png"></center>
<title>IMIE-Blog</title>

</head>
	
<body>

					<div id="slideshow">
                        <div id="sContent"><!--
                            --><li><img class="imgdef" src="../images/LogoIMIE.png" alt="Image bleue" width="475px"/></li><!--
                            --><li><img class="imgdef" src="../images/LogoIMIE.png" alt="Image verte" width="479px"/></li><!--
                            --><li><img class="imgdef" src="../images/LogoIMIE.png" alt="Image brune" width="483px"/></li>
                        </div>
                    </div>

	<p id="retour"> <a href="../index.php"> Retourner à l'accueil </a>
	<p align="center"><font size="5">Créez Votre Compte</font></p>
	<hr width="50%" align="center">
	<div class="fop" align="center">
 <form action="" method="post">
 	<fieldset>
		<!-- Elements du formulaire -->
		<!-- Nom obligatoire pour le traitement php -->
		<table>
			<tr>
				<td>
					<label for="pseudo">Pseudo :</label>
				</td>
				<td>
					<input type="texte" name="pseudo" placeholder="Prenom" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; } ?>">
				</td>
				<tr>
				<td>
					<label for="mail">E-mail :</label>
				</td>
				<td>
					<input type="texte" name="mail" placeholder="mail" id="mail"value="<?php if(isset($mail)) {echo $mail; } ?>"> 
				</td>
				<tr>
				<td>
					<label for="mail2">Confirmer Email:</label>
				</td>
				<td>
						<input type="texte" name="mail2" placeholder="Confirmation mail" id="mail2" value="<?php if(isset($mail2)) {echo $mail2; } ?>"> 
				</td>
			</tr>
			<tr>
				<td>
					<label for="mdp1">Votre mot de passe :</label>
				</td>
				<td>
					<input placeholder="Mot de passe" type="password" name="mdp" id="mdp1">
				</td>
			</tr>
			<tr>
				<td>
					<label for="mdp2">Confirmez votre mot de passe :</label>
				</td>
				<td>
					<input placeholder="Confirmer mdp" type="password" name="mdp2" id="mdp2">
				</td>
			</tr>


		</table><center>
		<a href=""></a>
			<br>
			<input type="submit" value="Confirmer l'inscription" name="forminscription"><br><br>

			<a href="connexion.php">
			<input type="button" value="Déjâ inscrit" >
			</a>
			<br>
			<br>
			

		</fieldset>
		
</center>
	</form>
	
</body>
</html>

