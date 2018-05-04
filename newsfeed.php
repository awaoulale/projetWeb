<?php

session_start(); // On démarre la session AVANT toute chose


	$serveur="localhost";
	$log="root";
	$mdp="root";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);

	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];

if(!$connect )
	echo"pb de connexion";
else
{
		
	$resultat1=mysqli_query($connect, "SELECT id_ami1, chemin, nom, prenom, publication, aime, partage, commentaire, reactions.id_doc, utilisateurs.id
										FROM amis 
										JOIN documents ON amis.id_ami1=documents.id_auteur 
										JOIN utilisateurs ON utilisateurs.id=amis.id_ami1 
										JOIN reactions ON reactions.id_doc=documents.id_doc
										WHERE id_ami2=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo') 
										ORDER BY publication DESC");

	if($resultat1)
	{
		$tableau=array("");
		$tour=0;		
		
		
		$sql=mysqli_query($connect,"SELECT id FROM utilisateurs WHERE pseudo='$pseudo'");
		if($sql)
		{
			$ressql=mysqli_fetch_array($sql);
			$id_utilisateur=$ressql["id"];
		}
		
		
		while($idami=mysqli_fetch_array($resultat1))
		{
			$tour=$tour+1;
			
			$tableau2=array($idami["chemin"]);
			
			//condition pour ne pas afficher 2 fois la meme publication dans le fil d'actualite !
			if (!(in_array($idami["chemin"], $tableau)))
			{
				$tableau=array_merge($tableau, $tableau2);
		
				echo "<strong>" .$idami["prenom"]. " " .$idami["nom"]. "</strong><br/>" .$idami["publication"]. "<br/>";
			
				$id_doc=$idami["id_doc"];
				
				
			
				//on compte le nombre de jaimes
				$resultat2=mysqli_query($connect, "SELECT COUNT(aime) AS nb_1 FROM reactions WHERE id_doc='$id_doc' AND aime='oui'");
				if($resultat2)
				{
					while($nbaime=mysqli_fetch_array($resultat2))
					{
						$nb_1=$nbaime["nb_1"];
						echo $nb_1. " j aime(s) <br/>" ;
					}
				}
			
				//on compte le nombre de partages
				$resultat3=mysqli_query($connect, "SELECT COUNT(partage) AS nb_2 FROM reactions WHERE id_doc='$id_doc' AND partage='oui'");
				if($resultat3)
				{
					while($nbpartage=mysqli_fetch_array($resultat3))
					{
						$nb_2=$nbpartage["nb_2"];
						echo $nb_2. " partage(s) <br/>" ;
					}
				}
			
				//on compte le nombre de commentaires
				$resultat4=mysqli_query($connect, "SELECT COUNT(commentaire) AS nb_3 FROM reactions WHERE id_doc='$id_doc' AND commentaire IS NOT NULL");
				if($resultat4)
				{
					while($nbcommentaire=mysqli_fetch_array($resultat4))
					{
						$nb_3=$nbcommentaire["nb_3"];
						echo $nb_3. " commentaire(s) <br/>" ;
					}
				}
				
				//affichage des commentaires				
				$commentaires=mysqli_query($connect, "SELECT commentaire, pseudo
														FROM reactions 
														JOIN utilisateurs ON utilisateurs.id=reactions.id_utilisateur
														WHERE id_doc='$id_doc'");
				if($commentaires)
				{
					while($affichecommentaire=mysqli_fetch_array($commentaires))
					{
						$commentaire=$affichecommentaire["commentaire"];												
						$auteur=$affichecommentaire["pseudo"]; //PB
						echo '"'.$commentaire.'" par '.$auteur.'<br/>';
					}
				}
				
				
			
				//si le document est une photo .jpg
				if( strstr($idami["chemin"], ".jpg"))
				{
					echo '<img src="'.$idami["chemin"].'" alt="photo" />';
				}
			
				//si le document est une video .mp4
				if( strstr($idami["chemin"], ".mp4"))
				{
					echo '<video controls src="'.$idami["chemin"].'" width="800" height="500">Ici la description alternative</video>';
				}
				
				echo "<br/><br/>";
				
				//mise en place des boutons
				echo '<form action="newsfeed.php" method="post">';
				//bouton aimer
				echo '<input type="submit" name="'.$tour.'aimer" value="Aimer"/>';
				echo " ";
				//bouton ne plus aimer
				echo '<input type="submit" name="'.$tour.'neplusaimer" value="Ne plus aimer"/>';
				echo "<br/>";
				//champ de texte pour le commentaire
				//echo'<label>Entrez un commentaire</label>'; //moche
				echo '<input type="text" name="'.$tour.'commentaire" />';
				//bouton commenter
				echo '<input type="submit" name="'.$tour.'commenter" value="Commenter"/>';
				echo '</form>';
			
				// si on appuie sur le bouton pour aimer
				if (isset($_POST[$tour."aimer"]))
				{
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre"];
							if($nombre==0) // si la ligne n'existe pas, on la crée
							{
								$requete2=mysqli_query($connect, "INSERT INTO reactions VALUES ('$id_doc','$id_utilisateur','oui','non',NULL)");
							}
							if($nombre!=0) // si la ligne existe, on la modifie
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET aime='oui' WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')");
							}
						}
					}
				}
				
				// si on appuie sur le bouton pour ne plus aimer
				if (isset($_POST[$tour."neplusaimer"]))
				{
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre2 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre2"];
							if($nombre!=0) // si la ligne existe, on la modifie
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET aime='non' WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')"); //OK
							}
						}
					}
				}
				
				// si on appuie sur le bouton pour commenter (ajouter un commentaire)
				if (isset($_POST[$tour."commenter"]))
				{
					//echo "boutonok";
					$nvcom=$_POST[$tour."commentaire"];
					echo "$nvcom";
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre"];
							if($nombre==0) // si la ligne n'existe pas, on la crée
							{
								$requete2=mysqli_query($connect, "INSERT INTO reactions VALUES ('$id_doc','$id_utilisateur','non','non','$nvcom')");
							}
							if($nombre!=0) // si la ligne existe, on la modifie (concatenation avec les commentaires precedents)
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET commentaire=CONCAT(commentaire, ' | ', '$nvcom') WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')");
							}
							
							
						}
					}
				}
				
				
				
				echo "<br/><hr><br/>";
				
			}//fin du if d'affichage
			

		} //fin du while requete
		
		
	} //fin du if requete		
	
	
	
}	//fin du else	
?>